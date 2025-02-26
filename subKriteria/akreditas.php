<?php 
include "../tools/koneksi.php";

// Proses Hapus Data
if (isset($_GET['hapus_id'])) {
    $hapus_id = intval($_GET['hapus_id']); // Validasi input sebagai angka
    $hapus_qry = mysqli_query($conn, "DELETE FROM sub_kriteria WHERE id_subkriteria = $hapus_id");
    
    if ($hapus_qry) {
        echo "<script>
            alert('Data berhasil dihapus');
            window.location.href = 'subkriteriaView.php';
        </script>";
    } else {
        echo "<script>alert('Gagal menghapus data');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="../tools/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../tools/css/dashboard_admin.css">
    <script src="../tools/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
    <div class="navbar-container-mini">
        <nav class="nav-list">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                + Tambah Data
            </button>
        </nav>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kriteria</th>
                <th>Nama Sub Kriteria</th>
                <th>Tingkat Prioritas</th>
                <th>Bobot</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $no_subkriteria = 1;
        $select = mysqli_query($conn, "
            SELECT sub_kriteria.*, kriteria.nama_kriteria 
            FROM sub_kriteria 
            JOIN kriteria ON sub_kriteria.kriteria_id = kriteria.id_kriteria
        ");
        while ($hasil = mysqli_fetch_assoc($select)) {
        ?>
        <tbody>
            <tr>
                <td><?php echo $no_subkriteria++; ?></td>
                <td><?php echo $hasil['nama_kriteria']; ?></td>
                <td><?php echo $hasil['nama_subkriteria']; ?></td>
                <td><?php echo $hasil['tingkat_prioritas']; ?></td>
                <td><?php echo $hasil['bobot_subkriteria']; ?></td>
                <td>
                <button 
    class="btn btn-warning"
    onclick="editData(
        '<?php echo $hasil['id_subkriteria']; ?>', 
        '<?php echo $hasil['kriteria_id']; ?>', 
        '<?php echo htmlspecialchars($hasil['nama_subkriteria'], ENT_QUOTES); ?>', 
        '<?php echo $hasil['tingkat_prioritas']; ?>', 
        '<?php echo $hasil['bobot_subkriteria']; ?>'
    )"
    data-bs-toggle="modal" 
    data-bs-target="#edit">
    Edit
</button>

                    <a href="?hapus_id=<?php echo $hasil['id_subkriteria']; ?>" onclick="return confirm('Yakin data ini ingin dihapus?')" class="btn btn-danger">Hapus</a>
                </td>  
            </tr>
        </tbody>
        <?php } ?>
    </table>
</div>

<!-- Modal Tambah Data Start -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">+Tambah Sub Kriteria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kriteria" class="col-form-label">Kriteria</label>
                        <select name="kriteria_id" class="form-control" required>
                            <?php
                            $result = mysqli_query($conn, "SELECT id_kriteria, nama_kriteria FROM kriteria");
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='{$row['id_kriteria']}'>{$row['nama_kriteria']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama_subkriteria" class="col-form-label">Nama Sub Kriteria</label>
                        <input name="nama_subkriteria" type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="tingkat_prioritas" class="col-form-label">Tingkat Prioritas</label>
                        <input name="tingkat_prioritas" type="number" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="bobot_subkriteria" class="col-form-label">Bobot Sub Kriteria</label>
                        <input name="bobot_subkriteria" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $kriteria_id = intval($_POST['kriteria_id']);
    $nama_subkriteria = mysqli_real_escape_string($conn, $_POST['nama_subkriteria']);
    $tingkat_prioritas = intval($_POST['tingkat_prioritas']);
    $bobot_subkriteria = floatval($_POST['bobot_subkriteria']);

    $qry = mysqli_query($conn, "
        INSERT INTO sub_kriteria (kriteria_id, nama_subkriteria, tingkat_prioritas, bobot_subkriteria) 
        VALUES ('$kriteria_id', '$nama_subkriteria', '$tingkat_prioritas', '$bobot_subkriteria')
    ");

    if ($qry) {
        echo "<script>
            alert('Data berhasil ditambahkan');
            window.location.href = window.location.href;
        </script>";
    } else {
        echo "<script>alert('Gagal menambahkan data');</script>";
    }
}
?>
<!-- Modal Tambah Data End -->

<!-- Modal Edit Data Start -->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleEditLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleEditLabel">Edit Sub Kriteria</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Hidden input to store the ID of the subkriteria -->
          <input type="hidden" name="edit_id_subkriteria" id="edit_id_subkriteria">

          <!-- Dropdown for Kriteria -->
          <div class="mb-3">
            <label for="edit_kriteria_id" class="col-form-label">Kriteria</label>
            <select name="edit_kriteria_id" id="edit_kriteria_id" class="form-control" required>
              <?php
              // Populate kriteria options from the database
              $result = mysqli_query($conn, "SELECT id_kriteria, nama_kriteria FROM kriteria");
              while ($row = mysqli_fetch_assoc($result)) {
                  echo "<option value='{$row['id_kriteria']}'>{$row['nama_kriteria']}</option>";
              }
              ?>
            </select>
          </div>

          <!-- Input for Nama Sub Kriteria -->
          <div class="mb-3">
            <label for="edit_nama_subkriteria" class="col-form-label">Nama Sub Kriteria</label>
            <input name="edit_nama_subkriteria" type="text" id="edit_nama_subkriteria" class="form-control" required>
          </div>

          <!-- Input for Tingkat Prioritas -->
          <div class="mb-3">
            <label for="edit_tingkat_prioritas" class="col-form-label">Tingkat Prioritas</label>
            <input name="edit_tingkat_prioritas" type="number" id="edit_tingkat_prioritas" class="form-control" step="0.01" required>
          </div>

          <!-- Input for Bobot -->
          <div class="mb-3">
            <label for="edit_bobot_subkriteria" class="col-form-label">Bobot Sub Kriteria</label>
            <input name="edit_bobot_subkriteria" type="text" id="edit_bobot_subkriteria" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary" name="edit_submit">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal Edit Data End -->

<?php
// Proses Edit Data
if (isset($_POST['edit_submit'])) {
    $id_subkriteria = intval($_POST['edit_id_subkriteria']);
    $kriteria_id = intval($_POST['edit_kriteria_id']);
    $nama_subkriteria = mysqli_real_escape_string($conn, $_POST['edit_nama_subkriteria']);
    $tingkat_prioritas = floatval($_POST['edit_tingkat_prioritas']);
    $bobot_subkriteria = floatval($_POST['edit_bobot_subkriteria']);

    // Update query
    $qry = mysqli_query($conn, "
        UPDATE sub_kriteria 
        SET 
            kriteria_id = '$kriteria_id', 
            nama_subkriteria = '$nama_subkriteria', 
            tingkat_prioritas = '$tingkat_prioritas', 
            bobot_subkriteria = '$bobot_subkriteria' 
        WHERE id_subkriteria = $id_subkriteria
    ");

    if ($qry) {
        echo "<script>
            alert('Data berhasil diubah');
            window.location.href = window.location.href;
        </script>";
    } else {
        echo "<script>alert('Gagal mengubah data');</script>";
    }
}
?>

<!-- Modal Edit Data End -->

<?php
// Proses Edit Data
if (isset($_POST['edit_submit'])) {
    $id_subkriteria = intval($_POST['edit_id_subkriteria']);
    $kriteria_id = intval($_POST['edit_kriteria_id']);
    $nama_subkriteria = mysqli_real_escape_string($conn, $_POST['edit_nama_subkriteria']);
    $tingkat_prioritas = intval($_POST['edit_tingkat_prioritas']);
    $bobot_subkriteria = floatval($_POST['edit_bobot_subkriteria']);

    // Update query
    $qry = mysqli_query($conn, "
        UPDATE sub_kriteria 
        SET 
            kriteria_id = '$kriteria_id', 
            nama_subkriteria = '$nama_subkriteria', 
            tingkat_prioritas = '$tingkat_prioritas', 
            bobot_subkriteria = '$bobot_subkriteria' 
        WHERE id_subkriteria = $id_subkriteria
    ");

    if ($qry) {
        echo "<script>
            alert('Data berhasil diubah');
            window.location.href = window.location.href;
        </script>";
    } else {
        echo "<script>alert('Gagal mengubah data');</script>";
    }
}
?>

<script>
function editData(id, kriteria_id, nama, prioritas, bobot) {
    // Debugging data di console
    console.log("Edit Data:", { id, kriteria_id, nama, prioritas, bobot });

    // Isi form di modal edit
    document.getElementById('edit_id_subkriteria').value = id;
    document.getElementById('edit_kriteria_id').value = kriteria_id;
    document.getElementById('edit_nama_subkriteria').value = nama;

    // Format tingkat prioritas agar sesuai dengan tipe input number
    document.getElementById('edit_tingkat_prioritas').value = parseFloat(prioritas) || 0;

    // Isi bobot dengan nilai default jika kosong
    document.getElementById('edit_bobot_subkriteria').value = parseFloat(bobot) || 0;
}
</script>
</body>
</html>


