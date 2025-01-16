<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "db_survei";

// Koneksi ke database
$koneksi = mysqli_connect($host, $user, $password, $db);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
