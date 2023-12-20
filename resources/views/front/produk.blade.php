@extends('layouts.app_onlineshop')

@section('content')
    <section class="page-produk">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/">Beranda</a></li>
                <li>Produk</li>
                {{-- <php if (isset($keyword)) : ?>
                    <li><= $keyword ?></li>
                <php endif ?> --}}
            </ul>

            <div class="row produk">

                <div class="col-md-3">
                    {{-- <php include 'include/sidebar.php' ?> --}}
                    @include('front.partials.sidebar')
                </div>

                <div class="col-md-9">

                    <div class="card box">
                        <div class="card-body">
                            @if ($setting->produk_kami == null)
                                <h2>Produk Kami</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur impedit at dolor
                                    similique ut quibusdam distinctio, expedita sequi corporis nihil? Dolorem, architecto.
                                    Tempora dolorem nobis facere quo eveniet laborum maxime!</p>
                            @else
                                {!! $setting->produk_kami !!}
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        {{-- <php if (isset($_GET['idkategori'])) : ?>
                            <php foreach ($ketegori_produk as $item) : ?> --}}


                        @forelse ($produks as $produk)
                            <div class="col-md-4 card-produk">
                                @include('front.produk.produk-item')
                                {{-- <div class="card">
                                        <img src="asset/foto_produk/<= $item['foto_produk']; ?>" alt="<= $item['foto_produk']; ?>">
                                        <div class="card-body content">
                                            <h5><= $item['nama_produk'] ?></h5>
                                            <p>Rp. <= number_format($item['harga_produk']) ?></p>
                                            <a href="beli.php?idproduk=<= $item['id_produk']; ?>" class="btn btn-sm btn-success">
                                                <i class="fas fa-shopping-cart"></i> Keranjang
                                            </a>
                                            <a href="detail_produk.php?idproduk=<= $item['id_produk'] ?>" class="btn btn-sm btn-success">
                                                <i class="fas fa-eye"></i> Details
                                            </a>

                                        </div>
                                    </div> --}}
                            </div>
                        @empty
                            <div class="col-md-4 ">
                                <h5 class="text-center my-5">
                                    @isset($_GET['search'])
                                        <u><b>{{ $_GET['search'] }}</b></u>
                                    @endisset

                                    Data Tidak DiTemukan
                                </h5>
                            </div>
                        @endforelse
                        {{-- <php endforeach ?> --}}

                        {{-- <php elseif (isset($keyword)) : ?>
                            <php foreach ($cariproduk as $item) : ?>
                                <div class="col-md-4 card-produk">
                                    <div class="card">
                                        <img src="asset/foto_produk/<= $item['foto_produk']; ?>" alt="<= $item['foto_produk']; ?>">
                                        <div class="card-body content">
                                            <h5><= $item['nama_produk'] ?></h5>
                                            <p>Rp. <= number_format($item['harga_produk']) ?></p>
                                            <a href="beli.php?idproduk=<= $item['id_produk']; ?>" class="btn btn-sm btn-success">
                                                <i class="fas fa-shopping-cart"></i> Keranjang
                                            </a>
                                            <a href="detail_produk.php?idproduk=<= $item['id_produk'] ?>" class="btn btn-sm btn-success">
                                                <i class="fas fa-eye"></i> Details
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            <php endforeach ?>
                            <php if (!empty($keyword)) : ?>
                                <div class="col-md-12 mt-2">
                                    <div class="alert alert-danger shadow">
                                        <p>Pencarian Porduk Tidak Ditemukan</p>
                                    </div>
                                </div>
                            <php endif; ?> --}}

                        {{-- <php else : ?>
                            <php foreach ($produk as $key => $item) : ?>
                                <div class="col-md-4 card-produk">
                                    <div class="card">
                                        <img src="asset/foto_produk/<= $item['foto_produk']; ?>" alt="<= $item['foto_produk']; ?>">
                                        <div class="card-body content">
                                            <h5><= $item['nama_produk'] ?></h5>
                                            <p>Rp. <= number_format($item['harga_produk']) ?></p>
                                            <a href="beli.php?idproduk=<= $item['id_produk']; ?>" class="btn btn-sm btn-success">
                                                <i class="fas fa-shopping-cart"></i> Keranjang
                                            </a>
                                            <a href="detail_produk.php?idproduk=<= $item['id_produk'] ?>" class="btn btn-sm btn-success">
                                                <i class="fas fa-eye"></i> Details
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            <php endforeach; ?>
                        <php endif; ?> --}}
                    </div>
                </div>

            </div>

            @if ($produks->count() > 0)
                <div class="pagination justify-content-center">

                    <li class="page-item prev disabled">
                        <a href="#" class="page-link">Prev</a>
                    </li>

                    <li class="page-item halaman">
                        <a href="#" class="page-link active">1</a>
                    </li>

                    <li class="page-item dots">
                        <a href="#" class="page-link">...</a>
                    </li>

                    <li class="page-item halaman">
                        <a href="#" class="page-link">5</a>
                    </li>

                    <li class="page-item halaman">
                        <a href="#" class="page-link">6</a>
                    </li>

                    <li class="page-item dots">
                        <a href="#" class="page-link">...</a>
                    </li>

                    <li class="page-item next">
                        <a href="#" class="page-link">Next</a>
                    </li>

                </div>
            @endif

        </div>
    </section>
@endsection
