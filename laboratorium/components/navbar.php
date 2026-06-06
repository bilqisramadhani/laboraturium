<?php
// Mendapatkan nama file saat ini untuk menentukan menu yang aktif
$current_page = basename($_SERVER['PHP_SELF']);
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .navbar-premium {
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        background: #0f172a !important; /* Warna Slate Dark Premium */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        padding: 0.85rem 0;
    }
    
    .navbar-premium .navbar-brand {
        font-weight: 800;
        letter-spacing: 0.05em;
        color: #ffffff !important;
        font-size: 1.25rem;
    }
    .navbar-premium .brand-dot {
        color: #10b981;
    }

    .navbar-premium .nav-item {
        margin: 0 4px;
    }
    .navbar-premium .nav-link {
        color: #94a3b8 !important;
        font-weight: 500;
        font-size: 0.9rem;
        padding: 0.6rem 1.1rem !important;
        border-radius: 10px;
        transition: all 0.25s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .navbar-premium .nav-link:hover {
        color: #ffffff !important;
        background-color: rgba(255, 255, 255, 0.06);
    }

    .navbar-premium .nav-link.active-menu {
        color: #ffffff !important;
        background-color: #2563eb !important; /* Biru Royal Premium */
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
    }

    /* Tombol Logout Khusus */
    .btn-logout-custom {
        color: #f87171 !important; /* Merah Soft */
        background-color: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.2);
        font-weight: 600;
        font-size: 0.9rem;
        padding: 0.6rem 1.1rem !important;
        border-radius: 10px;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .btn-logout-custom:hover {
        color: #ffffff !important;
        background-color: #ef4444 !important; /* Merah Terang saat Hover */
        border-color: #ef4444;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
    }
    
    @media (max-width: 991.98px) {
        .navbar-premium .navbar-nav {
            padding-top: 1rem;
            gap: 8px;
        }
        .navbar-premium .nav-link, .btn-logout-custom {
            padding: 0.75rem 1rem !important;
            width: 100%;
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark navbar-premium sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="ruangan.php">
            <i class="bi bi-layer-forward text-primary me-2"></i>
            <span>LABORATORIUM<span class="brand-dot">.</span></span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="navbar-nav mx-auto">
                <div class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'mahasiswa.php') ? 'active-menu' : ''; ?>" href="mahasiswa.php">
                        <i class="bi bi-people-fill"></i> Mahasiswa
                    </a>
                </div>

                <div class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'matakuliah.php') ? 'active-menu' : ''; ?>" href="matakuliah.php">
                        <i class="bi bi-book-half"></i> Mata Kuliah
                    </a>
                </div>

                <div class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'ruangan.php' || $current_page == 'detail_ruangan.php') ? 'active-menu' : ''; ?>" href="ruangan.php">
                        <i class="bi bi-door-open-fill"></i> Ruangan
                    </a>
                </div>

                <div class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'alat.php') ? 'active-menu' : ''; ?>" href="alat.php">
                        <i class="bi bi-tools"></i> Alat
                    </a>
                </div>

                <div class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'peminjaman.php') ? 'active-menu' : ''; ?>" href="peminjaman.php">
                        <i class="bi bi-journal-text"></i> Peminjaman
                    </a>
                </div>
            </div>

            <div class="navbar-nav ms-auto">
                <div class="nav-item">
                    <a class="btn-logout-custom" href="logout.php">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </a>
                </div>
            </div>

        </div>
    </div>
</nav>