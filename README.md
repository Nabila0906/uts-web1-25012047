Aplikasi Pemesanan Kantin Kampus - UTS Web I

- Nama: [Nabila]
- NIM: [25012047]
- Kelas: 25M11

## Deskripsi Aplikasi
Aplikasi web sederhana berbasis PHP native untuk memesan makanan di kantin kampus. Mendukung fitur pencarian menu, pengelolaan keranjang belanja menggunakan session, perhitungan subtotal dan diskon otomatis, serta preferensi kategori menggunakan cookie.

## Kebutuhan Server Lokal
- Web Server (XAMPP / Laragon / PHP Built-in Server)
- PHP Versi 7.4 atau yang lebih baru (tanpa database dan framework)

## Cara Menjalankan Aplikasi
1. Clone atau letakkan folder project ini ke dalam direktori server lokal (misalnya htdocs pada XAMPP).
2. Jalankan Apache / PHP server.
3. Buka browser dan akses URL: http://localhost/uts-web1-NIM/index.php

Catatan Pengujian Aplikasi Pemesanan Kantin Kampus

| ID | Langkah dan Input | Hasil yang Diharapkan | Hasil Aktual | Status | Bukti Screenshot |
|---|---|---|---|---|---|
| U01 | Buka daftar menu | Minimal 5 menu tampil dengan benar | 5 menu tampil lengkap | Lulus | U01-daftar-menu.png |
| U02a | Cari nama menu: "Goreng" | Menu yang sesuai tampil | Menu yang mengandung kata Goreng tampil | Lulus | U02a-cari-ada.png |
| U02b | Cari nama menu: "Pizza" | Pesan hasil kosong tampil | Pesan menu tidak ditemukan tampil | Lulus | U02b-cari-kosong.png |
# Laporan Pengujian - Sistem Pemesanan Makanan Kantin Kampus

Berikut adalah hasil pengujian fungsionalitas aplikasi pada Tahap 3 (Validasi Input & Keamanan Keranjang):

| Kode Uji | Skenario Pengujian | Hasil yang Diharapkan | Hasil Aktual | Status | Bukti Screenshot |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **U03a** | Input jumlah dikosongkan | Menampilkan pesan error validasi | Sesuai harapan, muncul pesan error | Lulus | `U03a-jumlah-kosong.png` |
| **U03b** | Input jumlah negatif (`-3`) | Menolak input dan menampilkan error | Sesuai harapan, tertahan/error | Lulus | `U03b-jumlah-negatif.png` |
| **U03c** | Input jumlah pecahan (`1.5`) | Menolak input desimal | Sesuai harapan, tertahan/error | Lulus | `U03c-jumlah-pecahan.png` |
| **U03d** | Input jumlah nol (`0`) | Menolak input angka 0 | Sesuai harapan, tertahan/error | Lulus | `U03d-jumlah-nol.png` |
| **U03e** | Input jumlah > 10 (`11`) | Menolak jumlah melebihi batas 10 | Sesuai harapan, tertahan/error | Lulus | `U03e-jumlah-lebih.png` |
| **U05a** | Penggabungan jumlah hingga 10 | Menjumlahkan item yang sama di keranjang | Sesuai harapan, terakumulasi | Lulus | `U05a-gabung-jumlah.png` |
| **U05b** | Batas maksimal total item (10) | Menolak jika total item melebihi 10 | Sesuai harapan, tertahan/error | Lulus | `U05b-batas-10.png` |
| **U06** | Persistensi sesi (refresh) | Data keranjang tetap aman saat di-refresh | Sesuai harapan, data tidak hilang | Lulus | `U06-sesi-refresh.png` |
### Laporan Pengujian Tahap 4 (Manajemen Keranjang & Diskon)

| Kode Uji | Skenario Pengujian | Hasil yang Diharapkan | Hasil Aktual | Status | Bukti Screenshot |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **U07a** | Subtotal di bawah ketentuan diskon (< Rp 50.000) | Diskon bernilai Rp 0, total akhir sesuai subtotal | Sesuai harapan, diskon 0 | Lulus | `U07a-tanpa-diskon.png` |
| **U07b** | Subtotal mencapai/melebihi ketentuan (>= Rp 50.000) | Otomatis memotong diskon Rp 5.000 | Sesuai harapan, diskon terpotong | Lulus | `U07b-dapat-diskon.png` |
| **U08a** | Klik tombol **Hapus** pada item keranjang | Memunculkan konfirmasi dan menghapus item terpilih | Sesuai harapan, item terhapus | Lulus | `U08a-hapus-item.png` |
| **U08b** | Klik tombol **Kosongkan Keranjang** | Menghapus seluruh isi keranjang belanja secara total | Sesuai harapan, keranjang kosong | Lulus | `U08b-kosongkan-keranjang.png` |