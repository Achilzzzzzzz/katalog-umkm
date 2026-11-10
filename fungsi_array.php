<?php
declare(strict_types=1);

// ====== 07_fungsi_array.php ======
// Pertemuan 7: fungsi array bawaan PHP

echo "<pre>";

$produk = [
    ["nama" => "Keripik Tempe", "kategori" => "Makanan", "harga" => 15000,  "stok" => 40],
    ["nama" => "Sambal Bawang", "kategori" => "Makanan", "harga" => 25000,  "stok" => 0],
    ["nama" => "Kopi Robusta",  "kategori" => "Minuman", "harga" => 45000,  "stok" => 12],
    ["nama" => "Batik Tulis",   "kategori" => "Fashion", "harga" => 350000, "stok" => 3],
    ["nama" => "Wedang Jahe",   "kategori" => "Minuman", "harga" => 18000,  "stok" => 25],
];

// 1. count(): jumlah elemen
echo "Jumlah produk  : " . count($produk) . "\n";

// 2. array_column(): ambil satu "kolom" dari array multidimensi
$daftarNama = array_column($produk, "nama");
echo "Daftar nama    : " . implode(", ", $daftarNama) . "\n";

// 3. in_array(): apakah sebuah nilai ada di array?
$cari = "Kopi Robusta";
$ada = in_array($cari, $daftarNama, true);
echo "Ada {$cari}? : " . ($ada ? "Ya" : "Tidak") . "\n";

// 4. array_sum(): menjumlahkan semua nilai
$totalStok = array_sum(array_column($produk, "stok"));
echo "Total stok     : {$totalStok} unit\n";

// 5. array_filter(): saring elemen yang memenuhi syarat
$tersedia = array_filter($produk, fn(array $p): bool => $p["stok"] > 0);
echo "Produk tersedia : " . count($tersedia) . "\n";

// 6. array_map(): ubah setiap elemen menjadi bentuk baru
$labelHarga = array_map(
    fn(array $p): string => $p["nama"] . " (Rp" . number_format($p["harga"], 0, ',', '.') . ")",
    $produk
);

echo "Label harga    :\n";
foreach ($labelHarga as $label) {
    echo " - {$label}\n";
}

// 7. usort(): urutkan dengan aturan sendiri
usort($produk, fn(array $a, array $b): int => $b["harga"] <=> $a["harga"]);
echo "Termahal       : {$produk[0]['nama']}\n";
echo "Termurah       : " . $produk[count($produk) - 1]['nama'] . "\n";

// Bonus: array_unique() & sort()
$kategori = array_unique(array_column($produk, "kategori"));
sort($kategori);
echo "Kategori unik  : " . implode(", ", $kategori) . "\n";

echo "</pre>";