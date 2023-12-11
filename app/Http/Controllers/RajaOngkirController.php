<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RajaOngkirController extends Controller
{
    //


    public function getProvinsi()
    {
        $keyApi = env('RAJAONGKIR_API_KEY');
        $response = Http::withHeaders([
            'key' => $keyApi,
        ])->get('https://api.rajaongkir.com/starter/province');

        if (!$response) {
            return response()->json(['error' => "cURL Error "], 500);
        } else {
            $array_response = json_decode($response, true);
            $data_provinsi = $array_response['rajaongkir']['results'];

            $options = '<option selected disabled>Pilih Provinsi</option>';
            foreach ($data_provinsi as $key => $value) {
                $options .= "<option name='provinsi' value='" . $value['province_id'] . "' id_provinsi='" . $value["province_id"] . "'>";
                $options .= $value["province"];
                $options .= "</option>";
                // }

            }
            return response()->json(['data_provinsi' => $options]);
        }
    }

    public function getDataDistrik(Request $request)
    {
        $id_provinsi = $request->input('id_provinsi');

        $keyApi = env('RAJAONGKIR_API_KEY');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=" . $id_provinsi,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: $keyApi"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return response()->json(['error' => "cURL Error #: $err"], 500);
        } else {
            $array_response = json_decode($response, true);
            $data_distrik = $array_response["rajaongkir"]["results"];

            $options = '<option selected disabled>Pilih Kota</option>';

            foreach ($data_distrik as $key => $value) {
                $options .= "<option
                    id_distrik='" . $value["city_id"] . "'
                    nama_provinsi='" . $value["province"] . "'
                    nama_distrik='" . $value["city_name"] . "'
                    type_distrik='" . $value["type"] . "'
                    kode_pos='" . $value["postal_code"] . "'
                    >";
                $options .= $value["type"] . " ";
                $options .= $value["city_name"];
                $options .= "</option>";
            }

            return response()->json(['data_distrik' => $options]);
        }
    }

    public function getDataEkspedisi()
    {
        // Anda dapat menyusun opsi ekspedisi dari sumber data apa pun yang Anda inginkan
        $options = '<option selected disabled>Pilih Ekspedisi</option>';
        $options .= '<option value="pos">Pos Indonesia</option>';
        $options .= '<option value="tiki">TIKI</option>';
        $options .= '<option value="jne">JNE</option>';

        return response()->json(['data_ekspedisi' => $options]);
    }
    public function getDataPaket(Request $request)
    {
        $keyApi = env('RAJAONGKIR_API_KEY');
        $ekspedisi = $request->input('ekspedisi');
        $distrik = $request->input('distrik');
        $berat = $request->input('berat');

        $responseCost = Http::withHeaders([
            'key' => $keyApi,
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => '501',
            'destination' => $distrik,
            'weight' => $berat,
            'courier' => $ekspedisi,
        ]);

        $array_response = json_decode($responseCost->body(), true);
        $data_paket = $array_response["rajaongkir"]["results"][0]["costs"];

        $options = '<option selected disabled>Pilih Paket</option>';

        foreach ($data_paket as $key => $value) {
            $options .= "<option
                paket='" . $value["service"] . "'
                ongkir='" . $value["cost"][0]["value"] . "'
                etd='" . $value["cost"][0]["etd"] . "'
                >";
            $options .= $value["service"] . " ";
            $options .= number_format($value["cost"][0]["value"]) . " ";
            $options .= $value["cost"][0]["etd"] . " ";
            $options .= "</option>";
        }

        return response()->json(['data_paket' => $options]);
    }
}
