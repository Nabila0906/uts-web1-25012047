<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'data/menu.php';
require_once 'includes/header.php';

$keyword = isset($_GET['cari']) ? trim($_GET['cari']) : '';

$filtered_menus = [];
foreach ($menus as $m) {
    if ($keyword === '' || stripos($m['nama'], $keyword) !== false) {
        $filtered_menus[] = $m;
    }
}
?>

<h2>Daftar Menu Kantin</h2>

<!-- Form Pencarian (GET) -->
<form method="GET" action="index.php" style="margin-bottom: 20px;">
    <input type="text" name="cari" value="<?php echo htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8'); ?>" placeholder="Cari nama menu...">
    <button type="submit">Cari</button>
    <a href="index.php" style="margin-left: 10px; text-decoration: none; background-color: #6c757d; color: white; padding: 6px 12px; border-radius: 4px; display: inline-block;">Reset</a>
</form>

<br>

<?php if (count($filtered_menus) > 0): ?>
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
            <?php foreach ($filtered_menus as $menu): ?>
                <tr>
                    <td><?php echo htmlspecialchars($menu['kode'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($menu['nama'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($menu['kategori'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>Rp <?php echo number_format($menu['harga'], 0, ',', '.'); ?></td>
                    <td>
                        <form action="proses.php" method="POST" style="margin:0;">
                            <input type="hidden" name="kode" value="<?php echo $menu['kode']; ?>">
                            <input type="number" name="jumlah" value="1" min="1" max="10" style="width: 50px;">
                            <button type="submit" name="tambah">Pesan</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="pesan">Menu yang Anda cari "<?php echo htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8'); ?>" tidak ditemukan.</p>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>