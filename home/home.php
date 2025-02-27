<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <title>SPK SMARTER</title>
    
    <link rel="stylesheet" href="../tools/css/leaflet.css">
    <script src="../tools/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css">
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../tools/css/home.css">
  </head>
  <body class="my-app">
    <?php include '../display/nav.php'?>

    <main>
      <div class="content">
        <div class="content-description">
          <h1 class="title">Kombinasi Metode SMARTER dengan Algoritma A*</h1>
          <p>Memberikan rekomendasi dalam pemilihan sekolah menengah atas swasta di kota Medan berdasarkan prioritas pengguna.</p>
          <h5>Jangan lupa izinkan website mengakses lokasi anda!</h5>
        </div>
        <div class="content-image">
          <img src="../tools/css/images/back-to-school.png" alt="img">
        </div>
      </div>
    </main>

    <!-- Form untuk memilih prioritas kriteria -->
    <h2>Prioritas Kriteria akan diutamakan dalam pencarian sekolah</h2>
    <form id="priorityForm">
      <label for="priority">Pilih kriteria utama:</label>
      <select id="priority" name="priority">
        <option value="">Tanpa Prioritas</option>
        <option value="akreditasi">Akreditasi</option>
        <option value="biaya">Biaya</option>
        <option value="sarpras">Sarana Prasarana</option>
        <option value="jarak">Jarak</option>
        <option value="kuota_snbp">Kuota SNBP</option>
      </select>
    </form>

    <h2>Klik tombol "CARI SEKOLAH" untuk memulai pencarian sekolah</h2>
    <button class="run-button" onclick="getLocation()">Cari Sekolah</button>
    <p id="status"></p>

    <div class="maps">
      <center><h1>MAPS</h1></center>
      <div id="map"></div>  
    </div>

    <div class="home-table-container">
    <table>
      <thead>
        <tr>
          <th>NO</th>
          <th>NAMA SEKOLAH</th>
          <th>JARAK (KM)</th>
          <th>PERINGKAT SMARTER</th>
        </tr>
      </thead>
      <tbody>
        <!-- Output -->
      </tbody>
    </table>
    </div>

    <script>
      let map;
      let markers = [];

      function initMap() {
        const medan = [3.5952, 98.6722];
        map = L.map('map').setView(medan, 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          maxZoom: 19,
          attribution: '© OpenStreetMap contributors'
        }).addTo(map);
      }

      function getLocation() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(sendLocation, showError);
        } else {
          document.getElementById("status").innerHTML = "Geolocation tidak didukung oleh browser ini.";
        }
      }

      function sendLocation(position) {
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;
        const selectedPriority = document.getElementById("priority").value;

        fetch("https://spksmarter.my.id/api/calculate", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ latitude, longitude, priority: selectedPriority }),
        })
        .then((response) => response.json())
        .then((data) => {
          const tableBody = document.querySelector("table tbody");
          tableBody.innerHTML = ""; 

          markers.forEach((marker) => map.removeLayer(marker));
          markers = [];

          data.forEach((school, index) => {
            if (school.latitude && school.longitude) {
              const row = document.createElement("tr");
              row.innerHTML = `
                <td>${index + 1}</td>
                <td>${school.school_name}</td>
                <td>${school.distance_km !== "N/A" ? school.distance_km.toFixed(2) : "Tidak Tersedia"}</td>
                <td>${school.smarter_score.toFixed(2)}</td>
              `;
              tableBody.appendChild(row);

              const marker = L.marker([school.latitude, school.longitude])
                .addTo(map)
                .bindPopup(`
                  <h3>${school.school_name}</h3>
                  <p>Jarak: ${school.distance_km !== "N/A" ? school.distance_km.toFixed(2) : "Tidak Tersedia"} km</p>
                  <p>Peringkat SMARTER: ${school.smarter_score.toFixed(2)}</p>
                  <button onclick="createRoute(${school.latitude}, ${school.longitude})">Tampilkan Rute</button>
                `);

              markers.push(marker);
            } else {
              console.error("Invalid school data:", school);
            }
          });

          map.setView([latitude, longitude], 13);
        })
        .catch((error) => {
          document.getElementById("status").innerHTML = "Terjadi kesalahan: " + error.message;
        });
      }

      function createRoute(lat, lng) {
        navigator.geolocation.getCurrentPosition(
          (position) => {
            const userLat = position.coords.latitude;
            const userLng = position.coords.longitude;

            if (window.routingControl) {
              map.removeControl(window.routingControl);
            }

            window.routingControl = L.Routing.control({
              waypoints: [
                L.latLng(userLat, userLng),
                L.latLng(lat, lng),
              ],
              router: L.Routing.osrmv1({
                serviceUrl: 'https://router.project-osrm.org/route/v1'
              }),
              routeWhileDragging: true
            }).addTo(map);
          },
          (error) => {
            alert("Tidak dapat mengakses lokasi Anda.");
          }
        );
      }

      function showError(error) {
        let errorMessage = "";
        switch (error.code) {
          case error.PERMISSION_DENIED:
            errorMessage = "Pengguna menolak permintaan geolokasi.";
            break;
          case error.POSITION_UNAVAILABLE:
            errorMessage = "Lokasi tidak tersedia.";
            break;
          case error.TIMEOUT:
            errorMessage = "Permintaan geolokasi telah melebihi batas waktu.";
            break;
          case error.UNKNOWN_ERROR:
            errorMessage = "Terjadi kesalahan yang tidak diketahui.";
            break;
        }
        document.getElementById("status").innerHTML = errorMessage;
      }

      window.onload = initMap;
    </script>
  </body>

  <footer>
    <center><p>Skripsi by Jessica Kristina Hutasoit</p></center>
  </footer>
</html>
