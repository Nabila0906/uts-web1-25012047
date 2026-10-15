<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'data/menu.php';
require_once 'includes/header.php';

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
    <p class="pesan"><?php echo htmlspecialchars($flash_error, ENT_QUOTES, 'UTF-8'); ?></p>
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
            </tr>
        </thead>
        <tbody>
            <?php 
            $total_seluruhnya = 0;
            foreach ($_SESSION['keranjang'] as $kode => $jumlah):
                if (isset($menus[$kode])) {
                    $menu = $menus[$kode];
                    $subtotal = $menu['harga'] * $jumlah;
                    $total_seluruhnya += $subtotal;
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($menu['kode'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($menu['nama'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>Rp <?php echo number_format($menu['harga'], 0, ',', '.'); ?></td>
                    <td><?php echo $jumlah; ?></td>
                    <td>Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                </tr>
            <?php 
                }
            endforeach; 
            ?>
        </tbody>
    </table>

    <h3>Total Pembayaran: Rp <?php echo number_format($total_seluruhnya, 0, ',', '.'); ?></h3>

    <br>
    <a href="index.php" style="background-color: #007bff; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px;">Lanjut Belanja</a>
<?php else: ?>
    <p>Keranjang belanja Anda masih kosong.</p>
    <br>
    <a href="index.php" style="background-color: #007bff; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px;">Pilih Menu</a>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>