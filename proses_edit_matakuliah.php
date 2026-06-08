<?php
include 'koneksi.php';

$kode_mk         = $_POST['kode_mk'];
$nama_matakuliah = $_POST['nama_matakuliah'];
$sks             = $_POST['sks'];
$semester        = $_POST['semester'];

// Mengambil angka baru dari kode_mk apabila kodenya ikut disesuaikan saat edit
$angka = preg_replace('/[^0-9]/', '', $kode_mk); 
$id_alat = 'A' . $angka;

$query = "UPDATE matakuliah SET 
          Nama_MK = '$nama_matakuliah', 
          SKS = '$sks', 
          Semester = '$semester',
          ID_Alat = '$id_alat'
          WHERE Kode_MK = '$kode_mk'";

if(mysqli_query($conn, $query)) {
    header("Location: matakuliah.php");
} else {
    echo "Gagal memperbarui data: " . mysqli_error($conn);
}
?>