<?php
session_start();

// Menghapus semua data session yang tersimpan
$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Hancurkan session
session_destroy();

// Alihkan kembali pengguna ke halaman utama/login
header("Location: index.php");
exit;
?>