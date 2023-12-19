// ketika tombol menu di klik

// raja ongkir
// function modal(form) {
//     let modal = $(form);
//     modal.modal("show");
// }
// var dataProvinsiUrl = document
//     .getElementById("dataProvinsiUrl")
//     .getAttribute("data-url");

// var dataDistrikUrl = document
//     .getElementById("dataDistrikUrl")
//     .getAttribute("data-url");

var dataPaketUrl = document
    .getElementById("dataPaketUrl")
    .getAttribute("data-url");
// .replace("http://", "https://");

var dataEkspedisiUrl = document
    .getElementById("dataEkspedisiUrl")
    .getAttribute("data-url");
// .replace("http://", "https://");

$(document).ready(function () {
    // console.log("URL: {{ route('data.provinsi') }}");
    // $.ajax({
    //     url: dataProvinsiUrl,
    //     type: "get",
    //     success: function (data_provinsi) {
    //         $("select[name=provinsi]").html(data_provinsi["data_provinsi"]);
    //     },
    // });

    // $("select[name=provinsi]").on("change", function () {
    //     var id_provinsi = $("option:selected", this).attr("id_provinsi");
    //     // console.log(id_provinsi);
    //     $.ajax({
    //         type: "get",
    //         url: dataDistrikUrl,
    //         data: "id_provinsi=" + id_provinsi + "",
    //         success: function (data_distrik) {
    //             $("select[name=distrik]").html(data_distrik["data_distrik"]);
    //         },
    //     });
    // });

    $.ajax({
        type: "get",
        url: dataEkspedisiUrl,
        success: function (data_ekspedisi) {
            $("select[name=expedisi]").html(data_ekspedisi["data_ekspedisi"]);
        },
    });

    $("select[name=expedisi]").on("change", function () {
        var nama_ekspedisi = $("select[name=expedisi]").val();
        // var form = $("#rajaongkir");
        // var data_distrik = $("option:selected", "select[name=distrik]").attr(
        //     "id_distrik"
        // );
        var data_distrik = $("input[id=iddistrik]").val();
        var total_berat = $("input[id=total_berat]").val();
        axios
            .post(dataPaketUrl, {
                ekspedisi: nama_ekspedisi,
                distrik: data_distrik,
                berat: total_berat,
            })
            .then(function (response) {
                $("select[name=paket]").html(response.data.data_paket);
                $("input[name=nama_ekspedisi]").val(nama_ekspedisi);
            })
            .catch(function (error) {
                console.error("Error response:", error.response);
            });
        // let data = new FormData(form[0]);
        // console.log(data);
        // $.ajax({
        //     type: "post",
        //     url: dataPaketUrl,
        //     data: data,
        //     success: function (data_paket) {
        //         $("select[name=paket]").html(data_paket);
        //         $("input[name=nama_ekspedisi]").val(nama_ekspedisi);
        //     },
        // });
    });

    // $("select[name=distrik]").on("change", function () {
    //     var prof = $("option:selected", this).attr("nama_provinsi");
    //     var dist = $("option:selected", this).attr("nama_distrik");
    //     var type = $("option:selected", this).attr("type_distrik");
    //     var pos = $("option:selected", this).attr("kode_pos");
    //     $("input[name=nama_provinsi]").val(prof);
    //     $("input[name=nama_distrik]").val(dist);
    //     $("input[name=type_distrik]").val(type);
    //     $("input[name=kode_pos]").val(pos);
    // });
    // $("select[name=paket]").on("change", function () {
    //     var paket = $("option:selected", this).attr("paket");
    //     var ongkir = $("option:selected", this).attr("ongkir");
    //     var etd = $("option:selected", this).attr("etd");
    //     $("input[name=paket]").val(paket);
    //     $("input[name=ongkir]").val(ongkir);
    //     $("input[name=etd]").val(etd);
    // });
});

var payButton = document.getElementById("pay-button");
payButton.addEventListener("click", function () {
    // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
    window.snap.pay("{{ $pesans->first()->tranksaksi()->snap_token }}", {
        onSuccess: function (result) {
            /* You may add your own implementation here */
            window.location.reload();
            alert("payment success!");
            console.log(result);
        },
        onPending: function (result) {
            /* You may add your own implementation here */
            alert("wating your payment!");
            console.log(result);
        },
        onError: function (result) {
            /* You may add your own implementation here */
            alert("payment failed!");
            console.log(result);
        },
        onClose: function () {
            /* You may add your own implementation here */
            alert("Pembayaran Belum Dilakukan");
        },
    });
});
