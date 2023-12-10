<?php

namespace App\Helper;

$ekspedisi = $_POST['ekspedisi'];
$distrik = $_POST['distrik'];
$berat = $_POST['berat'];

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "origin=501&destination=" . $distrik . "&weight=" . $berat . "&courier=" . $ekspedisi . "",
    CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: d2bb878d91c40259cf6d56680055ca35"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    // echo $response;
    $array_response = json_decode($response, true);
    $data_paket = $array_response["rajaongkir"]["results"][0]["costs"];
    // echo "<pre>";
    // print_r($data_paket);
    // echo "</pre>";

    echo '<option selected disabled>Pilih Paket</option>';

    foreach ($data_paket as $key => $value) {
        echo "<option
        paket='" . $value["service"] . "'
        ongkir='" . $value["cost"][0]["value"] . "'
        etd='" . $value["cost"][0]["etd"] . "'
        >";
        echo $value["service"] . " ";
        echo number_format($value["cost"][0]["value"])  . " ";
        echo $value["cost"][0]["etd"]  . " ";
        echo "</option>";
    }
}
