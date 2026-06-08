<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    
    $action               = $_POST['action'];
    $id_peminjaman        = mysqli_real_escape_string($conn, $_POST['id_peminjaman']);
    $id_alat              = mysqli_real_escape_string($conn, $_POST['id_alat']);
    $nim                  = mysqli_real_escape_string($conn, $_POST['nim']);
    $jumlah               = mysqli_real_escape_string($conn, $_POST['jumlah']);
    $status               = mysqli_real_escape_string($conn, $_POST['status']);
    
    // Menangkap data tanggal yang baru ditambahkan di form
    $tanggal_peminjaman   = mysqli_real_escape_string($conn, $_POST['tanggal_peminjaman']);
    $tanggal_pengembalian = mysqli_real_escape_string($conn, $_POST['tanggal_pengembalian']);

    if ($action === 'tambah') {
        // Logika query untuk Tambah Data Peminjaman (Sudah ditambah kolom tanggal)
        $query = "INSERT INTO peminjaman (ID_Peminjaman, Tanggal_Peminjaman, Tanggal_Pengembalian, ID_Alat, NIM, Jumlah, Status) 
                  VALUES ('$id_peminjaman', '$tanggal_peminjaman', '$tanggal_pengembalian', '$id_alat', '$nim', '$jumlah', '$status')";
        
        if (mysqli_query($conn, $query)) {
            header("Location: peminjaman.php");
            exit;
        } else {
            die("Gagal menambah data peminjaman: " . mysqli_error($conn));
        }

    } elseif ($action === 'edit') {
        // Logika query untuk Perbarui / Edit Data Peminjaman (Sudah ditambah update tanggal)
        $query = "UPDATE peminjaman SET 
                    Tanggal_Peminjaman = '$tanggal_peminjaman',
                    Tanggal_Pengembalian = '$tanggal_pengembalian',
                    ID_Alat = '$id_alat', 
                    NIM = '$nim', 
                    Jumlah = '$jumlah', 
                    Status = '$status' 
                  WHERE ID_Peminjaman = '$id_peminjaman'";
        
        if (mysqli_query($conn, $query)) {
            header("Location: peminjaman.php");
            exit;
        } else {
            die("Gagal memperbarui data peminjaman: " . mysqli_error($conn));
        }
    }

} else {
    header("Location: peminjaman.php");
    exit;
}
?>