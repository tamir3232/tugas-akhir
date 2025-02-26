<?php 
include "../tools/koneksi.php";


$id_sekolah = $_GET["id_sekolah"];
$query = mysqli_query($conn,"SELECT * FROM sekolah WHERE id_sekolah = $id_sekolah");
$data = mysqli_fetch_array($query);
if (isset($_POST["submit"])) {
    $nama_sekolah = $_POST['nama_sekolah'];
    $akreditas = $_POST['akreditas'];
    $biaya = $_POST['biaya'];
    $sarpras = $_POST['sarpras'];
    $kuota_snbp = $_POST['kuota_snbp'];
    $alamat = $_POST['alamat'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    mysqli_query($conn, "UPDATE sekolah SET nama_sekolah = '$nama_sekolah', akreditas = '$akreditas', biaya = '$biaya', sarpras = '$sarpras', kuota_snbp = '$kuota_snbp', alamat = '$alamat', latitude = '$latitude', longitude = '$longitude' WHERE id_sekolah = $id_sekolah");
    header ("location:alternatifView.php");
}

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
                            <input type="hidden" name = "id_sekolah" value = "<?php echo $data["id_sekolah"]; ?>">
            
                            <table>
                                <thead>
                                    <tr>
                                    <th colspan="2">Ubah Data Alternatif</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>Nama Sekolah</td>
                                        <td><input name="nama_sekolah" type="text" value="<?php echo $data['nama_sekolah'] ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Akreditas</td>
                                        <td><input name="akreditas" type="text" value="<?php echo $data['akreditas'] ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Biaya Sekolah</td>
                                        <td><input name="biaya" type="text" value="<?php echo $data['biaya'] ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Sarana & Prasarana</td>
                                        <td><input name="sarpras" type="text" value="<?php echo $data['sarpras'] ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Kuota SNBP</td>
                                        <td><input name="kuota_snbp" type="text" value="<?php echo $data['kuota_snbp'] ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td><input name="alamat" type="text" value="<?php echo $data['alamat'] ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Latitude</td>
                                        <td>
                                            <input name="latitude" type="number" step="0.000001" min="-90" max="90" value="<?php echo $data['latitude'] ?>" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Longitude</td>
                                        <td>
                                            <input name="longitude" type="number" step="0.000001" min="-180" max="180" value="<?php echo $data['longitude'] ?>" required>
                                        </td>
                                    </tr>
                                </tbody>

                                <tfoot>
                                    <tr>
                                    <td colspan="2" style="text-align: right;">
                                        <input class="tombol tambah" value="Ubah" name="submit" type="submit">
                                    </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>
                </div>
            </main>
        </div>              
    </div>