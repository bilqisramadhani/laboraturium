<?php
include 'koneksi.php';

// Query sederhana untuk mengambil data dari tabel matakuliah
$query = mysqli_query($conn, "SELECT Kode_MK, Nama_MK, SKS, Semester, ID_Alat FROM matakuliah");

if (!$query) {
    die("Query Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Matakuliah - Laboratorium</title>
    
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
        .badge-sks {
            background-color: #eef2ff;
            color: #4f46e5;
            border: 1px solid #e0e7ff;
        }
        .badge-semester {
            background-color: #fff7ed;
            color: #ea580c;
            border: 1px solid #ffedd5;
        }
        /* Style tombol link ID Alat */
        .btn-alat {
            background-color: #f1f5f9;
            color: #334155;
            border: 1px solid #cbd5e1;
            font-family: monospace;
            font-weight: 600;
            transition: all 0.2s ease;
        }
        .btn-alat:hover {
            background-color: #3b82f6;
            color: #ffffff;
            border-color: #2563eb;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

<?php include 'components/navbar.php'; ?>

<div class="container my-5">
    
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1"><i class="bi bi-book-fill text-success me-2"></i>Data Matakuliah</h2>
            <p class="text-muted mb-0">Daftar matakuliah beserta kebutuhan penempatan alat laboratorium</p>
        </div>
        <button type="button" class="btn btn-primary rounded-3 fw-semibold px-4 py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahMatakuliahModal">
            <i class="bi bi-plus-lg me-1"></i> Tambah Matakuliah
        </button>
    </div>


    <div class="card card-custom p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-3" style="width: 15%;">Kode MK</th>
                        <th style="width: 35%;">Nama Matakuliah</th>                        
                        <th class="text-center" style="width: 15%;">SKS</th>
                        <th class="text-center" style="width: 15%;">Semester</th>
                        <th class="text-center pe-3" style="width: 20%;">ID Alat</th>
                    </tr>
                </thead>
                <div class="modal fade" id="tambahMatakuliahModal" tabindex="-1" aria-labelledby="judulModalMatakuliah" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judulModalMatakuliah">Tambah Data Matakuliah</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses_tambah_matakuliah.php" method="POST">
  <div class="modal-body">
    <div class="mb-3">
        <label class="form-label">Kode MK</label>
        <input type="text" name="kode_mk" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Matakuliah</label>
        <input type="text" name="nama_matakuliah" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">ID Alat</label>
        <select name="id_alat" class="form-select" required>
            <option value="">-- Pilih Alat --</option>
            <?php
            $query_alat = mysqli_query($conn, "SELECT id_alat FROM alat");
            while($data = mysqli_fetch_assoc($query_alat)) {
                echo "<option value='".$data['id_alat']."'>".$data['id_alat']."</option>";
            }
            ?>
        </select>
    </div>
  </div>
  <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Simpan Data</button>
  </div>
</form>
                <tbody>
                    <?php 
                    if (mysqli_num_rows($query) > 0) {
                        while($row = mysqli_fetch_assoc($query)) { 
                    ?>
                        <tr>
                            <td class="ps-3">
                                <span class="badge bg-dark text-light rounded-2 px-2 py-1.5 font-monospace">
                                    <?php echo $row['Kode_MK']; ?>
                                </span>
                            </td>
                            
                            <td class="fw-bold text-dark">
                                <?php echo $row['Nama_MK']; ?>
                            </td>
                            
                            <td class="text-center">
                                <span class="badge badge-sks rounded-pill px-3 py-2 fw-semibold">
                                    <?php echo $row['SKS']; ?> SKS
                                </span>
                            </td>
                            
                            <td class="text-center">
                                <span class="badge badge-semester rounded-pill px-3 py-2 fw-semibold">
                                    Semester <?php echo $row['Semester']; ?>
                                </span>
                            </td>
                            
                            <td class="text-center pe-3">
                                <a href="detail_alat.php?id=<?php echo $row['ID_Alat']; ?>" class="btn btn-sm btn-alat rounded-2 px-3 py-1.5 shadow-sm">
                                    <i class="bi bi-cpu me-1"></i> <?php echo $row['ID_Alat']; ?>
                                </a>
                            </td>
                        </tr>
                    <?php 
                        } 
                    } else { 
                    ?>
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-journal-x fs-1 d-block mb-2"></i> Belum ada data matakuliah.
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