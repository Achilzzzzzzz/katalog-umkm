<?php
declare(strict_types=1);

// ====== 08_fungsi.php ======
// Pertemuan 7: fungsi buatan sendiri & Clean Code

echo "<pre>";

// VERSI "KOTOR": jalan, tetapi sulit dibaca, diuji, dan dirawat
function hitung($a, $b, $c)
{
    $x = $a * $b;
    if ($c == 1) {
        $x = $x - ($x * 0.1);
    }
    if ($x > 100000) {
        $x = $x - 10000;
    }
    return $x;
}
echo "Versi kotor  : " . hitung(30000, 4, 1) . "\n";

// VERSI CLEAN CODE: nama bermakna, tipe jelas, satu fungsi satu tugas
const DISKON_MEMBER = 0.10;      // 10%
const NOMINAL_POTONGAN = 10_000; // dapat potongan Rp10.000
const BATAS_POTONGAN = 100_000;  // belanja > Rp100.000

function hitungSubtotal(int $hargaSatuan, int $jumlah): int
{
    return $hargaSatuan * $jumlah;
}

function terapkanDiskonMember(float $subtotal, bool $isMember): float
{
    if (!$isMember) { // guard clause
        return $subtotal;
    }
    return $subtotal * (1 - DISKON_MEMBER);
}

function terapkanPotongan(float $total): float
{
    return $total > BATAS_POTONGAN ? $total - NOMINAL_POTONGAN : $total;
}

function formatRupiah(float $angka): string
{
    return "Rp" . number_format($angka, 0, ',', '.');
}

// Fungsi "orkestra": merangkai fungsi-fungsi kecil di atas
function hitungTotalBelanja(
    int $hargaSatuan,
    int $jumlah,
    bool $isMember = false
): float {
    $subtotal = hitungSubtotal($hargaSatuan, $jumlah);
    $setelahDiskon = terapkanDiskonMember($subtotal, $isMember);
    return terapkanPotongan($setelahDiskon);
}

echo "Versi clean  : " . formatRupiah(hitungTotalBelanja(30000, 4, true)) . "\n";
echo "Non-member   : " . formatRupiah(hitungTotalBelanja(30000, 4)) . "\n";
echo "Belanja kecil: " . formatRupiah(hitungTotalBelanja(15000, 2, true)) . "\n";

// strict_types membuat salah tipe langsung ketahuan
try {
    hitungTotalBelanja("30000", 4); // string, bukan int
} catch (TypeError $e) {
    echo "TypeError    : argumen harga harus int\n";
}

echo "</pre>";