<?php
include 'koneksi.php';
if (isset($_POST['simpan'])) {
    $id_alat    = $_POST['id_alat'];
    $nim        = $_POST['nim'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali= !empty($_POST['tgl_kembali']) ? "'".$_POST['tgl_kembali']."'" : "NULL";
    $jumlah     = $_POST['jumlah'];
    $status     = $_POST['status'];

    mysqli_query($conn, "INSERT INTO peminjaman (ID_Alat, NIM, Tanggal_Peminjaman, Tanggal_Pengembalian, Jumlah, Status)
                         VALUES ('$id_alat','$nim','$tgl_pinjam',$tgl_kembali,'$jumlah','$status')");
    header("Location: peminjaman.php");
}
?>