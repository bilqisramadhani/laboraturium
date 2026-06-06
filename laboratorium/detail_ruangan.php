<?php
include 'koneksi.php';

// Menangkap ID Ruangan yang dikirim dari halaman sebelumnya
$id_ruangan = isset($_GET['id']) ? $_GET['id'] : '';

// Query mengambil daftar alat yang berada di ruangan terpilih
$query = mysqli_query($conn, "SELECT ID_Alat, Nama_Alat, Kondisi, Jumlah_Alat FROM alat WHERE ID_Ruangan = '$id_ruangan'");

if (!$query) {
    die("Query Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Alat Ruangan - <?php echo $id_ruangan; ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            background-color: #ffffff;
        }
        .table th {
            font-weight: 600;
            color: #495057;
            border-bottom: 2px solid #dee2e6;
            padding-top: 15px;
            padding-bottom: 15px;
        }
        .table td {
            vertical-align: middle;
            padding-top: 14px;
            padding-bottom: 14px;
            border-bottom: 1px solid #f1f3f5;
        }
    </style>
</head>
<body>

<?php include 'components/navbar.php'; ?>

<div class="container my-5">
    
    <a href="ruangan.php" class="btn btn-sm btn-secondary rounded-pill px-3 mb-4 shadow-sm">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Data Ruangan
    </a>

    <div class="mb-4">
        <h2 class="fw-bold text-dark mb-1">
            <i class="bi bi-cpu-fill text-success me-2"></i>Daftar Alat Pada Ruangan <span class="text-primary font-monospace"><?php echo $id_ruangan; ?></span>
        </h2>
        <p class="text-muted mb-0">Inventarisasi perangkat praktikum aktif yang ditempatkan pada ruangan ini</p>
    </div>

    <div class="card card-custom p-4">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-3" style="width: 20%;">ID Alat</th>
                        <th style="width: 40%;">Nama Alat</th>
                        <th class="text-center" style="width: 20%;">Kondisi</th>
                        <th class="text-center pe-3" style="width: 20%;">Jumlah Alat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (mysqli_num_rows($query) > 0) {
                        while($row = mysqli_fetch_assoc($query)) { 
                    ?>
                        <tr>
                            <td class="ps-3 font-monospace fw-semibold text-secondary">
                                <?php echo $row['ID_Alat']; ?>
                            </td>
                            
                            <td class="fw-bold text-dark">
                                <?php echo $row['Nama_Alat']; ?>
                            </td>
                            
                            <td class="text-center">
                                <?php if($row['Kondisi'] == 'Baik') { ?>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-2">
                                        <i class="bi bi-check-circle-fill me-1"></i> Baik
                                    </span>
                                <?php } else { ?>
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-2">
                                        <i class="bi bi-exclamation-triangle-fill me-1"></i> Rusak
                                    </span>
                                <?php } ?>
                            </td>
                            
                            <td class="text-center pe-3">
                                <span class="badge bg-dark text-light rounded-2 px-3 py-2 fw-semibold fs-7 font-monospace">
                                    <?php echo $row['Jumlah_Alat']; ?> Unit
                                </span>
                            </td>
                        </tr>
                    <?php 
                        } 
                    } else { 
                    ?>
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="bi bi-folder-x fs-1 d-block mb-2"></i> Tidak ada data alat di ruangan ini.
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>