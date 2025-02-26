<?php 
include "../tools/koneksi.php";

$id_sekolah = $_GET["id_sekolah"];

$query = "DELETE FROM sekolah WHERE id_sekolah = $id_sekolah";
mysqli_query($conn,$query);
header ("location:alternatifView.php");
?>