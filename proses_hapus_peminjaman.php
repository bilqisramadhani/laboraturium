<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_peminjaman = mysqli_real_escape_string($conn, $_GET['id']);

    // Logika query hapus data transaksi
    $query = "DELETE FROM peminjaman WHERE ID_Peminjaman = '$id_peminjaman'";
    
    if (mysqli_query($conn, $query)) {
        header("Location: peminjaman.php");
        exit;
    } else {
        die("Gagal menghapus data peminjaman: " . mysqli_error($conn));
    }
} else {
    header("Location: peminjaman.php");
    exit;
}
?>