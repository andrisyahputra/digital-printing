@extends('layouts.app_onlineshop')

@section('content')
    <!-- Hero Section Mulai-->
    <section class="hero">
        <div id="owl-nav"> </div>
        <div class="owl-carousel owl-theme">

            <div class="item">
                <img src="asset/foto/slider/slider1.jpg" alt="slider1.jpg">
                <main class="content">
                    <h1>Toko <span>Online</span></h1>
                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Odio, ad repudiandae. At ullam
                        odio voluptates.
                    </p>
                    <a href="#" class="btn btn-primary">Beli Sekarang</a>
                </main>
            </div>

            <div class="item">
                <img src="asset/foto/slider/slider2.jpg" alt="slider2.jpg">
                <main class="content">
                    <h1>Toko <span>Online</span></h1>
                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Odio, ad repudiandae. At ullam
                        odio voluptates.
                    </p>
                    <a href="#" class="btn btn-primary">Beli Sekarang</a>
                </main>
            </div>

            <div class="item">
                <img src="asset/foto/slider/slider3.jpg" alt="slider3.jpg">
                <main class="content">
                    <h1>Toko <span>Online</span></h1>
                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Odio, ad repudiandae. At ullam
                        odio voluptates.
                    </p>
                    <a href="#" class="btn btn-primary">Beli Sekarang</a>
                </main>
            </div>

        </div>
    </section>
    <!-- Hero Section Akhir -->


    <div class="about">
        <div class="row">
            <div class="col-md-6 about-img">
                <img src="asset/foto/slider/slider1.jpg" alt="slider1.jpg">
            </div>
            <div class="col-md-6 content">
                <h3>Kenapa Memilih Produk Kami</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque error facere totam magnam sequi
                    minus.
                </p>
                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem, sed.
                </p>
            </div>
        </div>
    </div>
    <!-- about tentangkami akhir -->

    <!-- produk section mulai -->
    <section class="produk">
        <div class="produk-box">
            <h2><span>Produk</span> Kami</h2>
        </div>
        {{-- <div class="nav-main"> --}}
        <!-- Tab Nav -->
        {{-- <ul class="nav nav-tabs" id="myTab" role="tablist"> --}}
        <div class="row d-flex justify-content-center ">
            <ul class="nav nav-tabs" id="myTabs">
                <li class="nav-item">
                    <a class="nav-link active" id="tab" data-bs-toggle="tab"
                        href="{{ url('#semua_produk') }}">Semua</a>
                </li>

                @foreach ($kategoris as $kategori)
                    <li class="nav-item">
                        <a class="nav-link" id="tab{{ $kategori->id }}" data-bs-toggle="tab"
                            href="{{ url('#kategori_' . $kategori->id) }}">{{ $kategori->nama }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="tab-content mt-2">
            <div class="tab-pane fade show active" id="semua_produk">
                <div class="row">
                    @foreach ($produks as $produk)
                        <div class="col-md-3 ">
                            @include('front.produk.produk-item')
                        </div>
                    @endforeach
                </div>
            </div>
            @foreach ($kategoris as $kategori)
                <div class="tab-pane fade" id="kategori_{{ $kategori->id }}">
                    <div class="row">
                        @foreach ($kategori->produks as $produk)
                            <div class="col-md-3 ">
                                @include('front.produk.produk-item')
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>


    </section>
    <!-- produk section end -->
    <!-- kontak mulai -->
    <section class="kontak">
        <div class="judul"><span>Kontak</span> Kami</div>
        <div class="row">
            <div class="col-md-6 kontak-map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63709.55260437139!2d98.46000389159218!3d3.6224091779540846!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3030d60114970f8d%3A0x3039d80b220cbd0!2sBinjai%2C%20Kota%20Binjai%2C%20Sumatera%20Utara!5e0!3m2!1sid!2sid!4v1691080784795!5m2!1sid!2sid"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-md-6 kontak-form">
                <form method="post">
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">
                                    Nama Lengkap :
                                </label>
                                <div class="col-sm-8">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="nama"
                                            placeholder="Masukkan Nama Lengkap Anda ." required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">
                                    Email :
                                </label>
                                <div class="col-sm-8">
                                    <div class="mb-3">
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Masukkan Email  Anda ." required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">
                                    No WA :
                                </label>
                                <div class="col-sm-8">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="nowa"
                                            placeholder="Masukkan Nomor WA Anda ." required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">
                                    Pesan :
                                </label>
                                <div class="col-sm-8">
                                    <div class="mb-3">
                                        <textarea class="form-control" name="pesan" placeholder="Masukkan Pesan Anda ." required></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <button name="kirim" class="btn btn-primary">Kirim</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- kontak akhir-->

    <!-- Button trigger modal -->








    <!-- Optional: Place to the bottom of scripts -->

    <?php
    // if (isset($_POST['kirim'])) {
    //     $nama = $_POST['nama'];
    //     $email = $_POST['email'];
    //     $nowa = $_POST['nowa'];
    //     $pesan = $_POST['pesan'];
    
    //     $koneksi->query("INSERT INTO pesan
    //                                                                                                                                                                                 (nama,email,no_telepon,isi_pesan) VALUES
    //                                                                                                                                                                                 ('$nama','$email','$nowa','$pesan')
    //                                                                                                                                                                                 ");
    
    //     echo "<script>alert('Pesan Dikirim');</script>";
    //     echo "<script>location='kontak.php';</script>";
    // }
    ?>
@endsection
