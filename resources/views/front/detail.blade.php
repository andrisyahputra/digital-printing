@extends('layouts.app_onlineshop')

@section('content')
    <section class="page-produk">
        <ul class="breadcrumb">
            <li><a href="index.php">Beranda</a></li>
            <li>Detail Produk</li>
        </ul>

        <div class="row">
            <div class="col-md-3">
                {{-- <php include 'include/sidebar.php' ?> --}}
                @include('front.partials.sidebar')
            </div>


            <div class="col-md-9 detail-produk">

                <div class="row">
                    <div class="col-6">
                        <div id="owl-nav"></div>
                        <div class="owl-carousel owl-theme">

                            {{-- <php foreach ($produkfoto as $key => $value) : ?> --}}
                            <div class="item">
                                <img src="{{ Storage::url($produk->foto) }}" alt="{{ $produk->foto }}">
                            </div>
                            {{-- <php endforeach; ?> --}}
                        </div>
                    </div>
                    <div class="col-md-6 detail-form">
                        @switch($produk->kategori_id)
                            @case(1)
                                <form action="{{ route('keranjang.store') }}" method="post" enctype="multipart/form-data">
                                    <div class="card">
                                        <div class="card-body">
                                            @csrf
                                            <input type="hidden" name="produk_id" id="Dproduk_idDStiker"
                                                value="{{ $produk->id }}">
                                            <input type="hidden" id="DhargaStiker" value="{{ $produk->harga }}">
                                            <input type="hidden" id="DtotalHargaStiker" value="">

                                            <div class="form-group row">

                                                <label for="DpanjangStiker" class="col-md-3 col-form-label">Panjang Permeter
                                                    :</label>
                                                <div class="col-md-9">
                                                    <input type="number" id="DpanjangStiker" onkeyup="DshowTotalStiker()" required
                                                        class="form-control @error('panjang')
                                                is-invalid
                                            @enderror"
                                                        name="panjang">
                                                    @error('panjang')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <label for="DlebarStiker" class="col-md-3 col-form-label">Lebar Permeter :</label>
                                                <div class="col-md-9">
                                                    <input type="number" id="DlebarStiker" onkeyup="DshowTotalStiker()" required
                                                        class="form-control @error('lebar')
                                                is-invalid
                                            @enderror"
                                                        name="lebar">
                                                    @error('lebar')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <label for="DfotoStiker" class="col-md-3 col-form-label">Foto Sendiri :</label>
                                                <div class="col-md-9">
                                                    <input type="file" id="DfotoStiker" required
                                                        class="form-control @error('foto')
                                                is-invalid
                                            @enderror"
                                                        name="foto">
                                                    @error('foto')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <label for="DketeranganStiker" class="col-md-3 col-form-label">Keterangan :</label>
                                                <div class="col-md-9">
                                                    <textarea name="keterangan" class="form-control" id="DketeranganStiker"></textarea>
                                                    @error('keterangan')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <label for="DjumlahStiker" class="col-md-3 col-form-label">Jumlah :</label>
                                                <div class="col-md-9">
                                                    <input type="number" class="form-control" id="DjumlahStiker"
                                                        onkeyup="DshowTotalStiker()" name="kuantitas"
                                                        placeholder="Masukkan Julah Pembelian" required min="1"
                                                        max="{{ $produk->stok }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="" class="col-md-3 col-form-label">Stok :</label>
                                                <div class="col-md-9">
                                                    <input disabled class="form-control" value="{{ $produk->stok }}">
                                                </div>
                                            </div>
                                            {{-- <h5>Rp. {{ number_format($produk->harga) }}</h5> --}}
                                            <h5 id="DtotalStiker">Hasil</h3>
                                                <p>*Keterangan : {{ FormatRupiah($produk->harga, true) }} Per Meter'</p>
                                        </div>
                                        <div class="card-footer text-right">
                                            <button type="submit" class="btn btn-success"><i class="fas fa-shopping-cart"></i>
                                                Keranjang</button>
                                        </div>
                                    </div>
                                </form>
                            @break

                            @case(2)
                                <form action="{{ route('keranjang.store') }}" method="post" enctype="multipart/form-data">
                                    <div class="card">
                                        <div class="card-body">
                                            @csrf
                                            <input type="hidden" name="produk_id" id="produk_idDSpanduk"
                                                value="{{ $produk->id }}">
                                            <input type="hidden" id="DhargaSpanduk" value="{{ $produk->harga }}">
                                            {{-- <input type="text" id="DtotalHargaSpanduk" value=""> --}}

                                            <div class="form-group row">

                                                <label for="DpanjangSpanduk" class="col-md-3 col-form-label">Panjang Permeter
                                                    :</label>
                                                <div class="col-md-9">
                                                    <input type="number" id="DpanjangSpanduk" onkeyup="DshowTotalSpanduk()"
                                                        required
                                                        class="form-control @error('panjang')
                                                is-invalid
                                            @enderror"
                                                        name="panjang">
                                                    @error('panjang')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <label for="DlebarSpanduk" class="col-md-3 col-form-label">Lebar Permeter
                                                    :</label>
                                                <div class="col-md-9">
                                                    <input type="number" id="DlebarSpanduk" onkeyup="DshowTotalSpanduk()"
                                                        required
                                                        class="form-control @error('lebar')
                                                is-invalid
                                            @enderror"
                                                        name="lebar">
                                                    @error('lebar')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <label for="DfotoSpanduk" class="col-md-3 col-form-label">Foto Sendiri :</label>
                                                <div class="col-md-9">
                                                    <input type="file" id="DfotoSpanduk" required
                                                        class="form-control @error('foto')
                                                is-invalid
                                            @enderror"
                                                        name="foto">
                                                    @error('foto')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <label for="DketeranganSpanduk" class="col-md-3 col-form-label">Keterangan
                                                    :</label>
                                                <div class="col-md-9">
                                                    <textarea name="keterangan" class="form-control" id="DketeranganSpanduk"></textarea>
                                                    @error('keterangan')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <label for="DjumlahSpanduk" class="col-md-3 col-form-label">Jumlah :</label>
                                                <div class="col-md-9">
                                                    <input type="number" class="form-control" id="DjumlahSpanduk"
                                                        onkeyup="DshowTotalSpanduk()" name="kuantitas"
                                                        placeholder="Masukkan Julah Pembelian" required min="1"
                                                        max="{{ $produk->stok }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="" class="col-md-3 col-form-label">Stok :</label>
                                                <div class="col-md-9">
                                                    <input disabled class="form-control" value="{{ $produk->stok }}">
                                                </div>
                                            </div>
                                            <h5 id="DtotalSpanduk">Hasil</h3>
                                                <p id="DhargaAwalSpanduk">*Keterangan : {{ FormatRupiah($produk->harga, true) }}
                                                    Per Meter'</p>

                                        </div>
                                        <div class="card-footer text-right">
                                            <button type="submit" class="btn btn-success"><i class="fas fa-shopping-cart"></i>
                                                Keranjang</button>
                                        </div>
                                    </div>
                                </form>
                            @break

                            @case(3)
                                <form action="{{ route('keranjang.store') }}" method="post" enctype="multipart/form-data">
                                    <div class="card">
                                        <div class="card-body">
                                            @csrf
                                            <input type="hidden" name="produk_id" id="Dproduk_idKartuNama"
                                                value="{{ $produk->id }}">
                                            <input type="hidden" id="DhargaKartuNama" value="{{ $produk->harga }}">
                                            {{-- <input type="hidden" id="totalHargaDKartuNama" value=""> --}}


                                            <div class="form-group row">

                                                <label for="DfotoKartuNama" class="col-md-3 col-form-label">Foto Sendiri :</label>
                                                <div class="col-md-9">
                                                    <input type="file" id="DfotoKartuNama" required
                                                        class="form-control @error('foto')
                                                is-invalid
                                            @enderror"
                                                        name="foto">
                                                    @error('foto')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <label for="DketeranganKartuNama" class="col-md-3 col-form-label">Keterangan
                                                    :</label>
                                                <div class="col-md-9">
                                                    <textarea name="keterangan" class="form-control" id="DketeranganKartuNama"></textarea>
                                                    @error('keterangan')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <label for="DjumlahKartuNama" class="col-md-3 col-form-label">Jumlah Per Kotak
                                                    :</label>
                                                <div class="col-md-9">
                                                    <input type="number" class="form-control" id="DjumlahKartuNama"
                                                        name="kuantitas" placeholder="Masukkan Julah Pembelian"
                                                        onkeyup="DshowTotalKartuNama()" required min="1"
                                                        max="{{ $produk->stok }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="" class="col-md-3 col-form-label">Stok :</label>
                                                <div class="col-md-9">
                                                    <input disabled class="form-control" value="{{ $produk->stok }}">
                                                </div>
                                            </div>
                                            <h5 id="DtotalKartuNama">Hasil</h3>
                                                <p id="DhargaAwalSpanduk">*Keterangan : {{ FormatRupiah($produk->harga, true) }}
                                                    Per Kotak'</p>

                                        </div>
                                        <div class="card-footer text-right">
                                            <button type="submit" class="btn btn-success"><i class="fas fa-shopping-cart"></i>
                                                Keranjang</button>
                                        </div>
                                    </div>
                                </form>
                            @break

                            @case(4)
                                <form action="{{ route('keranjang.store') }}" method="post" enctype="multipart/form-data">
                                    <div class="card">
                                        <div class="card-body">
                                            @csrf
                                            <input type="hidden" name="produk_id" id="Dproduk_idBrosur"
                                                value="{{ $produk->id }}">
                                            <input type="hidden" id="DhargaBrosur" value="{{ $produk->harga }}">
                                            {{-- <input type="hidden" id="totalHargaDBrosur" value=""> --}}


                                            <div class="form-group row">

                                                <label for="DkertasBrosur" class="col-md-3 col-form-label">Jenis Kertas :</label>
                                                <div class="col-md-9">
                                                    A4 <input type="radio" name="kertas" id="DkertasBrosur" value="A4"
                                                        required>
                                                    A5 <input type="radio" name="kertas" id="DkertasBrosur" value="A5">
                                                    @error('kertas')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <label for="DfotoBrosur" class="col-md-3 col-form-label">Foto Sendiri :</label>
                                                <div class="col-md-9">
                                                    <input type="file" id="DfotoBrosur" required
                                                        class="form-control @error('foto')
                                                is-invalid
                                            @enderror"
                                                        name="foto">
                                                    @error('foto')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <label for="DketeranganBrosur" class="col-md-3 col-form-label">Keterangan
                                                    :</label>
                                                <div class="col-md-9">
                                                    <textarea name="keterangan" class="form-control" id="DketeranganBrosur"></textarea>
                                                    @error('keterangan')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <label for="DjumlahBrosur" class="col-md-3 col-form-label">Jumlah :</label>
                                                <div class="col-md-9">
                                                    <input type="number" class="form-control" id="DjumlahBrosur"
                                                        name="kuantitas" onkeyup="DshowTotalBrosur()"
                                                        placeholder="Masukkan Julah Pembelian" min="1"
                                                        max="{{ $produk->stok }}" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="" class="col-md-3 col-form-label">Stok :</label>
                                                <div class="col-md-9">
                                                    <input disabled class="form-control" value="{{ $produk->stok }}">
                                                </div>
                                            </div>
                                            <h5 id="DtotalBrosur">Hasil</h3>
                                                <p id="DhargaAwalSpanduk">*Keterangan : {{ FormatRupiah($produk->harga, true) }}
                                                    Per Rim'</p>

                                        </div>
                                        <div class="card-footer text-right">
                                            <button type="submit" class="btn btn-success"><i class="fas fa-shopping-cart"></i>
                                                Keranjang</button>
                                        </div>
                                    </div>
                                </form>
                            @break

                            @default
                                <form action="{{ route('keranjang.store') }}" method="post">
                                    <div class="card">
                                        <div class="card-body">
                                            @csrf
                                            <input type="hidden" name="produk_id" id="produk_idProduk"
                                                value="{{ $produk->id }}">
                                            <input type="hidden" name="produk_id" id="DhargaProduk"
                                                value="{{ $produk->harga }}">
                                            <h3>{{ $produk->nama }}</h3>

                                            <div class="form-group row">

                                                <label for="" class="col-md-3 col-form-label">Jumlah :</label>
                                                <div class="col-md-9">
                                                    <input type="number" class="form-control" name="kuantitas"
                                                        id="DjumlahProduk" placeholder="Masukkan Julah Pembelian"
                                                        onkeyup="DshowTotalProduk()" min="1" max="{{ $produk->stok }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="" class="col-md-3 col-form-label">Stok :</label>
                                                <div class="col-md-9">
                                                    <input disabled class="form-control" value="{{ $produk->stok }}">
                                                </div>
                                            </div>
                                            {{-- <h5>Rp. {{ number_format($produk->harga) }}</h5> --}}

                                            <h5 id="DtotalProduk">Hasil</h3>
                                                <p id="DhargaAwalProduk">*Keterangan : {{ FormatRupiah($produk->harga, true) }}
                                                    Per Produk'</p>

                                        </div>
                                        <div class="card-footer text-right">
                                            <button type="submit" class="btn btn-success"><i class="fas fa-shopping-cart"></i>
                                                Keranjang</button>
                                        </div>
                                    </div>
                                </form>
                        @endswitch
                    </div>


                </div>

                <div class="card detail">
                    <div class="card-body">
                        <h2>Detail Produk</h2>
                        <p>{!! $produk->deskripsi !!}</p>
                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection
