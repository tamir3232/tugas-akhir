<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../display/header.php'?>
    <link rel="stylesheet" href="../tools/css/dashboard_admin.css">
</head>

<body>
    <div class="wrapper">
        <?php include '../display/navAdmin.php' ?>
        <div class="main">
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="mb-3">
                        <div class="navbar-container">
                            <p class="fw-bold fs-4 mb-3">Data Sub Kriteria</p>
                        </div>

                            <?php 
                                include 'akreditas.php';
                            ?>  
                </div>
            </div>
        </main>
    </div>
</body>
