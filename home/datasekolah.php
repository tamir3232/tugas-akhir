<?php include '../display/header.php'; ?>
<link rel="stylesheet" href="../tools/css/dashboard_admin.css">

<body>
<?php include '../display/nav.php'; ?>
    <div class="wrapper">
        <div class="main">
            <main class="content">
                <div class="container-fluid">
                    <div class="mb-3">
                        <div class="navbar-container">
                            <p class="fw-bold fs-4 mb-3">Data Sekolah</p>
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table-dark text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Sekolah</th>
                                        <th>Akreditasi</th>
                                        <th>Biaya Sekolah</th>
                                        <th>Sarana & Prasarana</th>
                                        <th>Kuota SNBP</th>
                                        <th>Alamat</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../tools/koneksi.php';
                                    $id_alternatif = 1;
                                    $select = mysqli_query($conn, "SELECT * FROM sekolah");
                                    while ($hasil = mysqli_fetch_array($select)) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $id_alternatif++; ?></td>
                                        <td><?php echo $hasil['nama_sekolah']; ?></td>
                                        <td class="text-center"><?php echo $hasil['akreditas']; ?></td>
                                        <td class="text-end">
                                            <?php echo number_format((float) str_replace('.', '', $hasil['biaya']), 0, ',', '.'); ?>
                                        </td>
                                        <td class="text-center"><?php echo $hasil['sarpras']; ?></td>
                                        <td class="text-center"><?php echo $hasil['kuota_snbp']; ?>%</td>
                                        <td><?php echo $hasil['alamat']; ?></td>
                                        <td class="text-center"><?php echo $hasil['latitude']; ?></td>
                                        <td class="text-center"><?php echo $hasil['longitude']; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
