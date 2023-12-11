<?php

function format_rupiah($nominal, $prefix = false)
{
    if ($prefix) {
        return "Rp. " . number_format($nominal, 0, ',', '.');
    }
    return number_format($nominal, 0, ',', '.');
}

function ubahAngkaToBulan($bulanAngka)
{
    $bulanArray = [
        '0' => '',
        '1' => 'Januari',
        '2' => 'Februari',
        '3' => 'Maret',
        '4' => 'April',
        '5' => 'Mei',
        '6' => 'Juni',
        '7' => 'Juli',
        '8' => 'Agustus',
        '9' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    ];

    return $bulanArray[$bulanAngka + 0];
}
function provinsi($noProvinsi)
{
    $provinsiArray = [
        "1" => "Bali",
        "2" => "Bangka Belitung",
        "3" => "Banten",
        "4" => "Bengkulu",
        "5" => "DI Yogyakarta",
        "6" => "DKI Jakarta",
        "7" => "Gorontalo",
        "8" => "Jambi",
        "9" => "Jawa Barat",
        "10" => "Jawa Tengah",
        "11" => "Jawa Timur",
        "12" => "Kalimantan Barat",
        "13" => "Kalimantan Selatan",
        "14" => "Kalimantan Tengah",
        "15" => "Kalimantan Timur",
        "16" => "Kalimantan Utara",
        "17" => "Kepulauan Riau",
        "18" => "Lampung",
        "19" => "Maluku",
        "20" => "Maluku Utara",
        "21" => "Nanggroe Aceh Darussalam (NAD)",
        "22" => "Nusa Tenggara Barat (NTB)",
        "23" => "Nusa Tenggara Timur (NTT)",
        "24" => "Papua",
        "25" => "Papua Barat",
        "26" => "Riau",
        "27" => "Sulawesi Barat",
        "28" => "Sulawesi Selatan",
        "29" => "Sulawesi Tengah",
        "30" => "Sulawesi Tenggara",
        "31" => "Sulawesi Utara",
        "32" => "Sumatera Barat",
        "33" => "Sumatera Selatan",
        "34" => "Sumatera Utara"


    ];

    return $provinsiArray[$noProvinsi];
}
