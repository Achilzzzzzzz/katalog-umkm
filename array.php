<?php
declare(strict_types=1);

// ====== 06_array.php ======
// Pertemuan 7: array terindeks, asosiatif, multidimensi

echo "<pre>";

// 1. ARRAY TERINDEKS (kunci otomatis 0, 1, 2, ...)
$hari = ["Senin", "Selasa", "Rabu"];
$hari[] = "Kamis"; // tambah di akhir
array_unshift($hari, "Minggu"); // tambah di awal

echo "Hari pertama: {$hari[0]}\n";
echo "Jumlah hari  : " . count($hari) . "\n";
print_r($hari);

// 2. ARRAY ASOSIATIF (kunci nama yang bermakna)
$mahasiswa = [
    "nim"   => "230101001",
    "nama"  => "Siti Aminah",
    "ipk"   => 3.62,
    "prodi" => "Informatika",
];

$mahasiswa["angkatan"] = 2023; // tambah pasangan kunci-nilai baru
unset($mahasiswa["prodi"]);   // hapus satu elemen

echo "\nNama: {$mahasiswa['nama']}\n";
echo "IPK : {$mahasiswa['ipk']}\n";

foreach ($mahasiswa as $kunci => $nilai) {
    echo str_pad($kunci, 9) . ": {$nilai}\n";
}

// Cek kunci sebelum dipakai agar tidak muncul "Undefined array key"
$prodi = $mahasiswa["prodi"] ?? "(belum diisi)";
echo "Prodi: {$prodi}\n";

// 3. ARRAY MULTIDIMENSI (array berisi array = "tabel")
$nilaiKelas = [
    ["nama" => "Andi",  "uts" => 78, "uas" => 85],
    ["nama" => "Budi",  "uts" => 55, "uas" => 62],
    ["nama" => "Citra", "uts" => 90, "uas" => 88],
];

echo "\nNilai UAS Citra: {$nilaiKelas[2]['uas']}\n";

echo "\nNama   UTS  UAS  Rata2\n";
foreach ($nilaiKelas as $baris) {
    $rata = ($baris["uts"] + $baris["uas"]) / 2;
    printf("%-6s %4d %4d %6.1f\n", $baris["nama"], $baris["uts"], $baris["uas"], $rata);
}

echo "</pre>";