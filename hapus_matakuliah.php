<?php
include 'koneksi.php';

// Tangkap ID dari URL (Kode MK)
$id = $_GET['id'];

// Query untuk menghapus data
$query = "DELETE FROM matakuliah WHERE Kode_MK = '$id'";

if(mysqli_query($conn, $query)) {
    // Jika berhasil, kembali ke halaman matakuliah
    header("Location: matakuliah.php");
} else {
    echo "Gagal menghapus data: " . mysqli_error($conn);
}
?>