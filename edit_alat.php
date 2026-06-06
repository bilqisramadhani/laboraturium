<?php
include 'koneksi.php';

if (isset($_POST['update']) || isset($_POST['update_dari_ruangan'])) {
    
    // Tangkap data kiriman form
    $id_alat     = mysqli_real_escape_string($conn, $_POST['id_alat']);
    $jumlah_alat = mysqli_real_escape_string($conn, $_POST['jumlah_alat']);
    $kondisi     = mysqli_real_escape_string($conn, $_POST['kondisi']);

    // Proses Update ke database
    $query = "UPDATE alat SET Jumlah_Alat = '$jumlah_alat', Kondisi = '$kondisi' WHERE ID_Alat = '$id_alat'";
    $eksekusi = mysqli_query($conn, $query);

    if ($eksekusi) {
        // Jika diedit melalui halaman ruangan.php?id=...
        if (isset($_POST['update_dari_ruangan'])) {
            $id_ruangan = mysqli_real_escape_string($conn, $_POST['id_ruangan']);
            header("Location: ruangan.php?id=" . $id_ruangan);
            exit;
        } 
        // Jika diedit melalui halaman alat.php utama
        else {
            header("Location: alat.php");
            exit;
        }
    } else {
        die("Gagal memperbarui data alat: " . mysqli_error($conn));
    }
} else {
    header("Location: alat.php");
    exit;
}
?>