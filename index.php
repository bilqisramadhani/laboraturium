<?php
session_start();
include 'koneksi.php';

$error = '';

// Proses validasi saat tombol login ditekan
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Silakan sesuaikan query ini dengan struktur tabel user/admin kamu jika ada
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        header('Location: ruangan.php'); 
        exit;
    } else {
        $error = 'Username atau password salah!';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem Informasi Laboratorium</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', system-ui, -apple-system, sans-serif; background-color: #f8fafc; height: 100vh; }
        .login-container { height: 100vh; }
        .brand-panel { background: linear-gradient(135deg, #1e3a8a 0%, #0f172a 100%); color: #ffffff; display: flex; flex-direction: column; justify-content: center; padding: 4rem; position: relative; overflow: hidden; }
        .brand-panel::before { content: ''; position: absolute; width: 300px; height: 300px; background: rgba(37, 99, 235, 0.15); border-radius: 50%; top: -50px; left: -50px; }
        .form-panel { display: flex; align-items: center; justify-content: center; padding: 3rem; background-color: #ffffff; }
        .form-wrapper { width: 100%; max-width: 420px; }
        .form-control { padding: 0.75rem 1rem; border-radius: 10px; border: 1px solid #cbd5e1; background-color: #f8fafc; font-size: 0.95rem; transition: all 0.2s ease; }
        .form-control:focus { background-color: #ffffff; border-color: #2563eb; box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1); }
        .input-group-text { background-color: #f8fafc; border-color: #cbd5e1; border-radius: 10px; color: #64748b; }
        .btn-login { background-color: #2563eb; color: #ffffff; font-weight: 600; padding: 0.75rem; border-radius: 10px; border: none; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2); transition: all 0.2s ease; }
        .btn-login:hover { background-color: #1d4ed8; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(37, 99, 235, 0.3); }
        /* Style untuk tombol mata */
        .btn-toggle { border-color: #cbd5e1; background-color: #f8fafc; border-top-right-radius: 10px; border-bottom-right-radius: 10px; }
    </style>
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0 login-container">
        
        <div class="col-lg-6 d-none d-lg-flex brand-panel">
            <div class="position-relative z-1">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary rounded-3 p-2.5 d-inline-flex me-3 shadow-sm text-white" style="line-height: 1;">
                        <i class="bi bi-layer-forward fs-3"></i>
                    </div>
                    <span class="fs-4 fw-extrabold tracking-wider font-monospace">LABORATORIUM<span class="text-success">.</span></span>
                </div>
                <h1 class="display-5 fw-bold mb-3 lh-sm">Sistem Peminjaman <br>Alat Laboratorium</h1>
                <p class="text-secondary fs-5 mb-0" style="color: #94a3b8 !important;">
                    Silakan masuk untuk mengelola data mahasiswa, inventarisasi alat, ruangan, mata kuliah, serta pelacakan log peminjaman alat.
                </p>
            </div>
        </div>

        <div class="col-12 col-lg-6 form-panel">
            <div class="form-wrapper">
                <div class="text-center text-lg-start mb-5">
                    <h3 class="fw-bold text-dark mb-2">Selamat Datang Kembali</h3>
                    <p class="text-muted mb-0">Masukkan akun administrator laboratorium Anda</p>
                </div>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger border-0 rounded-3 d-flex align-items-center small p-3 mb-4">
                        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                        <div><?php echo $error; ?></div>
                    </div>
                <?php endif; ?>

                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label small fw-semibold text-secondary">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username Anda" required autocomplete="off">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label small fw-semibold text-secondary">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
                            <button class="btn btn-outline-secondary btn-toggle" type="button" id="togglePassword">
                                <i class="bi bi-eye-slash" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe">
                            <label class="form-check-label small text-muted" for="rememberMe">Ingat sesi saya</label>
                        </div>
                        <a href="#" class="text-decoration-none small text-primary fw-medium">Lupa password?</a>
                    </div>

                    <button type="submit" name="login" class="btn btn-login w-100 py-2.5">
                        Masuk ke Dashboard <i class="bi bi-arrow-right-short ms-1"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const passwordInput = document.getElementById('password');
    const togglePasswordButton = document.getElementById('togglePassword');
    const toggleIcon = document.getElementById('toggleIcon');

    togglePasswordButton.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        toggleIcon.classList.toggle('bi-eye');
        toggleIcon.classList.toggle('bi-eye-slash');
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>