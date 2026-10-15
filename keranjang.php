<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'data/menu.php';
require_once 'includes/header.php';

// Logika aksi hapus item atau kosongkan keranjang
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] === 'hapus' && isset($_GET['kode'])) {
        $kode_hapus = $_GET['kode'];
        unset($_SESSION['keranjang'][$kode_hapus]);
        $_SESSION['flash_success'] = "Item berhasil dihapus dari keranjang.";
        header("Location: keranjang.php");
        exit;
    } elseif ($_GET['aksi'] === 'kosongkan') {
        unset($_SESSION['keranjang']);
        $_SESSION['flash_success'] = "Keranjang berhasil dikosongkan.";
        header("Location: keranjang.php");
        exit;
    }
}

// Ambil pesan flash jika ada
$flash_success = isset($_SESSION['flash_success']) ? $_SESSION['flash_success'] : '';
$flash_error = isset($_SESSION['flash_error']) ? $_SESSION['flash_error'] : '';
unset($_SESSION['flash_success'], $_SESSION['flash_error']);
?>

<h2>Keranjang Belanja</h2>

<?php if ($flash_success): ?>
    <p style="color: green; font-weight: bold;"><?php echo htmlspecialchars($flash_success, ENT_QUOTES, 'UTF-8'); ?></p>
<?php endif; ?>

<?php if ($flash_error): ?>
    <p class="pesan" style="color: red; font-weight: bold;"><?php echo htmlspecialchars($flash_error, ENT_QUOTES, 'UTF-8'); ?></p>
<?php endif; ?>

<?php if (isset($_SESSION['keranjang']) && count($_SESSION['keranjang']) > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Menu</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $subtotal_seluruhnya = 0;
            foreach ($_SESSION['keranjang'] as $kode => $jumlah):
                if (isset($menus[$kode])) {
                    $menu = $menus[$kode];
                    $subtotal = $menu['harga'] * $jumlah;
                    $subtotal_seluruhnya += $subtotal;
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($menu['kode'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($menu['nama'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>Rp <?php echo number_format($menu['harga'], 0, ',', '.'); ?></td>
                    <td><?php echo $jumlah; ?></td>
                    <td>Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                    <td>
                        <a href="keranjang.php?aksi=hapus&kode=<?php echo $kode; ?>" style="color: red; text-decoration: none; font-weight: bold;" onclick="return confirm('Yakin ingin menghapus menu ini?')">Hapus</a>
                    </td>
                </tr>
            <?php 
                }
            endforeach; 
            ?>
        </tbody>
    </table>

    <?php
    // Aturan Diskon: Jika subtotal >= Rp 50.000, dapat diskon Rp 5.000
    $diskon = ($subtotal_seluruhnya >= 50000) ? 5000 : 0;
    $total_akhir = $subtotal_seluruhnya - $diskon;
    ?>

    <div style="margin-top: 20px; background: #f9f9f9; padding: 15px; border-radius: 8px; border: 1px solid #ddd;">
        <p>Subtotal: <strong>Rp <?php echo number_format($subtotal_seluruhnya, 0, ',', '.'); ?></strong></p>
        <p>Diskon: <strong>Rp <?php echo number_format($diskon, 0, ',', '.'); ?></strong></p>
        <h3>Total Pembayaran Akhir: Rp <?php echo number_format($total_akhir, 0, ',', '.'); ?></h3>
    </div>

    <br>
    <a href="index.php" style="background-color: #007bff; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px;">Lanjut Belanja</a>
    <a href="keranjang.php?aksi=kosongkan" style="background-color: #dc3545; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px; margin-left: 10px;" onclick="return confirm('Yakin ingin mengosongkan keranjang?')">Kosongkan Keranjang</a>

<?php else: ?>
    <p>Keranjang belanja Anda masih kosong.</p>
    <br>
    <a href="index.php" style="background-color: #007bff; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px;">Pilih Menu</a>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>