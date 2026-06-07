<?php
include 'koneksi.php';

// Ambil data dari tabel ruangan
$query = mysqli_query($conn, "SELECT ID_Ruangan, Nama_Ruangan, Kapasitas, Status FROM ruangan");

if (!$query) {
    die("Query Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Ruangan - Laboratorium</title>
    
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
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
            transition: background-color 0.2s ease;
        }
    </style>
</head>
<body>

<?php include 'components/navbar.php'; ?>

<div class="container my-5">
    
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1"><i class="bi bi-door-closed-fill text-primary me-2"></i>Data Ruangan Laboratorium</h2>
            <p class="text-muted mb-0">Daftar ruangan, kapasitas tampung, beserta status operasional laboratorium</p>
        </div>
        <button type="button" class="btn btn-primary rounded-3 fw-semibold px-4 py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahRuanganModal">
            <i class="bi bi-plus-lg me-1"></i> Tambah Ruangan
        </button>
    </div>


    <div class="card card-custom p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-3" style="width: 15%;">ID Ruangan</th>
                        <th style="width: 30%;">Nama Ruangan</th>
                        <th class="text-center" style="width: 15%;">Kapasitas</th>
                        <th class="text-center" style="width: 20%;">Status</th>
                        <th class="text-center pe-3" style="width: 20%;">Detail</th>
                    </tr>
                </thead>
                <!-- Modal Tambah Ruangan -->
<div class="modal fade" id="tambahRuanganModal" tabindex="-1" aria-labelledby="judulModalRuangan" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judulModalRuangan">Tambah Data Ruangan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <!-- Form mengarah ke file proses_tambah_ruangan.php -->
      <form action="proses_tambah_ruangan.php" method="POST">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">ID Ruangan</label>
            <input type="text" name="id_ruangan" class="form-control" placeholder="Contoh: R05" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Nama Ruangan</label>
            <input type="text" name="nama_ruangan" class="form-control" placeholder="Contoh: Lab 5" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Kapasitas (Kursi)</label>
            <input type="number" name="kapasitas" class="form-control" placeholder="Contoh: 30" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
              <option value="Tersedia">Tersedia</option>
              <option value="Perbaikan">Perbaikan</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
      </form>

    </div>
  </div>
</div>
                <tbody>
                    <?php 
                    if (mysqli_num_rows($query) > 0) {
                        while($row = mysqli_fetch_assoc($query)) { 
                    ?>
                        <tr>
                            <td class="ps-3 fw-semibold text-secondary font-monospace">
                                <?php echo $row['ID_Ruangan']; ?>
                            </td>
                            
                            <td class="fw-bold text-dark">
                                <?php echo $row['Nama_Ruangan']; ?>
                            </td>
                            
                            <td class="text-center">
                                <span class="fw-semibold text-muted">
                                    <i class="bi bi-people me-1"></i> <?php echo $row['Kapasitas']; ?> Kursi
                                </span>
                            </td>
                            
                            <td class="text-center">
                                <?php if($row['Status'] == 'Tersedia') { ?>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-2">
                                        <i class="bi bi-check-circle-fill me-1"></i> Tersedia
                                    </span>
                                <?php } else { ?>
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3 py-2">
                                        <i class="bi bi-tools me-1"></i> Perbaikan
                                    </span>
                                <?php } ?>
                            </td>
                            
                            <td class="text-center pe-3">
                                <a href="detail_ruangan.php?id=<?php echo $row['ID_Ruangan']; ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold shadow-sm">
                                    <i class="bi bi-eye me-1"></i> Lihat Alat
                                </a>
                            </td>
                        </tr>
                    <?php 
                        } 
                    } else { 
                    ?>
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-exclamation-triangle fs-1 d-block mb-2"></i> Belum ada data ruangan.
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