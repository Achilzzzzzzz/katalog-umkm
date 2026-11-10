<?php
declare(strict_types=1);

// ====== 05_perulangan.php ======
// Pertemuan 7: for, while, do-while, foreach, break & continue

echo "<pre>";

// 1. FOR: jumlah putaran SUDAH DIKETAHUI
echo "== Tabel Perkalian 7 ==\n";
for ($i = 1; $i <= 5; $i++) {
    $hasil = 7 * $i;
    echo "7 x {$i} = {$hasil}\n";
}

// 2. WHILE: jumlah putaran BELUM DIKETAHUI
echo "\n== Simulasi Tabungan ==\n";
$saldo = 0;
$setoranBulanan = 250_000;
$target = 1_000_000;
$bulan = 0;

while ($saldo < $target) {
    $bulan++;
    $saldo += $setoranBulanan;
    echo "Bulan {$bulan} : Rp" . number_format($saldo, 0, ',', '.') . "\n";
}
echo "Target tercapai dalam {$bulan} bulan\n";

// 3. DO-WHILE: badan loop PASTI jalan minimal 1x
echo "\n== Do-While vs While ==\n";
$antrian = 0;
do {
    echo "do-while tetap jalan 1x (antrian = {$antrian})\n";
} while ($antrian > 0);

while ($antrian > 0) {
    echo "baris ini tidak pernah tampil\n";
}

// 4. FOREACH: menelusuri isi array
echo "\n== Daftar Hadir ==\n";
$mahasiswa = ["Andi", "Budi", "Citra", "Dewi"];
foreach ($mahasiswa as $nomor => $nama) {
    $urut = $nomor + 1;
    echo "{$urut}. {$nama}\n";
}

// 5. BREAK & CONTINUE
echo "\n== Cari Stok Habis (break) ==\n";
$stok = ["Keripik" => 12, "Sambal" => 0, "Kopi" => 5];
foreach ($stok as $produk => $jumlah) {
    if ($jumlah === 0) {
        echo "Ditemukan stok habis: {$produk}\n";
        break; // keluar dari loop sepenuhnya
    }
    echo "{$produk} aman ({$jumlah})\n";
}

echo "\n== Lewati Bilangan Genap (continue) ==\n";
for ($n = 1; $n <= 9; $n++) {
    if ($n % 2 === 0) {
        continue; // lompat ke putaran berikutnya
    }
    echo $n . " ";
}
echo "\n";

echo "</pre>";