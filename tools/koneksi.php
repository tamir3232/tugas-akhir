<?php
$servername = "localhost";
$database = "skripsi";
$username = "root";
$password = "newpassword";

$conn = mysqli_connect($servername, $username, $password, $database);
// Cek
if (!$conn) {
    die("Koneksi Gagal : " . mysqli_connect_error());
} 