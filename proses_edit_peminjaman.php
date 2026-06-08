<?php
include 'koneksi.php';
if (isset($_POST['update'])) {
    $id         = $_POST['id_peminjaman'];
    $id_alat    = $_POST['id_alat'];
    $nim        = $_POST['nim'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali= !empty($_POST['tgl_kembali']) ? "'".$_POST['tgl_kembali']."'" : "NULL";
    $jumlah     = $_POST['jumlah'];
    $status     = $_POST['status'];

    mysqli_query($conn, "UPDATE peminjaman SET 
                         ID_Alat='$id_alat', NIM='$nim',
                         Tanggal_Peminjaman='$tgl_pinjam',
                         Tanggal_Pengembalian=$tgl_kembali,
                         Jumlah='$jumlah', Status='$status'
                         WHERE ID_Peminjaman='$id'");
    header("Location: peminjaman.php");
}
?>