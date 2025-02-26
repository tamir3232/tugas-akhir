<?php 
include "../tools/koneksi.php";


$no_kriteria = $_GET["id_kriteria"];
$query = mysqli_query($conn,"SELECT * FROM kriteria WHERE id_kriteria = $no_kriteria");
$data = mysqli_fetch_array($query);
if (isset($_POST["submit"])) {
	$kode_kriteria = $_POST['kode_kriteria'];
    $nama_kriteria = $_POST['nama_kriteria'];
    $tingkat_prioritas = $_POST['tingkat_prioritas'];
    $bobot = $_POST['bobot'];
    mysqli_query($conn, "UPDATE kriteria SET kode_kriteria = '$kode_kriteria', nama_kriteria = '$nama_kriteria', tingkat_prioritas = '$tingkat_prioritas', bobot = '$bobot' WHERE id_kriteria = $no_kriteria");
    header ("location:kriteriaView.php");
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
                            <p class="fw-bold fs-4 mb-3">Data Kriteria</p>
                            <nav class="nav-list">
                            <ul>
                                <li><a href="kriteriaView.php">Kembali</a></li>
                            </nav>
                        </div>
                        <form method="post" class="form">
                            <input type="hidden" name = "id_kriteria" value = "<?php echo $data["id_kriteria"]; ?>">
            
                            <table>
                                <thead>
                                    <tr>
                                    <th colspan="2">Ubah Data Kriteria</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>Kode Kriteria</td>
                                        <td><input name="kode_kriteria" type="text" value="<?php echo $data['kode_kriteria'] ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Kriteria</td>
                                        <td><input name="nama_kriteria" type="text" value="<?php echo $data['nama_kriteria'] ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Tingkat Prioritas</td>
                                        <td><input name="tingkat_prioritas" type="number" value="<?php echo $data['tingkat_prioritas'] ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Bobot</td>
                                        <td><input name="bobot" type="number" value="<?php echo $data['bobot'] ?>"></td>
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