<?php
include 'koneksi.php';

// Ambil data untuk tabel mahasiswa
$query = mysqli_query($conn, "SELECT NIM, Nama, Jenis_Kelamin, Nomor_HP, Kode_MK FROM mahasiswa");

// Ambil data mata kuliah untuk pilihan dropdown di Form
$query_mk = mysqli_query($conn, "SELECT Kode_MK, Nama_MK FROM matakuliah");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa - Laboratorium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8fafc; font-family: 'Segoe UI', sans-serif; }
        .card-custom { border: none; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); background: #fff; }
        .table-premium thead { background-color: #f1f5f9; }
        .table-premium th { font-weight: 700; color: #64748b; padding: 16px 20px; font-size: 0.8rem; text-transform: uppercase; border: none; }
        .table-premium td { padding: 16px 20px; vertical-align: middle; }
        .badge-nim { background-color: #f1f5f9; color: #475569; font-weight: 600; padding: 6px 12px; border-radius: 6px; }
        .badge-mk { background-color: #1e293b; color: #fff; font-weight: 700; padding: 6px 12px; border-radius: 6px; }
        .form-control, .form-select { border-radius: 8px; padding: 0.6rem 1rem; border: 1px solid #cbd5e1; background-color: #f8fafc; }
        .form-control:focus, .form-select:focus { background-color: #fff; border-color: #2563eb; box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1); }
        
        /* CSS Tambahan menjamin tombol X bisa diklik di lapisan terdepan */
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
            <h2 class="fw-bold text-dark mb-1"><i class="bi bi-people-fill text-primary me-2"></i>Data Mahasiswa</h2>
            <p class="text-muted mb-0">Kelola dan lihat daftar mahasiswa yang terdaftar di laboratorium</p>
        </div>
        <button type="button" class="btn btn-primary rounded-3 fw-semibold px-4 py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahMahasiswa">
            <i class="bi bi-plus-lg me-1"></i> Tambah Mahasiswa
        </button>
    </div>

    <div class="card card-custom p-2">
        <div class="table-responsive">
            <table class="table table-premium align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">NIM</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>No HP</th>
                        <th class="pe-4">Kode MK</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td class="ps-4"><span class="badge-nim font-monospace"><?php echo $row['NIM']; ?></span></td>
                            <td class="fw-bold text-dark"><?php echo $row['Nama']; ?></td>
                            <td>
                                <?php if($row['Jenis_Kelamin'] == 'Laki-laki') { ?>
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-1.5"><i class="bi bi-gender-male me-1"></i> Laki-laki</span>
                                <?php } else { ?>
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-1.5"><i class="bi bi-gender-female me-1"></i> Perempuan</span>
                                <?php } ?>
                            </td>
                            <td class="text-secondary"><i class="bi bi-telephone text-muted me-2"></i><?php echo $row['Nomor_HP']; ?></td>
                            <td class="pe-4"><span class="badge-mk font-monospace"><?php echo $row['Kode_MK']; ?></span></td>
                            </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahMahasiswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 16px;">
            
            <div class="modal-header border-bottom-0 pb-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                <h5 class="modal-title fw-bold text-dark" id="modalTambahLabel">
                    <i class="bi bi-person-plus-fill text-primary me-2"></i>Registrasi Mahasiswa Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="proses_tambah_mahasiswa.php" method="POST">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Nomor Induk Mahasiswa (NIM)</label>
                        <input type="text" class="form-control font-monospace" name="nim" placeholder="Contoh: 23010101" required autocomplete="off">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan nama lengkap" required autocomplete="off">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Jenis Kelamin</label>
                        <select class="form-select" name="jenis_kelamin" required>
                            <option value="" disabled selected>Pilih jenis kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Nomor Handphone (WhatsApp)</label>
                        <input type="text" class="form-control" name="nomor_hp" placeholder="Contoh: 08123456789" required autocomplete="off">
                    </div>
                    
                    <div class="mb-2">
                        <label class="form-label small fw-semibold text-secondary">Kelas Mata Kuliah</label>
                        <select class="form-select" name="kode_mk" required>
                            <option value="" disabled selected>Pilih mata kuliah yang diikuti</option>
                            <?php while($mk = mysqli_fetch_assoc($query_mk)) { ?>
                                <option value="<?php echo $mk['Kode_MK']; ?>"><?php echo $mk['Kode_MK'] . ' - ' . $mk['Nama_MK']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                
                <div class="modal-footer border-top-0 pt-0 pb-4 px-4 d-flex gap-2">
                    <button type="button" class="btn btn-light border w-50 fw-semibold rounded-3 py-2" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="simpan" class="btn btn-primary w-50 fw-semibold rounded-3 py-2 shadow-sm">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>