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
                            <p class="fw-bold fs-4 mb-3">Data Kriteria</p>
                            <nav class="nav-list">
                            <ul>
                                <li><a href="tambahKriteria.php">+Tambah Data</a></li>
                            </nav>
                        </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Kriteria</th>
                                        <th>Nama Kriteria</th>
                                        <th>Tingkat Prioritas</th>
                                        <th>Bobot</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <?php
                                        include '../tools/koneksi.php';
                                        $no_kriteria = 1; 
                                        $select = mysqli_query($conn, "SELECT * FROM kriteria");
                                        while ($hasil = mysqli_fetch_array($select)) {
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $no_kriteria++ ?></td>
                                            <td><?php echo $hasil['kode_kriteria']?></td>
                                            <td><?php echo $hasil['nama_kriteria']?></td>
                                            <td><?php echo $hasil['tingkat_prioritas']?></td>
                                            <td><?php echo $hasil['bobot']?></td>
                                            <td>
                                                <a href="editKriteria.php?id_kriteria=<?php echo $hasil['id_kriteria'] ?>" class="edit">Edit</a>
                                                <a href="hapusKriteria.php?id_kriteria=<?php echo $hasil['id_kriteria']?>" onclick = "return confirm('Yakin data ini ingin dihapus?')" class="hapus">Hapus</a>
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
