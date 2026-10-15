<?php
session_start();

// 1. Logika Cookie preferensi kategori & prioritas GET
if (isset($_GET['kategori']) && $_GET['kategori'] !== '') {
    $kategori_aktif = $_GET['kategori'];
    setcookie('preferensi_kategori', $kategori_aktif, time() + (7 * 86400), '/');
} elseif (isset($_COOKIE['preferensi_kategori'])) {
    $kategori_aktif = $_COOKIE['preferensi_kategori'];
} else {
    $kategori_aktif = 'Semua';
}

$kata_kunci = isset($_GET['cari']) ? trim($_GET['cari']) : '';

// 2. Data menu statis (sesuai proyek PHP native tanpa database)
$data_menu = [
    ['kode' => 'M01', 'nama' => 'Nasi Goreng Spesial', 'kategori' => 'Makanan', 'harga' => 25000],
    ['kode' => 'M02', 'nama' => 'Mie Ayam Bakso', 'kategori' => 'Makanan', 'harga' => 20000],
    ['kode' => 'M03', 'nama' => 'Es Teh Manis', 'kategori' => 'Minuman', 'harga' => 5000],
    ['kode' => 'M04', 'nama' => 'Jus Alpukat', 'kategori' => 'Minuman', 'harga' => 15000],
    ['kode' => 'M05', 'nama' => 'Kentang Goreng', 'kategori' => 'Cemilan', 'harga' => 18000]
];

// 3. Filter data berdasarkan kategori aktif dan pencarian
$daftar_menu = array_filter($data_menu, function($menu) use ($kategori_aktif, $kata_kunci) {
    $cocok_kategori = ($kategori_aktif == 'Semua' || $menu['kategori'] == $kategori_aktif);
    $cocok_cari = ($kata_kunci == '' || stripos($menu['nama'], $kata_kunci) !== false);
    return $cocok_kategori && $cocok_cari;
});

// Memanggil header template asli Anda
include 'includes/header.php';
?>

<div class="container" style="padding: 20px;">
    <h2>Daftar Menu Kantin</h2>

    <!-- Form Pencarian & Filter Kategori -->
    <form action="index.php" method="GET" style="margin-bottom: 20px;">
        <input type="text" name="cari" placeholder="Cari nama menu..." value="<?= htmlspecialchars($kata_kunci); ?>">
        
        <select name="kategori" onchange="this.form.submit()" style="padding: 5px;">
            <option value="Semua" <?= $kategori_aktif == 'Semua' ? 'selected' : ''; ?>>Semua Kategori</option>
            <option value="Makanan" <?= $kategori_aktif == 'Makanan' ? 'selected' : ''; ?>>Makanan</option>
            <option value="Minuman" <?= $kategori_aktif == 'Minuman' ? 'selected' : ''; ?>>Minuman</option>
            <option value="Cemilan" <?= $kategori_aktif == 'Cemilan' ? 'selected' : ''; ?>>Cemilan</option>
        </select>

        <button type="submit" style="padding: 5px 10px;">Cari</button>
        <?php if (!empty($kata_kunci) || $kategori_aktif !== 'Semua'): ?>
            <a href="index.php" style="margin-left: 10px;">Reset</a>
        <?php endif; ?>
    </form>

    <?php if (empty($daftar_menu)): ?>
        <p>Menu yang Anda cari tidak ditemukan: <strong><?= htmlspecialchars($kata_kunci); ?></strong></p>
    <?php else: ?>
        <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #333; color: white;">
                    <th>Kode</th>
                    <th>Nama Menu</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($daftar_menu as $menu): ?>
                    <tr>
                        <td><?= htmlspecialchars($menu['kode']); ?></td>
                        <td><?= htmlspecialchars($menu['nama']); ?></td>
                        <td><?= htmlspecialchars($menu['kategori']); ?></td>
                        <td>Rp <?= number_format($menu['harga'], 0, ',', '.'); ?></td>
                        <td>
                            <form action="proses.php" method="POST" style="display:inline;">
                                <input type="hidden" name="kode" value="<?= htmlspecialchars($menu['kode']); ?>">
                                <input type="number" name="jumlah" value="1" min="1" max="10" style="width: 40px;">
                                <button type="submit" name="tambah" style="background: #28a745; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer;">Pesan</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>