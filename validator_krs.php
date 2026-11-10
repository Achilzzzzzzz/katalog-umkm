<?php
declare(strict_types=1);

// ====== 09_validator_krs.php ======
// Studi Kasus 2: Validator KRS sederhana

function batasSks(float $ipk): int
{
    return match (true) {
        $ipk >= 3.00 => 24,
        $ipk >= 2.50 => 21,
        $ipk >= 2.00 => 18,
        default      => 15,
    };
}

function cariKodeGanda(array $krs): array
{
    $hitung = array_count_values(array_column($krs, "kode"));
    $ganda  = array_filter($hitung, fn(int $n): bool => $n > 1);
    return array_keys($ganda);
}

function totalSks(array $krs): int
{
    return array_sum(array_column($krs, "sks"));
}

// Mengembalikan daftar pesan kesalahan; array kosong = KRS valid
function validasiKrs(array $krs, float $ipk): array
{
    $kesalahan = [];
    $kodeGanda = cariKodeGanda($krs);

    if (count($kodeGanda) > 0) {
        $kesalahan[] = "Mata kuliah ganda: " . implode(", ", $kodeGanda);
    }

    $total = totalSks($krs);
    $batas = batasSks($ipk);

    if ($total > $batas) {
        $kesalahan[] = "Total {$total} SKS melebihi batas {$batas} SKS";
    }

    return $kesalahan;
}

function cetakLaporan(string $nama, float $ipk, array $krs): void
{
    echo "== KRS {$nama} (IPK " . number_format($ipk, 2) . ") ==\n";
    foreach ($krs as $nomor => $mk) {
        printf("%d. %-7s %-28s %d SKS\n", $nomor + 1, $mk["kode"], $mk["nama"], $mk["sks"]);
    }
    echo "Total: " . totalSks($krs) . " / " . batasSks($ipk) . " SKS\n";

    $kesalahan = validasiKrs($krs, $ipk);
    if (count($kesalahan) === 0) {
        echo "Status: VALID, KRS dapat diajukan\n\n";
        return;
    }

    echo "Status: DITOLAK\n";
    foreach ($kesalahan as $pesan) {
        echo " - {$pesan}\n";
    }
    echo "\n";
}

// Data Uji ----------
$krsAndi = [
    ["kode" => "IF301", "nama" => "Pemrograman Web",          "sks" => 3],
    ["kode" => "IF302", "nama" => "Basis Data",               "sks" => 3],
    ["kode" => "IF303", "nama" => "Rekayasa Perangkat Lunak", "sks" => 3],
    ["kode" => "IF304", "nama" => "Jaringan Komputer",        "sks" => 3],
];

$krsBudi = [
    ["kode" => "IF301", "nama" => "Pemrograman Web",   "sks" => 3],
    ["kode" => "IF302", "nama" => "Basis Data",        "sks" => 3],
    ["kode" => "IF301", "nama" => "Pemrograman Web",   "sks" => 3],
    ["kode" => "IF305", "nama" => "Kecerdasan Buatan", "sks" => 3],
    ["kode" => "IF306", "nama" => "Sistem Operasi",     "sks" => 3],
    ["kode" => "IF307", "nama" => "Grafika Komputer",   "sks" => 3],
    ["kode" => "IF308", "nama" => "Metode Numerik",    "sks" => 3],
];

echo "<pre>";
cetakLaporan("Andi", 3.45, $krsAndi);
cetakLaporan("Budi", 2.10, $krsBudi);
echo "</pre>";