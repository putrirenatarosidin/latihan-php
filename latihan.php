

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Individu</title>
</head>
<body>

    <h1>Perhitungan Nilai dan IPS Mahasiswa</h1>

    <?php
    $matkul = [
        ["nama" => "Matematika Diskrit", "sks" => 3, "nilai" => 40.5],
        ["nama" => "Teknologi dan Transformasi Digital", "sks" => 2, "nilai" => 89.85],
        ["nama" => "Kalkulus", "sks" => 3, "nilai" => 92],
        ["nama" => "Dasar Dasar Pemrograman", "sks" => 2, "nilai" => 87],
        ["nama" => "Algoritma dan Pemrograman", "sks" => 4, "nilai" => 87.5],
        ["nama" => "Pendidikan Agama", "sks" => 2, "nilai" => 88.45],
        ["nama" => "Bahasa Pemrograman I", "sks" => 2, "nilai" => 88],
        ["nama" => "Sistem Digital", "sks" => 2, "nilai" => 96.25]
    ];

    function hitungBobot($nilai) {
        if ($nilai >= 80) {
            return ["huruf" => "A", "bobot" => 4.0];
        } elseif ($nilai >= 70) {
            return ["huruf" => "B", "bobot" => 3.0];
        } elseif ($nilai >= 60) {
            return ["huruf" => "C", "bobot" => 2.0];
        } elseif ($nilai >= 50) {
            return ["huruf" => "D", "bobot" => 1.0];
        } else {
            return ["huruf" => "E", "bobot" => 0.0];
        }
    }

    $totalSKS = 0;
    $totalBobot = 0;
    $jumlahLulus = 0;
    $jumlahMengulang = 0;
    ?>

    <h2>Data Nilai Mata Kuliah</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama Mata Kuliah</th>
            <th>SKS</th>
            <th>Nilai Angka</th>
            <th>Nilai Huruf</th>
            <th>Bobot</th>
            <th>Status</th>
        </tr>

        <?php
        foreach ($matkul as $index => $data) {
            $hasil = hitungBobot($data["nilai"]);

            $status = $hasil["bobot"] >= 2.0 ? "LULUS" : "MENGULANG";

            $totalSKS += $data["sks"];
            $totalBobot += $data["sks"] * $hasil["bobot"];

            if ($status == "LULUS") {
                $jumlahLulus++;
            } else {
                $jumlahMengulang++;
            }

            $warna = $status == "MENGULANG" ? "background-color: red; color: white;" : "";

            echo "<tr style='$warna'>";
            echo "<td>" . ($index + 1) . "</td>";
            echo "<td>" . htmlspecialchars($data["nama"]) . "</td>";
            echo "<td>" . $data["sks"] . "</td>";
            echo "<td>" . $data["nilai"] . "</td>";
            echo "<td>" . $hasil["huruf"] . "</td>";
            echo "<td>" . number_format($hasil["bobot"], 1) . "</td>";
            echo "<td>" . $status . "</td>";
            echo "</tr>";
        }

        $ips = $totalSKS > 0 ? $totalBobot / $totalSKS : 0;

        if ($ips >= 3.00) {
            $maksimalSKS = 24;
        } else {
            $maksimalSKS = 20;
        }
        ?>
    </table>

    <h2>Ringkasan Hasil Perhitungan</h2>

    <?php
    echo "Total Mata Kuliah: " . count($matkul) . "<br>";
    echo "Total SKS: " . $totalSKS . "<br>";
    echo "Jumlah Mata Kuliah Lulus: " . $jumlahLulus . "<br>";
    echo "Jumlah Mata Kuliah Mengulang: " . $jumlahMengulang . "<br>";
    echo "Total Bobot Nilai: " . number_format($totalBobot, 2) . "<br>";
    echo "Indeks Prestasi Semester (IPS): " . number_format($ips, 2) . "<br>";
    echo "Batas Maksimal SKS Semester Depan: " . $maksimalSKS . " SKS";
    ?>

</body>
</html>
