<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    // Ambil data dari form modal
    $nim           = mysqli_real_escape_string($conn, $_POST['nim']);
    $nama          = mysqli_real_escape_string($conn, $_POST['nama']);
    $jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $nomor_hp      = mysqli_real_escape_string($conn, $_POST['nomor_hp']);
    $kode_mk       = mysqli_real_escape_string($conn, $_POST['kode_mk']);

    // Cek apakah NIM sudah terdaftar untuk menghindari duplikasi key
    $cek_nim = mysqli_query($conn, "SELECT NIM FROM mahasiswa WHERE NIM = '$nim'");
    
    if (mysqli_num_rows($cek_nim) > 0) {
        echo "<script>
                alert('Gagal! NIM sudah terdaftar di dalam sistem.');
                window.location.href='mahasiswa.php';
              </script>";
    } else {
        // Jalankan perintah Insert ke tabel mahasiswa
        $insert = mysqli_query($conn, "INSERT INTO mahasiswa (NIM, Nama, Jenis_Kelamin, Nomor_HP, Kode_MK) 
                                       VALUES ('$nim', '$nama', '$jenis_kelamin', '$nomor_hp', '$kode_mk')");
        
        if ($insert) {
            // Jika sukses, kembali ke halaman mahasiswa dengan aman
            header("Location: mahasiswa.php");
            exit;
        } else {
            // Tampilkan error jika query bermasalah
            echo "Error: " . mysqli_error($conn);
        }
    }
} else {
    // Jika diakses ilegal tanpa form submit, tendang balik ke halaman utama
    header("Location: mahasiswa.php");
    exit;
}
?>