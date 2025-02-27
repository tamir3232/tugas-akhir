<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../login/login.php");
    exit;
}
?>

<?php include '../display/header.php'?>
<link rel="stylesheet" href="../tools/css/dashboard_admin.css">

<body>
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
                                <li><a href="tambahAlternatif.php">+Tambah Data</a></li>
                            </nav>
                        </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Sekolah</th>
                                        <th>Akreditas</th>
                                        <th>Biaya Sekolah</th>
                                        <th>Sarana & Prasarana</th>
                                        <th>Kuota SNBP</th>
                                        <th>Alamat</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <?php
                                        include '../tools/koneksi.php';
                                        $id_alternatif = 1; 
                                        $select = mysqli_query($conn, "SELECT * FROM sekolah");
                                        while ($hasil = mysqli_fetch_array($select)) {
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $id_alternatif++ ?></td>
                                            <td><?php echo $hasil['nama_sekolah']?></td>
                                            <td><?php echo $hasil['akreditas']?></td>
                                            <td><?php echo $hasil['biaya']?></td>
                                            <td><?php echo $hasil['sarpras']?></td>
                                            <td><?php echo $hasil['kuota_snbp']?></td>
                                            <td><?php echo $hasil['alamat']?></td>
                                            <td><?php echo $hasil['latitude']?></td>
                                            <td><?php echo $hasil['longitude']?></td>
                                            <td>
                                                <a href="editAlternatif.php?id_sekolah=<?php echo $hasil['id_sekolah'] ?>" class="edit">Edit</a>
                                                <a href="hapusAlternatif.php?id_sekolah=<?php echo $hasil['id_sekolah']?>" onclick = "return confirm('Yakin data ini ingin dihapus?')" class="hapus">Hapus</a>
                                            </td>  
                                        </tr>
                                    </tbody>
                                    <?php } ?>
                            </table>
                </div>
            </div>
        </main>
    </div>
</body>
