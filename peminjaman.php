<?php
include 'koneksi.php';

$query = mysqli_query($conn, "SELECT peminjaman.*, mahasiswa.Nama 
                              FROM peminjaman 
                              JOIN mahasiswa ON peminjaman.NIM = mahasiswa.NIM");

$query_mhs = mysqli_query($conn, "SELECT NIM, Nama FROM mahasiswa");
$query_alat = mysqli_query($conn, "SELECT ID_Alat, Nama_Alat FROM alat");

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
        .table-premium td { padding: 16px 20px; vertical-align: middle; }
        .badge-peminjaman { background-color: #f1f5f9; color: #1e293b; font-weight: 700; font-family: monospace; padding: 6px 12px; border-radius: 6px; border: 1px solid #e2e8f0; }
        .badge-alat { background-color: #eff6ff; color: #1d4ed8; font-weight: 600; font-family: monospace; padding: 6px 12px; border-radius: 6px; border: 1px solid #dbeafe; }
        .badge-nim { background-color: #f8fafc; color: #475569; font-weight: 600; padding: 6px 12px; border-radius: 6px; border: 1px solid #e2e8f0; }
        .form-control, .form-select { border-radius: 8px; padding: 0.6rem 1rem; border: 1px solid #cbd5e1; background-color: #f8fafc; }
        .form-control:focus, .form-select:focus { background-color: #fff; border-color: #2563eb; box-shadow: 0 0 0 4px rgba(37,99,235,0.1); }
    </style>
</head>
<body>

<?php include 'components/navbar.php'; ?>

<div class="container my-5">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1"><i class="bi bi-journal-bookmark-fill text-primary me-2"></i>Log Peminjaman Alat</h2>
        </div>
        <button type="button" class="btn btn-primary rounded-3 fw-semibold px-4 py-2" data-bs-toggle="modal" data-bs-target="#modalTambahPeminjaman">
            <i class="bi bi-plus-lg me-1"></i> Tambah Peminjaman
        </button>
    </div>

    <div class="card card-custom p-2">
        <div class="table-responsive">
            <table class="table table-premium align-middle mb-0">
                <thead>
                    <tr>
                        <th>ID Peminjaman</th>
                        <th>ID Alat</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th class="text-center">Tgl Peminjaman</th>
                        <th class="text-center">Tgl Pengembalian</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (mysqli_num_rows($query) > 0) {
                        while($row = mysqli_fetch_assoc($query)) { 
                    ?>
                        <tr>
                            <td><span class="badge-peminjaman"><?php echo $row['ID_Peminjaman']; ?></span></td>
                            <td><span class="badge-alat"><?php echo $row['ID_Alat']; ?></span></td>
                            <td><span class="badge-nim"><?php echo $row['NIM']; ?></span></td>
                            <td class="text-dark"><strong><?php echo $row['Nama']; ?></strong></td>
                            <td class="text-center"><?php echo (!empty($row['Tanggal_Peminjaman'])) ? date('d M Y', strtotime($row['Tanggal_Peminjaman'])) : '-'; ?></td>
                            <td class="text-center"><?php echo (!empty($row['Tanggal_Pengembalian'])) ? date('d M Y', strtotime($row['Tanggal_Pengembalian'])) : '-'; ?></td>
                            <td class="text-center"><?php echo $row['Jumlah']; ?></td>
                            <td class="text-center">
                                <?php if(trim($row['Status']) == 'Selesai') { ?>
                                    <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">Selesai</span>
                                <?php } else { ?>
                                    <span class="badge bg-warning-subtle text-warning rounded-pill px-3 py-2">Dipinjam</span>
                                <?php } ?>
                            </td>
                            <td class="text-center text-nowrap">
                                <button type="button" class="btn btn-sm btn-outline-secondary rounded-2 me-1 btn-edit"
                                        data-id="<?php echo $row['ID_Peminjaman']; ?>"
                                        data-alat="<?php echo $row['ID_Alat']; ?>"
                                        data-nim="<?php echo $row['NIM']; ?>"
                                        data-tgl-pinjam="<?php echo $row['Tanggal_Peminjaman']; ?>"
                                        data-tgl-kembali="<?php echo $row['Tanggal_Pengembalian']; ?>"
                                        data-jumlah="<?php echo $row['Jumlah']; ?>"
                                        data-status="<?php echo $row['Status']; ?>">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <a href="proses_hapus_peminjaman.php?id=<?php echo $row['ID_Peminjaman']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus data?')">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } } else { ?>
                        <tr><td colspan="9" class="text-center py-5">Belum Ada Transaksi</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ===== MODAL TAMBAH PEMINJAMAN ===== -->
<div class="modal fade" id="modalTambahPeminjaman" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius:16px;">
            <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
                <h5 class="modal-title fw-bold text-dark">
                    <i class="bi bi-plus-circle-fill text-primary me-2"></i>Tambah Peminjaman
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="proses_tambah_peminjaman.php" method="POST">
                <div class="modal-body p-4">

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Alat</label>
                        <select class="form-select" name="id_alat" required>
                            <option value="" disabled selected>Pilih alat</option>
                            <?php 
                                mysqli_data_seek($query_alat, 0);
                                while($alat = mysqli_fetch_assoc($query_alat)) { ?>
                                <option value="<?php echo $alat['ID_Alat']; ?>">
                                    <?php echo $alat['ID_Alat'] . ' - ' . $alat['Nama_Alat']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Mahasiswa (NIM)</label>
                        <select class="form-select" name="nim" required>
                            <option value="" disabled selected>Pilih mahasiswa</option>
                            <?php 
                                mysqli_data_seek($query_mhs, 0);
                                while($mhs = mysqli_fetch_assoc($query_mhs)) { ?>
                                <option value="<?php echo $mhs['NIM']; ?>">
                                    <?php echo $mhs['NIM'] . ' - ' . $mhs['Nama']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Tanggal Peminjaman</label>
                        <input type="date" class="form-control" name="tgl_pinjam" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Tanggal Pengembalian</label>
                        <input type="date" class="form-control" name="tgl_kembali">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" min="1" value="1" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-semibold text-secondary">Status</label>
                        <select class="form-select" name="status" required>
                            <option value="Dipinjam" selected>Dipinjam</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer border-top-0 pb-4 px-4 gap-2">
                    <button type="button" class="btn btn-light border w-50 fw-semibold rounded-3 py-2" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="simpan" class="btn btn-primary w-50 fw-semibold rounded-3 py-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ===== MODAL EDIT PEMINJAMAN ===== -->
<div class="modal fade" id="modalEditPeminjaman" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius:16px;">
            <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
                <h5 class="modal-title fw-bold text-dark">
                    <i class="bi bi-pencil-square text-warning me-2"></i>Edit Peminjaman
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="proses_edit_peminjaman.php" method="POST">
                <div class="modal-body p-4">

                    <input type="hidden" name="id_peminjaman" id="edit_id">

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Alat</label>
                        <select class="form-select" name="id_alat" id="edit_alat" required>
                            <?php 
                                mysqli_data_seek($query_alat, 0);
                                while($alat = mysqli_fetch_assoc($query_alat)) { ?>
                                <option value="<?php echo $alat['ID_Alat']; ?>">
                                    <?php echo $alat['ID_Alat'] . ' - ' . $alat['Nama_Alat']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Mahasiswa (NIM)</label>
                        <select class="form-select" name="nim" id="edit_nim" required>
                            <?php 
                                mysqli_data_seek($query_mhs, 0);
                                while($mhs = mysqli_fetch_assoc($query_mhs)) { ?>
                                <option value="<?php echo $mhs['NIM']; ?>">
                                    <?php echo $mhs['NIM'] . ' - ' . $mhs['Nama']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Tanggal Peminjaman</label>
                        <input type="date" class="form-control" name="tgl_pinjam" id="edit_tgl_pinjam" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Tanggal Pengembalian</label>
                        <input type="date" class="form-control" name="tgl_kembali" id="edit_tgl_kembali">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" id="edit_jumlah" min="1" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-semibold text-secondary">Status</label>
                        <select class="form-select" name="status" id="edit_status" required>
                            <option value="Dipinjam">Dipinjam</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer border-top-0 pb-4 px-4 gap-2">
                    <button type="button" class="btn btn-light border w-50 fw-semibold rounded-3 py-2" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="update" class="btn btn-warning w-50 fw-semibold rounded-3 py-2">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const modalEdit = new bootstrap.Modal(document.getElementById('modalEditPeminjaman'));

    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('edit_id').value           = this.dataset.id;
            document.getElementById('edit_alat').value         = this.dataset.alat;
            document.getElementById('edit_nim').value          = this.dataset.nim;
            document.getElementById('edit_tgl_pinjam').value   = this.dataset.tglPinjam;
            document.getElementById('edit_tgl_kembali').value  = this.dataset.tglKembali;
            document.getElementById('edit_jumlah').value       = this.dataset.jumlah;
            document.getElementById('edit_status').value       = this.dataset.status.trim();
            modalEdit.show();
        });
    });
</script>
</body>
</html>