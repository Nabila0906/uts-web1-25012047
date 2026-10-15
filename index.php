<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'data/menu.php';
require_once 'includes/header.php';

$keyword = isset($_GET['cari']) ? trim($_GET['cari']) : '';

// Tangkap pesan flash dari proses.php
$flash_success = isset($_SESSION['flash_success']) ? $_SESSION['flash_success'] : '';
$flash_error = isset($_SESSION['flash_error']) ? $_SESSION['flash_error'] : '';
unset($_SESSION['flash_success'], $_SESSION['flash_error']);

// Filter menu berdasarkan pencarian
$filtered_menus = [];
foreach ($menus as $m) {
    if ($keyword === '' || stripos($m['nama'], $keyword) !== false) {
        $filtered_menus[] = $m;
    }
}
?>

<h2>Daftar Menu Kantin</h2>

<?php if ($flash_error): ?>
    <p class="pesan" style="color: red; font-weight: bold; margin-bottom: 15px;"><?php echo htmlspecialchars($flash_error, ENT_QUOTES, 'UTF-8'); ?></p>
<?php endif; ?>

<?php if ($flash_success): ?>
    <p style="color: green; font-weight: bold; margin-bottom: 15px;"><?php echo htmlspecialchars($flash_success, ENT_QUOTES, 'UTF-8'); ?></p>
<?php endif; ?>

<!-- Form Pencarian (GET) -->
<form method="GET" action="index.php" style="margin-bottom: 20px;">
    <input type="text" name="cari" value="<?php echo htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8'); ?>" placeholder="Cari nama menu...">
    <button type="submit">Cari</button>
    <a href="index.php" style="margin-left: 10px; text-decoration: none; background-color: #6c757d; color: white; padding: 6px 12px; border-radius: 4px; display: inline-block;">Reset</a>
</form>

<!-- Tabel Menu -->
<table>
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama Menu</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($filtered_menus) > 0): ?>
            <?php foreach ($filtered_menus as $menu): ?>
                <tr>
                    <td><?php echo htmlspecialchars($menu['kode'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($menu['nama'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($menu['kategori'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>Rp <?php echo number_format($menu['harga'], 0, ',', '.'); ?></td>
                    <td>
                        <form action="proses.php" method="POST" style="display:inline;">
                            <input type="hidden" name="kode" value="<?php echo htmlspecialchars($menu['kode'], ENT_QUOTES, 'UTF-8'); ?>">
                            <input type="number" name="jumlah" value="1" min="1" max="10" style="width: 50px;">
                            <button type="submit" name="tambah">Pesan</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align: center;">Menu yang dicari tidak ditemukan.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php require_once 'includes/footer.php'; ?>