<?php
declare(strict_types=1);

// 1. LOGIKA (di atas, sebelum HTML)
require __DIR__ . "/data.php";
require __DIR__ . "/functions.php";

$daftarKategori = ["Semua", "Makanan", "Minuman", "Fashion"];

// Ambil kategori dari URL, misal index.php?kategori=Minuman
$kategoriDipilih = $_GET["kategori"] ?? "Semua";
if (!in_array($kategoriDipilih, $daftarKategori, true)) {
    $kategoriDipilih = "Semua"; // tolak nilai yang tidak dikenal
}

$produkTampil = filterKategori($daftarProduk, $kategoriDipilih);
$jumlahHabis  = count(array_filter($daftarProduk, fn(array $p): bool => $p["stok"] === 0));
$nilaiStok    = hitungNilaiStok($daftarProduk);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog <?= e($namaToko) ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="kepala">
        <h1><?= e($namaToko) ?></h1>
        <p>
            <?= count($daftarProduk) ?> produk | <?= $jumlahHabis ?> habis | Nilai stok <?= formatRupiah($nilaiStok) ?>
        </p>
        <nav class="filter">
            <?php foreach ($daftarKategori as $kategori): ?>
                <a href="?kategori=<?= urlencode($kategori) ?>"
                   class="<?= $kategori === $kategoriDipilih ? 'aktif' : '' ?>">
                    <?= e($kategori) ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </header>

    <main class="grid">
        <?php if (count($produkTampil) === 0): ?>
            <p class="kosong">Belum ada produk di kategori ini.</p>
        <?php endif; ?>

        <?php foreach ($produkTampil as $produk): ?>
            <?php $status = statusStok($produk["stok"]); ?>
            <article class="kartu">
                <span class="<?= kelasBadge($status) ?>"><?= $status ?></span>
                <h2><?= e($produk["nama"]) ?></h2>
                <p class="kategori"><?= e($produk["kategori"]) ?> (<?= e($produk["kode"]) ?>)</p>
                <p class="harga"><?= formatRupiah($produk["harga"]) ?></p>
                <p class="stok">Stok: <?= $produk["stok"] ?></p>
            </article>
        <?php endforeach; ?>
    </main>

    <footer class="kaki">
        <p>&copy; <?= date("Y") ?> Pemrograman Web Informatika TSU</p>
    </footer>
</body>
</html>