import requests
from flask import Flask, request, jsonify
from flask_cors import CORS
import pymysql

app = Flask(__name__)
CORS(app)

db = pymysql.connect(
    host="localhost",
    user="root",
    password="12345678",
    database="skripsi"
)

@app.route('/', methods=['GET'])
def home():
    return "Flask server is running. Use the '/calculate' endpoint to send POST requests."

def find_shortest_path_via_osrm(user_lat, user_lon, school_locations):
    osrm_url = "http://router.project-osrm.org/route/v1/driving/"
    results = []

    for school in school_locations:
        try:
            school_lat = float(school["latitude"])
            school_lon = float(school["longitude"])
            
            response = requests.get(f"{osrm_url}{user_lon},{user_lat};{school_lon},{school_lat}", params={"overview": "false", "geometries": "geojson"})
            data = response.json()
            
            if "routes" in data and data["routes"]:
                path_length = data["routes"][0]["distance"]
                distance_km = path_length / 1000
                
                # Normalisasi jarak berdasarkan sub-kriteria jarak
                if distance_km <= 5:
                    normalized_distance = 0.611
                elif 6 <= distance_km <= 10:
                    normalized_distance = 0.277
                else:
                    normalized_distance = 0.111
                
                results.append({
                    "school_id": school["id_sekolah"],
                    "school_name": school["nama_sekolah"],
                    "latitude": school_lat,
                    "longitude": school_lon,
                    "distance_km": distance_km,
                    "normalized_distance": normalized_distance
                })
            else:
                results.append({
                    "school_id": school["id_sekolah"],
                    "school_name": school["nama_sekolah"],
                    "latitude": school_lat,
                    "longitude": school_lon,
                    "distance_km": None,
                    "normalized_distance": 0.111
                })
        except Exception as e:
            print(f"Error processing school {school}: {e}")
    return results

def calculate_smarter_scores(results, user_priority):
    cursor = db.cursor(pymysql.cursors.DictCursor)
    final_results = []

    cursor.execute("SELECT kode_kriteria, bobot FROM kriteria")
    base_weights = {row["kode_kriteria"]: row["bobot"] for row in cursor.fetchall()}
    print(f"Initial weights from DB: {base_weights}")
    print(f"User priority received: {user_priority}")

    priority_mapping = {
        "akreditasi": "C1",
        "biaya": "C2",
        "sarpras": "C3",
        "jarak": "C4",
        "kuota snbp": "C5"
    }
    user_priority_code = priority_mapping.get(user_priority.lower(), None)
    updated_weights = base_weights.copy()

    if user_priority_code and user_priority_code in updated_weights:
        print(f"Priority {user_priority_code} found in base_weights. Updating weights...")
        total_weight = sum(updated_weights.values())
        
        # Naikkan bobot prioritas dengan faktor 1.5x
        updated_weights[user_priority_code] *= 1.5
        
        # Redistribusi bobot lain agar total tetap 1
        remaining_weight = total_weight - updated_weights[user_priority_code]
        non_priority_keys = [k for k in updated_weights if k != user_priority_code]
        
        if remaining_weight > 0:
            sum_other_weights = sum(base_weights[k] for k in non_priority_keys)
            for key in non_priority_keys:
                updated_weights[key] = (base_weights[key] / sum_other_weights) * remaining_weight
        else:
            updated_weights[user_priority_code] = total_weight
            for key in non_priority_keys:
                updated_weights[key] = 0
    else:
        print(f"Priority {user_priority} NOT found in base_weights. No weight changes applied.")

    print(f"Updated weights after user priority ({user_priority}): {updated_weights}")

    criteria_max = {}
    criteria_min = {}
    cursor.execute("""
        SELECT k.kode_kriteria, MAX(p.nilai) AS max_val, MIN(p.nilai) AS min_val
        FROM penilaian p
        JOIN kriteria k ON p.kriteria_id = k.id_kriteria
        GROUP BY k.kode_kriteria
    """)
    for row in cursor.fetchall():
        criteria_max[row["kode_kriteria"]] = row["max_val"] if row["max_val"] is not None else 1
        criteria_min[row["kode_kriteria"]] = row["min_val"] if row["min_val"] is not None else 0

    for result in results:
        school_id = result["school_id"]
        cursor.execute("""
            SELECT p.nilai AS bobot, k.kode_kriteria
            FROM penilaian p
            JOIN kriteria k ON p.kriteria_id = k.id_kriteria 
            WHERE p.sekolah_id = %s
        """, (school_id,))

        school_data = cursor.fetchall()
        
        bobot = {k: 0 for k in updated_weights.keys()}  
        
        for data in school_data:
            key = data["kode_kriteria"]  
            if key in criteria_max and criteria_max[key] != criteria_min[key]:
                bobot[key] = (data["bobot"] - criteria_min[key]) / (criteria_max[key] - criteria_min[key])
            else:
                bobot[key] = 1  
        
        bobot["C4"] = result["normalized_distance"]  
        
        smarter_score = sum(updated_weights.get(k, 0) * bobot.get(k, 0) for k in updated_weights)
        result["smarter_score"] = round(smarter_score, 4)
        final_results.append(result)

    return sorted(final_results, key=lambda x: x["smarter_score"], reverse=True)

@app.route('/calculate', methods=['POST'])
def calculate():
    try:
        data = request.json
        user_lat = float(data.get("latitude"))
        user_lon = float(data.get("longitude"))
        user_priority = data.get("priority")
        
        cursor = db.cursor(pymysql.cursors.DictCursor)
        cursor.execute("SELECT id_sekolah, nama_sekolah, latitude, longitude FROM sekolah")
        school_locations = cursor.fetchall()

        shortest_paths = find_shortest_path_via_osrm(user_lat, user_lon, school_locations)
        results = calculate_smarter_scores(shortest_paths, user_priority)

        return jsonify(results)
    except Exception as e:
        print(f"Error: {e}")
        return jsonify({"error": str(e)}), 500

if __name__ == '__main__':
    app.run(debug=True)
