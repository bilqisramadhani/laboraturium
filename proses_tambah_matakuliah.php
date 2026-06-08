<?php
include 'koneksi.php';

// Menangkap data input dari form modal tambah matakuliah
$kode_mk         = $_POST['kode_mk']; // Mengambil value input name="kode_mk"
$nama_matakuliah = $_POST['nama_matakuliah'];
$sks             = $_POST['sks'];
$semester        = $_POST['semester'];

// LOGIKA OTOMATISASI ID ALAT (Contoh: MK07 -> Ambil angka '07' -> gabung jadi 'A07')
$angka = preg_replace('/[^0-9]/', '', $kode_mk); 
$id_alat = 'A' . $angka; 

// Menggunakan nama field database asli (case-sensitive)
$query = "INSERT INTO matakuliah (Kode_MK, Nama_MK, SKS, Semester, ID_Alat) 
          VALUES ('$kode_mk', '$nama_matakuliah', '$sks', '$semester', '$id_alat')";

if(mysqli_query($conn, $query)) {
    header("Location: matakuliah.php");
} else {
    echo "Gagal menambahkan data: " . mysqli_error($conn);
}
?>