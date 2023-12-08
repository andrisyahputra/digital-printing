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
                        <form action="{{ route('keranjang.store') }}" method="post">
                            <div class="card">
                                <div class="card-body">
                                    @csrf
                                    <input type="hidden" name="produk_id" id="produk_id" value="{{ $produk->id }}">
                                    <h3>{{ $produk->nama }}</h3>

                                    <div class="form-group row">

                                        <label for="" class="col-md-3 col-form-label">Jumlah :</label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" name="kuantitas" value="1"
                                                min="1" max="{{ $produk->stok }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-md-3 col-form-label">Stok :</label>
                                        <div class="col-md-9">
                                            <input disabled class="form-control" value="{{ $produk->stok }}">
                                        </div>
                                    </div>
                                    <h5>Rp. {{ number_format($produk->harga) }}</h5>

                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-shopping-cart"></i>
                                        Keranjang</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card detail">
                    <div class="card-body">
                        <h2>Detail Produk</h2>
                        <p>{{ $produk->deskripsi }}</p>
                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection
