<?php
// Panggil file koneksi database
include 'koneksi.php'; 

// Tangkap data dari form modal ruangan
$id_ruangan = $_POST['id_ruangan'];
$nama_ruangan = $_POST['nama_ruangan'];
$kapasitas = $_POST['kapasitas'];
$status = $_POST['status'];

// Query untuk memasukkan data ke tabel ruangan
// Pastikan nama tabel (ruangan) dan kolomnya SAMA PERSIS dengan di phpMyAdmin
$query = "INSERT INTO ruangan (id_ruangan, nama_ruangan, kapasitas, status) 
          VALUES ('$id_ruangan', '$nama_ruangan', '$kapasitas', '$status')";

if(mysqli_query($conn, $query)) {
    // Jika sukses, arahkan kembali ke halaman ruangan
    header("Location: ruangan.php");
} else {
    // Jika gagal, tampilkan pesan error
    echo "Gagal menambahkan data ruangan: " . mysqli_error($conn);
}
?>