<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'data/menu.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $kode = isset($_POST['kode']) ? trim($_POST['kode']) : '';
    $jumlah = isset($_POST['jumlah']) ? trim($_POST['jumlah']) : '';

    // Validasi 1: Cek apakah kode menu ada
    if (!array_key_exists($kode, $menus)) {
        $_SESSION['flash_error'] = "Menu tidak dikenal atau tidak valid.";
        header("Location: index.php");
        exit;
    }

    // Validasi 2: Cek apakah jumlah berupa angka bulat positif lebih dari 0
    if ($jumlah === '' || !filter_var($jumlah, FILTER_VALIDATE_INT) || (int)$jumlah <= 0) {
        $_SESSION['flash_error'] = "Jumlah pesanan harus berupa angka bulat positif lebih dari 0.";
        header("Location: index.php");
        exit;
    }

    $jumlah_int = (int)$jumlah;

    // Validasi 3: Cek batas maksimal pembelian per item (maksimal 10)
    if ($jumlah_int > 10) {
        $_SESSION['flash_error'] = "Maksimal pembelian untuk satu menu adalah 10 buah.";
        header("Location: index.php");
        exit;
    }

    // Inisialisasi keranjang
    if (!isset($_SESSION['keranjang'])) {
        $_SESSION['keranjang'] = [];
    }

    // Cek jika penggabungan melebihi 10
    if (isset($_SESSION['keranjang'][$kode])) {
        $total_baru = $_SESSION['keranjang'][$kode] + $jumlah_int;
        if ($total_baru > 10) {
            $_SESSION['flash_error'] = "Total jumlah item di keranjang melebihi batas maksimal 10.";
            header("Location: index.php");
            exit;
        }
        $_SESSION['keranjang'][$kode] = $total_baru;
    } else {
        $_SESSION['keranjang'][$kode] = $jumlah_int;
    }

    $_SESSION['flash_success'] = "Menu berhasil ditambahkan ke keranjang!";
    header("Location: keranjang.php");
    exit;
} else {
    header("Location: index.php");
    exit;
}