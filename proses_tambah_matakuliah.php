<?php
include 'koneksi.php';

// Sesuaikan nama di $_POST['...'] dengan atribut 'name' di form HTML Anda
$kode_mk = $_POST['kode_mk']; 
$nama_mk = $_POST['nama_matakuliah'];
$sks     = $_POST['sks'];
$semester = $_POST['semester'];
$id_alat  = $_POST['id_alat']; // Pastikan ini sudah ada di form

// Pastikan nama kolom di bawah (kode_mk, nama_mk, dll) SAMA PERSIS dengan di database
$query = "INSERT INTO matakuliah (kode_mk, nama_mk, sks, semester, id_alat) 
          VALUES ('$kode_mk', '$nama_mk', '$sks', '$semester', '$id_alat')";

if(mysqli_query($conn, $query)) {
    header("Location: matakuliah.php");
} else {
    echo "Gagal: " . mysqli_error($conn);
}
?>