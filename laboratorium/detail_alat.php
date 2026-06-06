<?php
include 'koneksi.php';

$id_alat = isset($_GET['id']) ? $_GET['id'] : '';

// Ambil data detail alat berdasarkan ID yang diklik
$query = mysqli_query($conn, "SELECT * FROM alat WHERE ID_Alat = '$id_alat'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data alat tidak ditemukan atau ID salah.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Alat - <?php echo $data['Nama_Alat']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', sans-serif; }
        .card-detail { border: none; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

<?php include 'components/navbar.php'; ?>

<div class="container my-5">
    <a href="matakuliah.php" class="btn btn-secondary mb-4 btn-sm rounded-2">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Matakuliah
    </a>

    <div class="card card-detail p-4 max-width-md mx-auto" style="max-width: 600px;">
        <div class="text-center mb-4">
            <div class="bg-primary-subtle text-primary rounded-circle d-inline-flex p-4 mb-3">
                <i class="bi bi-cpu fs-1"></i>
            </div>
            <h3 class="fw-bold mb-1"><?php echo $data['Nama_Alat']; ?></h3>
            <span class="badge bg-dark font-monospace px-3 py-1.5 rounded-pill">ID Alat: <?php echo $data['ID_Alat']; ?></span>
        </div>

        <hr class="text-muted">

        <div class="row g-3">
            <div class="col-6">
                <small class="text-muted d-block">ID Ruangan</small>
                <span class="fw-semibold text-dark fs-5"><i class="bi bi-door-closed me-1 text-secondary"></i> <?php echo $data['ID_Ruangan']; ?></span>
            </div>
            <div class="col-6">
                <small class="text-muted d-block">Kondisi Alat</small>
                <?php if ($data['Kondisi'] == 'Baik') { ?>
                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill mt-1"><i class="bi bi-check-circle-fill me-1"></i> Baik</span>
                <?php } else { ?>
                    <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill mt-1"><i class="bi bi-exclamation-triangle-fill me-1"></i> Rusak</span>
                <?php } ?>
            </div>
            <div class="col-12 mt-3">
                <small class="text-muted d-block">Jumlah Tersedia</small>
                <span class="fw-bold text-primary fs-4"><?php echo $data['Jumlah_Alat']; ?> Unit</span>
            </div>
        </div>
    </div>
</div>

</body>
</html>