<?php 
    include "../tools/koneksi.php";
?>

<?php include '../display/header.php'?>
<link rel="stylesheet" href="../tools/css/dashboard_admin.css">

    <div class="wrapper">
        <?php include '../display/navAdmin.php' ?>
        <div class="main">
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="mb-3">
                        <div class="navbar-container">
                            <p class="fw-bold fs-4 mb-3">Data Alternatif</p>
                            <nav class="nav-list">
                            <ul>
                                <li><a href="alternatifView.php">Kembali</a></li>
                            </nav>
                        </div>
                        <form method="post" class="form">
                            <input type="hidden" name = "no_alternatif" value = "<?php echo $data["no_alternatif"]; ?>">
            
                            <table>
                                <thead>
                                    <tr>
                                    <th colspan="2">Input Data Alternatif</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Nama Sekolah</td>
                                        <td><input name="nama_sekolah" type="text"></td>
                                    </tr>
                                    <tr>
                                        <td>Akreditas</td>
                                        <td><input name="akreditas" type="text"></td>
                                    </tr>
                                    <tr>
                                        <td>Biaya Sekolah</td>
                                        <td><input name="biaya" type="text"></td>
                                    </tr>
                                    <tr>
                                        <td>Sarana & Prasarana</td>
                                        <td><input name="sarpras" type="text"></td>
                                    </tr>
                                    <tr>
                                        <td>Kuota SNBP</td>
                                        <td><input name="kuota_snbp" type="text"></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat Sekolah</td>
                                        <td><input name="alamat" type="text"></td>
                                    </tr>
                                    <tr>
                                        <td>Latitude</td>
                                        <td>
                                            <input name="latitude" type="number" step="0.000001" min="-90" max="90" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Longitude</td>
                                        <td>
                                            <input name="longitude" type="number" step="0.000001" min="-180" max="180" required>
                                        </td>
                                    </tr>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2" style="text-align: right;">
                                            <input class="tombol tambah" value="Tambah" name="submit" type="submit">
                                            <input class="tombol reset" value="Reset" type="reset">
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>

                        <?php
                    if (isset($_POST['submit'])){
                        $nama_sekolah = $_POST['nama_sekolah'];
                        $akreditas = $_POST['akreditas'];
                        $biaya = $_POST['biaya'];
                        $sarpras = $_POST['sarpras'];
                        $kuota_snbp = $_POST['kuota_snbp'];
                        $alamat = $_POST['alamat'];
                        $latitude = $_POST['latitude'];
                        $longitude = $_POST['longitude'];
                        $qry = mysqli_query($conn, "INSERT INTO sekolah (nama_sekolah, akreditas, biaya, sarpras, kuota_snbp, alamat, latitude, longitude) VALUES ('$nama_sekolah', '$akreditas', '$biaya', '$sarpras', '$kuota_snbp', '$alamat', '$latitude', '$longitude')");

                    }

                ?>

                    </div>
                </div>
            </main>
        </div>              
    </div>