<?php
session_start();
include 'koneksi.php'; // Pastikan file koneksi sudah benar

// Query untuk mengambil data peminjaman digabung dengan data alat
$query = mysqli_query($conn, "SELECT peminjaman.*, alat.Nama_Alat 
                              FROM peminjaman 
                              JOIN alat ON peminjaman.ID_Alat = alat.ID_Alat");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Log Peminjaman Alat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h4 class="mb-0 fw-bold"><i class="bi bi-journal-text"></i> Log Peminjaman Alat</h4>
        </div>
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID PEMINJAMAN</th>
                        <th>KODE ALAT</th>
                        <th>NAMA ALAT</th> <th>NIM MAHASISWA</th>
                        <th>JUMLAH PINJAM</th>
                        <th>STATUS</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($query)): ?>
                    <tr>
                        <td><?php echo $row['ID_Peminjaman']; ?></td>
                        <td><?php echo $row['ID_Alat']; ?></td>
                        <td class="fw-semibold"><?php echo $row['Nama_Alat']; ?></td> <td><?php echo $row['NIM']; ?></td>
                        <td><?php echo $row['Jumlah']; ?> Unit</td>
                        <td>
                            <?php 
                                $badgeClass = ($row['Status'] == 'Selesai') ? 'bg-success' : 'bg-warning';
                            ?>
                            <span class="badge <?php echo $badgeClass; ?> text-dark">
                                <?php echo $row['Status']; ?>
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>