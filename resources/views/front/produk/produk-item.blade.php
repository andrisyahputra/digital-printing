@push('css')
    <style>
        .inner_text {
            background-color: rgba(0, 0, 0, 0.212);
            color: red !important;
            position: absolute;
            z-index: 20;
            text-align: center;
            align-items: center;
            width: 100%;
            height: 100%;
            display: none;
        }
    </style>
@endpush


<div class="card ">
    <div class="inner_text" style="{{ $produk->stok == 0 ? 'display: flex;' : '' }}">
        <h5 style="width: 100%; text-align: center; font-weight: bold; ">Habis</h5>
    </div>
    <img src="{{ Storage::url($produk->foto) }}" alt="{{ $produk->foto }}">
    <div class="card-body content">
        <h5>{{ $produk->nama }}</h5>
        <p>Rp. {{ number_format($produk->harga) }}</p>
        <a class="btn btn-sm btn-success m-1 "
            @switch($produk->kategori_id)
            @case(1)
                onclick="add_stiker({{ $produk->id }},{{ $produk->stok }},{{ $produk->harga }})"
                @break
            @case(2)
                onclick="add_spanduk({{ $produk->id }},{{ $produk->stok }},{{ $produk->harga }})"
                @break
            @case(3)
                onclick="add_kartunama({{ $produk->id }},{{ $produk->stok }},{{ $produk->harga }})"
                @break
            @case(4)
                onclick="add_brosur({{ $produk->id }},{{ $produk->stok }},{{ $produk->harga }})"
                @break
                @default
                onclick="add_card({{ $produk->id }},{{ $produk->stok }},{{ $produk->harga }})"

        @endswitch>
            <i class="fas fa-shopping-cart"></i> Tambah Keranjang
        </a>
        <a href="{{ route('product-details', $produk->id) }}" class="btn btn-sm btn-success m-1">
            <i class="fas fa-eye"></i> Details
        </a>

    </div>
</div>

@push('js')
    <script>
        function tutupModal(idmodal) {
            let modal = $(idmodal)
            modal.modal('hide')
        }


        function add_stiker(produk_id, stok, harga) {
            let modal = $('#keranjangStiker')
            // let hide = $('#keranjang')
            modal.find('#produk_idStiker').val(produk_id)
            modal.find('#hargaStiker').val(harga)
            modal.find('#num_qtyStiker').text('Tersedia ' + stok)
            modal.find('input[name="kuantitas"]').attr('max', stok)
            modal.find('#hargaAwalStiker').text('*Keterangan : Rp. ' + formatUang(parseInt(harga).toString()) +
                ' Per Meter')
            // modal.find('#tutupStiker').modal('hide');
            modal.modal('show')
        }

        function showTotalStiker() {
            var panjang = $('#panjangStiker').val();
            var lebar = $('#lebarStiker').val();
            var jumlah = $('#jumlahStiker').val();
            var harga = $('#hargaStiker').val();
            var luas = parseFloat(panjang) * parseFloat(lebar);
            var total = luas * jumlah * harga;
            var html = '';
            $('#totalHargaStiker').val(total)
            html = '' +
                '<h3> Rp. ' + formatUang(parseInt(total).toString()) + '</h3>';
            $('#totalStiker').html(html);
        }

        function add_spanduk(produk_id, stok, harga) {
            let modal = $('#keranjangSpanduk')
            // let hide = $('#keranjang')
            modal.find('#produk_idSpanduk').val(produk_id)
            modal.find('#hargaSpanduk').val(harga)
            modal.find('#num_qtySpanduk').text('Tersedia ' + stok)
            modal.find('input[name="kuantitas"]').attr('max', stok)
            modal.find('#hargaAwalSpanduk').text('*Keterangan : Rp. ' + formatUang(parseInt(harga).toString()) +
                ' Per Meter')
            // modal.find('#tutupSpanduk').modal('hide');
            modal.modal('show')
        }

        function showTotalSpanduk() {
            var panjang = $('#panjangSpanduk').val();
            var lebar = $('#lebarSpanduk').val();
            var jumlah = $('#jumlahSpanduk').val();
            var harga = $('#hargaSpanduk').val();
            var luas = parseFloat(panjang) * parseFloat(lebar);
            var total = luas * jumlah * harga;
            var html = '';
            $('#totalHargaSpanduk').val(total)
            html = '' +
                '<h3> Rp. ' + formatUang(parseInt(total).toString()) + '</h3>';
            $('#totalSpanduk').html(html);
        }

        function add_brosur(produk_id, stok, harga) {
            let modal = $('#keranjangBrosur')
            // let hide = $('#keranjang')
            modal.find('#produk_idBrosur').val(produk_id)
            modal.find('#hargaBrosur').val(harga)
            modal.find('#num_qtyBrosur').text('Tersedia ' + stok)
            modal.find('input[name="kuantitas"]').attr('max', stok)
            modal.find('#hargaAwalBrosur').text('*Keterangan : Rp. ' + formatUang(parseInt(harga).toString()) +
                ' Per Rim')
            // modal.find('#tutupBrosur').modal('hide');
            modal.modal('show')
        }

        function showTotalBrosur() {
            var jumlah = $('#jumlahBrosur').val();
            var harga = $('#hargaBrosur').val();
            var total = jumlah * harga;
            var html = '';
            $('#totalHargaBrosur').val(total)
            html = '' +
                '<h3> Rp. ' + formatUang(parseInt(total).toString()) + '</h3>';
            $('#totalBrosur').html(html);
        }

        function add_kartunama(produk_id, stok, harga) {
            let modal = $('#keranjangKartuNama')
            // let hide = $('#keranjang')
            modal.find('#produk_idKartuNama').val(produk_id)
            modal.find('#hargaKartuNama').val(harga)
            modal.find('#num_qtyKartuNama').text('Tersedia ' + stok)
            modal.find('input[name="kuantitas"]').attr('max', stok)
            modal.find('#hargaAwalKartuNama').text('*Keterangan : Rp. ' + formatUang(parseInt(harga).toString()) +
                ' Per Rim')
            // modal.find('#tutupKartuNama').modal('hide');
            modal.modal('show')
        }

        function showTotalKartuNama() {
            var jumlah = $('#jumlahKartuNama').val();
            var harga = $('#hargaKartuNama').val();
            var total = jumlah * harga;
            var html = '';
            $('#totalHargaKartuNama').val(total)
            html = '' +
                '<h3> Rp. ' + formatUang(parseInt(total).toString()) + '</h3>';
            $('#totalKartuNama').html(html);
        }



        function add_card(produk_id, stok, harga) {
            let modal = $('#keranjangProduk')
            // let hide = $('#keranjang')
            modal.find('#produk_idProduk').val(produk_id)
            modal.find('#hargaProduk').val(harga)
            modal.find('#num_qtyProduk').text('Tersedia ' + stok)
            modal.find('input[name="kuantitas"]').attr('max', stok)
            modal.find('#hargaAwalProduk').text('*Keterangan : Rp. ' + formatUang(parseInt(harga).toString()) +
                ' Per Produk')
            // modal.find('#tutupProduk').modal('hide');
            modal.modal('show')
        }

        function showTotalProduk() {
            var jumlah = $('#jumlahProduk').val();
            var harga = $('#hargaProduk').val();
            var total = jumlah * harga;
            var html = '';
            $('#totalHargaProduk').val(total)
            html = '' +
                '<h3> Rp. ' + formatUang(parseInt(total).toString()) + '</h3>';
            $('#totalProduk').html(html);
        }

        function formatUang(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
@endpush
