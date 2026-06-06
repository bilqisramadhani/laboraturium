<?php
include 'koneksi.php';

// 1. Ambil data utama peminjaman + JOIN ke tabel mahasiswa untuk mengambil Nama
$query = mysqli_query($conn, "SELECT p.ID_Peminjaman, p.ID_Alat, p.NIM, m.Nama AS Nama_Mahasiswa, p.Jumlah, p.Status 
                              FROM peminjaman p
                              INNER JOIN mahasiswa m ON p.NIM = m.NIM");

// 2. Ambil data alat & mahasiswa untuk pilihan dropdown di form tambah/edit
$query_alat = mysqli_query($conn, "SELECT ID_Alat, Nama_Alat FROM alat");
$query_mhs  = mysqli_query($conn, "SELECT NIM, Nama FROM mahasiswa");

if (!$query) {
    die("Query Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peminjaman Alat - Laboratorium</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <style>
        body { background-color: #f8fafc; font-family: 'Segoe UI', system-ui, sans-serif; }
        .card-custom { border: none; border-radius: 16px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03); background-color: #ffffff; overflow: hidden; }
        .table-premium thead { background-color: #f1f5f9; }
        .table-premium th { font-weight: 700; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.05em; color: #64748b; padding: 16px 20px; border: none; }
        .table-premium tbody tr { border-bottom: 1px solid #f1f5f9; transition: all 0.2s ease; }
        .table-premium tbody tr:hover { background-color: #f8fafc; }
        .table-premium td { padding: 16px 20px; vertical-align: middle; }
        .badge-peminjaman { background-color: #f1f5f9; color: #1e293b; font-weight: 700; font-family: monospace; padding: 6px 12px; border-radius: 6px; border: 1px solid #e2e8f0; }
        .badge-alat { background-color: #eff6ff; color: #1d4ed8; font-weight: 600; font-family: monospace; padding: 6px 12px; border-radius: 6px; border: 1px solid #dbeafe; }
        .badge-nim { background-color: #f8fafc; color: #475569; font-weight: 600; padding: 6px 12px; border-radius: 6px; border: 1px solid #e2e8f0; }
        .qty-text { font-weight: 700; color: #0f172a; }
        .form-control, .form-select { border-radius: 8px; padding: 0.6rem 1rem; border: 1px solid #cbd5e1; background-color: #f8fafc; }
        .form-control:focus, .form-select:focus { background-color: #fff; border-color: #2563eb; box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1); }

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
            <h2 class="fw-bold text-dark mb-1"><i class="bi bi-journal-bookmark-fill text-primary me-2"></i>Log Peminjaman Alat</h2>
            <p class="text-muted mb-0">Memantau dan mengelola transaksi sirkuit perangkat laboratorium</p>
        </div>
        <button type="button" class="btn btn-primary rounded-3 fw-semibold px-4 py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahPeminjaman">
            <i class="bi bi-plus-lg me-1"></i> Tambah Peminjaman
        </button>
    </div>

    <div class="card card-custom p-2">
        <div class="table-responsive">
            <table class="table table-premium align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4" style="width: 12%;">ID Peminjaman</th>
                        <th style="width: 12%;">Kode Alat</th>
                        <th style="width: 15%;">NIM</th>
                        <th style="width: 23%;">Nama Mahasiswa</th>
                        <th class="text-center" style="width: 13%;">Jumlah Pinjam</th>
                        <th class="text-center" style="width: 10%;">Status</th>
                        <th class="text-center pe-4" style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (mysqli_num_rows($query) > 0) {
                        while($row = mysqli_fetch_assoc($query)) { 
                    ?>
                        <tr>
                            <td class="ps-4"><span class="badge-peminjaman"><?php echo $row['ID_Peminjaman']; ?></span></td>
                            <td><span class="badge-alat"><i class="bi bi-cpu me-1"></i><?php echo $row['ID_Alat']; ?></span></td>
                            <td><span class="badge-nim"><i class="bi bi-person-badge text-muted me-1"></i><?php echo $row['NIM']; ?></span></td>
                            <td><strong class="text-dark"><?php echo $row['Nama_Mahasiswa']; ?></strong></td>
                            <td class="text-center"><span class="qty-text"><?php echo $row['Jumlah']; ?> <span class="text-muted fw-normal small">Unit</span></span></td>
                            <td class="text-center">
                                <?php if(trim($row['Status']) == 'Selesai') { ?>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-2 fw-semibold w-100 d-inline-block">
                                        <i class="bi bi-check-circle-fill me-1"></i> Selesai
                                    </span>
                                <?php } else { ?>
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3 py-2 fw-semibold w-100 d-inline-block">
                                        <i class="bi bi-clock-history me-1"></i> Dipinjam
                                    </span>
                                <?php } ?>
                            </td>
                            <td class="text-center pe-4">
                                <button type="button" class="btn btn-sm btn-outline-secondary rounded-2 me-1 btn-edit" 
                                        data-id="<?php echo $row['ID_Peminjaman']; ?>"
                                        data-alat="<?php echo $row['ID_Alat']; ?>"
                                        data-nim="<?php echo $row['NIM']; ?>"
                                        data-jumlah="<?php echo $row['Jumlah']; ?>"
                                        data-status="<?php echo $row['Status']; ?>">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <a href="proses_hapus_peminjaman.php?id=<?php echo $row['ID_Peminjaman']; ?>" 
                                   class="btn btn-sm btn-outline-danger rounded-2" 
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus data peminjaman <?php echo $row['ID_Peminjaman']; ?>?')">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
                            </td>
                        </tr>
                    <?php 
                        } 
                    } else { 
                    ?>
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-clipboard-x text-muted mb-3 d-block" style="font-size: 3rem;"></i>
                                <h5 class="fw-bold text-secondary mb-1">Belum Ada Transaksi</h5>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahPeminjaman" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 16px;">
            <div class="modal-header border-bottom-0 pb-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                <h5 class="modal-title fw-bold text-dark mb-0">
                    <i class="bi bi-journal-plus text-primary me-2"></i>Tambah Log Peminjaman
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="proses_peminjaman.php" method="POST">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">ID Peminjaman</label>
                        <input type="text" class="form-control font-monospace" name="id_peminjaman" placeholder="Contoh: P11" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Pilih Alat Laboratorium</label>
                        <select class="form-select" name="id_alat" required>
                            <option value="" disabled selected>-- Pilih Perangkat --</option>
                            <?php mysqli_data_seek($query_alat, 0); while($alat = mysqli_fetch_assoc($query_alat)) { ?>
                                <option value="<?php echo $alat['ID_Alat']; ?>"><?php echo $alat['ID_Alat'] . ' - ' . $alat['Nama_Alat']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">NIM Mahasiswa Peminjam</label>
                        <select class="form-select" name="nim" required>
                            <option value="" disabled selected>-- Pilih Mahasiswa --</option>
                            <?php mysqli_data_seek($query_mhs, 0); while($mhs = mysqli_fetch_assoc($query_mhs)) { ?>
                                <option value="<?php echo $mhs['NIM']; ?>"><?php echo $mhs['NIM'] . ' - ' . $mhs['Nama']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Jumlah Unit (Qty)</label>
                        <input type="number" class="form-control" name="jumlah" min="1" placeholder="1" required>
                    </div>
                    <div class="mb-1">
                        <label class="form-label small fw-semibold text-secondary">Status Operasional</label>
                        <select class="form-select" name="status" required>
                            <option value="Dipinjam" selected>Dipinjam</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0 pb-4 px-4 d-flex gap-2">
                    <button type="button" class="btn btn-light border w-50 fw-semibold rounded-3 py-2" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="action" value="tambah" class="btn btn-primary w-50 fw-semibold rounded-3 py-2 shadow-sm">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditPeminjaman" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 16px;">
            <div class="modal-header border-bottom-0 pb-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                <h5 class="modal-title fw-bold text-dark mb-0">
                    <i class="bi bi-pencil-square text-warning me-2"></i>Perbarui Status Peminjaman
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="proses_peminjaman.php" method="POST">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">ID Peminjaman (Tetap)</label>
                        <input type="text" class="form-control font-monospace bg-light" id="edit_id" name="id_peminjaman" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Perangkat Alat</label>
                        <select class="form-select" id="edit_alat" name="id_alat" required>
                            <?php mysqli_data_seek($query_alat, 0); while($alat = mysqli_fetch_assoc($query_alat)) { ?>
                                <option value="<?php echo $alat['ID_Alat']; ?>"><?php echo $alat['ID_Alat'] . ' - ' . $alat['Nama_Alat']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Mahasiswa Peminjam</label>
                        <select class="form-select" id="edit_nim" name="nim" required>
                            <?php mysqli_data_seek($query_mhs, 0); while($mhs = mysqli_fetch_assoc($query_mhs)) { ?>
                                <option value="<?php echo $mhs['NIM']; ?>"><?php echo $mhs['NIM'] . ' - ' . $mhs['Nama']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Jumlah Unit (Qty)</label>
                        <input type="number" class="form-control" id="edit_jumlah" name="jumlah" min="1" required>
                    </div>
                    <div class="mb-1">
                        <label class="form-label small fw-semibold text-secondary">Ubah Status Transaksi</label>
                        <select class="form-select" id="edit_status" name="status" required>
                            <option value="Dipinjam">Dipinjam</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0 pb-4 px-4 d-flex gap-2">
                    <button type="button" class="btn btn-light border w-50 fw-semibold rounded-3 py-2" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="action" value="edit" class="btn btn-warning text-white w-50 fw-semibold rounded-3 py-2 shadow-sm">Perbarui Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const editButtons = document.querySelectorAll('.btn-edit');
    const modalEdit = new bootstrap.Modal(document.getElementById('modalEditPeminjaman'));

    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('edit_id').value = this.dataset.id;
            document.getElementById('edit_alat').value = this.dataset.alat;
            document.getElementById('edit_nim').value = this.dataset.nim;
            document.getElementById('edit_jumlah').value = this.dataset.jumlah;
            document.getElementById('edit_status').value = this.dataset.status.trim();
            modalEdit.show();
        });
    });
</script>
</body>
</html>