<?php 
include "../tools/connection.php";

$no_kriteria = $_GET["id_kriteria"];

$query = "DELETE FROM kriteria WHERE id_kriteria = $no_kriteria";
mysqli_query($conn,$query);
header ("location:kriteriaView.php");
?>