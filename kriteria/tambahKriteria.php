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
                            <p class="fw-bold fs-4 mb-3">Data Kriteria</p>
                            <nav class="nav-list">
                                <ul>
                                    <li><a href="kriteriaView.php">Kembali</a></li>
                                </ul>
                            </nav>
                        </div>
                        <form method="post" class="form">
                            <input type="hidden" name = "no_kriteria" value = "<?php echo $data["no_kriteria"]; ?>">
            
                            <table>
                                <thead>
                                    <tr>
                                    <th colspan="2">Input Data Kriteria</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Kode Kriteria</td>
                                        <td><input name="kode_kriteria" type="text"></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Kriteria</td>
                                        <td><input name="nama_kriteria" type="text"></td>
                                    </tr>
                                    <tr>
                                        <td>Tingkat Prioritas</td>
                                        <td><input name="tingkat_prioritas" type="number"></td>
                                    </tr>
                                    <tr>
                                        <td>Bobot</td>
                                        <td><input name="bobot" type="text"></td>
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
                                $kode_kriteria = $_POST['kode_kriteria'];
                                $nama_kriteria = $_POST['nama_kriteria'];
                                $tingkat_prioritas = $_POST['tingkat_prioritas'];
                                $qry = mysqli_query($conn, "INSERT INTO kriteria (kode_kriteria, nama_kriteria, tingkat_prioritas) VALUES ('$kode_kriteria', '$nama_kriteria', '$tingkat_prioritas')");

                            }

                        ?>

                    </div>
                </div>
            </main>
        </div>              
    </div>