<?php
session_start(); // Mulai sesi

// Periksa apakah user sudah login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Redirect ke halaman login
    header("Location: ../login/login.php");
    exit;
}

include '../display/header.php';
?>


<?php include '../display/header.php'?>
<link rel="stylesheet" href="../tools/css/admin.css">

<body>
    <div class="wrapper">
        <?php include '../display/navAdmin.php' ?>
        <div class="main">
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h3 class="fw-bold fs-4 mb-3">Admin Dashboard</h3>
                    </div><br><br>
                    <div class="card">
                        <div class="head">Alternatif</div>
                        <div class="content">
                            Data alternatif atau sekolah yang ada pada database berjumlah 23.  
                            <br />
                            <a href="../alternatif/alternatifView.php" class="button">Klik</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="head">Kriteria</div>
                        <div class="content">
                            Kriteria yang digunakan berjumlah 5 yaitu Akreditas, Biaya, Sarana dan Prasarana (Sarpras), Jarak, dan Kuota SNBP. 
                            Tingkat bobotnya yaitu 0.456, 0.256, 0.156, 0.09, dan 0.04. 
                            <br />
                            <a href="../kriteria/kriteriaView.php" class="button">Klik</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="head">Sub Kriteria</div>
                        <div class="content">
                            Sub kriteria pada masing-masing kriteria berjumlah 3. Tingkat bobotnya yaitu 0.611, 0.277, dan 0.111.
                            <br />
                            <a href="../subKriteria/subkriteriaView.php" class="button">Klik</a>
                        </div>
                    </div>
                </div><br><br>
                    <div class="mb-3">
                        <a href="../home/home.php"><h4 class="fw-bold fs-4 mb-3">Pergi ke Halaman Home User</h4></a>
                    </div>
            </main>
        </div>
    </div>
</body>

</html>