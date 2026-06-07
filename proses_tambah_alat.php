<?php
// Panggil file koneksi database-mu
include 'koneksi.php'; 

// Tangkap data dari form modal
$id_alat = $_POST['id_alat'];
$id_ruangan = $_POST['id_ruangan'];
$nama_alat = $_POST['nama_alat'];
$kondisi = $_POST['kondisi'];
$jumlah_alat = $_POST['jumlah_alat'];

// Query untuk memasukkan data ke tabel alat
// Pastikan nama tabel dan nama kolomnya SAMA PERSIS dengan yang ada di phpMyAdmin
$query = "INSERT INTO alat (id_alat, id_ruangan, nama_alat, kondisi, jumlah_alat) 
          VALUES ('$id_alat', '$id_ruangan', '$nama_alat', '$kondisi', '$jumlah_alat')";

if(mysqli_query($conn, $query)) {
    // Jika berhasil, kembalikan user ke halaman alat.php
    header("Location: alat.php");
} else {
    // Jika gagal, tampilkan pesan error
    echo "Gagal menambahkan data: " . mysqli_error($conn);
}
?>