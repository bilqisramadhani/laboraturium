<?php
include 'koneksi.php';

// Ambil data alat laboratorium
$query = mysqli_query($conn, "SELECT ID_Alat, ID_Ruangan, Nama_Alat, Kondisi, Jumlah_Alat FROM alat");

if (!$query) {
    die("Query Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Alat Laboratorium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8fafc; font-family: 'Segoe UI', system-ui, sans-serif; }
        .card-custom { border: none; border-radius: 16px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03); background-color: #ffffff; overflow: hidden; }
        .table-premium thead { background-color: #e2e8f0; }
        .table-premium th { font-weight: 700; color: #334155; padding: 16px 20px; border: none; }
        .table-premium tbody tr { border-bottom: 1px solid #f1f5f9; transition: all 0.2s ease; }
        .table-premium tbody tr:hover { background-color: #f8fafc; }
        .table-premium td { padding: 16px 20px; vertical-align: middle; }
        .form-control, .form-select { border-radius: 8px; padding: 0.6rem 1rem; border: 1px solid #cbd5e1; background-color: #f8fafc; }
        .form-control:focus, .form-select:focus { background-color: #fff; border-color: #2563eb; box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1); }
        
        /* Jaminan tombol close X modal responsif */
        .modal-header .btn-close {
            position: relative !important;
            z-index: 1060 !important;
            padding: 0.5rem !important;
            margin: 0 !important;
            cursor: pointer !important;
        }
    </style>
</head>
<body>

<?php include 'components/navbar.php'; ?>

<div class="container my-5">
    
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Data Alat Laboratorium</h2>
            <p class="text-muted mb-0">Daftar inventaris perangkat, kuantitas unit, beserta status kelayakan operasional</p>
        </div>
        <button type="button" class="btn btn-primary rounded-3 fw-semibold px-4 py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahAlatModal">
            <i class="bi bi-plus-lg me-1"></i> Tambah Alat
        </button>
    </div>

     
    <div class="card card-custom p-2">
        <div class="table-responsive">
            <table class="table table-premium align-middle mb-0">
                <thead>
                    <tr>
                        <th>ID Alat</th>
                        <th>ID Ruangan</th>
                        <th>Nama Alat</th>
                        <th>Kondisi</th>
                        <th>Jumlah Alat</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
<div class="modal fade" id="tambahAlatModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judulModal">Tambah Data Alat Laboratorium</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="proses_tambah_alat.php" method="POST">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">ID Alat</label>
            <input type="text" name="id_alat" class="form-control" placeholder="Contoh: A09" required>
          </div>
          <div class="mb-3">
            <label class="form-label">ID Ruangan</label>
            <select name="id_ruangan" class="form-select" required>
              <?php
              // Ambil data ruangan dari database
              $query_ruangan = mysqli_query($conn, "SELECT id_ruangan, nama_ruangan FROM ruangan");
              while ($ruang = mysqli_fetch_assoc($query_ruangan)) {
                  echo "<option value='" . $ruang['id_ruangan'] . "'>" . $ruang['id_ruangan'] . " - " . $ruang['nama_ruangan'] . "</option>";
              }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Nama Alat</label>
            <input type="text" name="nama_alat" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Kondisi</label>
            <select name="kondisi" class="form-select" required>
              <option value="Baik">Baik</option>
              <option value="Rusak">Rusak</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Jumlah Alat (Unit)</label>
            <input type="number" name="jumlah_alat" class="form-control" required>
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
                    <?php while($row = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td class="fw-bold text-secondary"><?php echo $row['ID_Alat']; ?></td>
                            <td><span class="badge bg-light text-dark border px-2 py-1.5 rounded"><?php echo $row['ID_Ruangan']; ?></span></td>
                            <td class="fw-semibold text-dark"><?php echo $row['Nama_Alat']; ?></td>
                            <td>
                                <?php if(trim($row['Kondisi']) == 'Baik') { ?>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1.5 rounded-pill fw-semibold">
                                        <i class="bi bi-check-circle me-1"></i> Baik
                                    </span>
                                <?php } else { ?>
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1.5 rounded-pill fw-semibold">
                                        <i class="bi bi-exclamation-triangle me-1"></i> Rusak
                                    </span>
                                <?php } ?>
                            </td>
                            <td class="fw-bold text-dark"><?php echo $row['Jumlah_Alat']; ?> <span class="text-muted fw-normal small">Unit</span></td>
                            
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-outline-primary rounded-2 btn-edit-alat"
                                        data-id="<?php echo $row['ID_Alat']; ?>"
                                        data-nama="<?php echo $row['Nama_Alat']; ?>"
                                        data-kondisi="<?php echo $row['Kondisi']; ?>"
                                        data-jumlah="<?php echo $row['Jumlah_Alat']; ?>">
                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditAlat" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 16px;">
            
            <div class="modal-header border-bottom-0 pb-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                <h5 class="modal-title fw-bold text-dark mb-0">
                    <i class="bi bi-cpu text-primary me-2"></i>Ubah Data Alat
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="edit_alat.php" method="POST">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">ID Alat</label>
                        <input type="text" class="form-control bg-light font-monospace" id="edit_id_alat" name="id_alat" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Nama Perangkat</label>
                        <input type="text" class="form-control bg-light fw-semibold" id="edit_nama_alat" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Jumlah Stok Alat (Unit)</label>
                        <input type="number" class="form-control" id="edit_jumlah_alat" name="jumlah_alat" min="0" required>
                    </div>
                    
                    <div class="mb-1">
                        <label class="form-label small fw-semibold text-secondary">Status Kondisi Alat</label>
                        <select class="form-select" id="edit_kondisi_alat" name="kondisi" required>
                            <option value="Baik">Baik</option>
                            <option value="Rusak">Rusak</option>
                        </select>
                    </div>
                </div>
                
                <div class="modal-footer border-top-0 pt-0 pb-4 px-4 d-flex gap-2">
                    <button type="button" class="btn btn-light border w-50 fw-semibold rounded-3 py-2" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="update" class="btn btn-primary w-50 fw-semibold rounded-3 py-2 shadow-sm">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const tombolEdit = document.querySelectorAll('.btn-edit-alat');
    const modalEditAlat = new bootstrap.Modal(document.getElementById('modalEditAlat'));

    tombolEdit.forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('edit_id_alat').value = this.dataset.id;
            document.getElementById('edit_nama_alat').value = this.dataset.nama;
            document.getElementById('edit_jumlah_alat').value = this.dataset.jumlah;
            document.getElementById('edit_kondisi_alat').value = this.dataset.kondisi.trim();
            modalEditAlat.show();
        });
    });
</script>
</body>
</html>