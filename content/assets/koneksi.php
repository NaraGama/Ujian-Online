<?php
// koneksi.php
// File ini digunakan untuk koneksi ke database

$host = "localhost";
$user = "root";
$pass = "";
$db   = "ujian_online"; // Ganti dengan nama database kamu

// Buat koneksi
$koneksi = new mysqli($host, $user, $pass, $db);

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}
?>