@push('js')
    <script>
        function DshowTotalStiker() {
            var panjang = $('#DpanjangStiker').val();
            var lebar = $('#DlebarStiker').val();
            var jumlah = $('#DjumlahStiker').val();
            var harga = $('#DhargaStiker').val();
            var luas = parseFloat(panjang) * parseFloat(lebar);
            var total = luas * jumlah * harga;
            var html = '';
            $('#DtotalHargaStiker').val(total)
            html = '' +
                '<h5> Rp. ' + formatUang(parseInt(total).toString()) + '</h5>';
            $('#DtotalStiker').html(html);
        }

        function DshowTotalSpanduk() {
            var panjang = $('#DpanjangSpanduk').val();
            var lebar = $('#DlebarSpanduk').val();
            var jumlah = $('#DjumlahSpanduk').val();
            var harga = $('#DhargaSpanduk').val();
            var luas = parseFloat(panjang) * parseFloat(lebar);
            var total = luas * jumlah * harga;
            var html = '';
            // $('#DtotalHargaSpanduk').val(total)
            html = '' +
                '<h5> Rp. ' + formatUang(parseInt(total).toString()) + '</h5>';
            $('#DtotalSpanduk').html(html);
        }

        function DshowTotalKartuNama() {
            var jumlah = $('#DjumlahKartuNama').val();
            var harga = $('#DhargaKartuNama').val();
            var total = jumlah * harga;
            var html = '';
            // $('#DtotalHargaKartuNama').val(total)
            html = '' +
                '<h5> Rp. ' + formatUang(parseInt(total).toString()) + '</h5>';
            $('#DtotalKartuNama').html(html);
        }

        function DshowTotalBrosur() {
            var jumlah = $('#DjumlahBrosur').val();
            var harga = $('#DhargaBrosur').val();
            var total = jumlah * harga;
            var html = '';
            // $('#DtotalHargaBrosur').val(total)
            html = '' +
                '<h5> Rp. ' + formatUang(parseInt(total).toString()) + '</h5>';
            $('#DtotalBrosur').html(html);
        }

        function DshowTotalProduk() {
            var jumlah = $('#DjumlahProduk').val();
            var harga = $('#DhargaProduk').val();
            var total = jumlah * harga;
            var html = '';
            // $('#DtotalHargaProduk').val(total)
            html = '' +
                '<h5> Rp. ' + formatUang(parseInt(total).toString()) + '</h5>';
            $('#DtotalProduk').html(html);
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
