@extends('layouts.app_onlineshop')

@section('content')
    <section class="page-produk">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li>Kontak</li>
            </ul>

            <div class="row">
                <div class="col-md-12">
                    <div class="card box mb-2">
                        <div class="card-body">
                            <h2>Hubungi Kami</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur impedit at dolor
                                similique ut quibusdam distinctio, expedita sequi corporis nihil? Dolorem, architecto.
                                Tempora dolorem nobis facere quo eveniet laborum maxime!</p>
                        </div>
                    </div>

                    <form method="post" action="{{ route('pesan-kontak.store') }}">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        <h5 class="text-center">{{ session('success') }}</h5>
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        <h5 class="text-center">{{ session('error') }}</h5>
                                    </div>
                                @endif

                                <div class="form-group row">
                                    <label for="" class="col-sm-4 col-form-label">
                                        Nama Lengkap :
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="mb-3">
                                            <input type="text"
                                                class="form-control @error('nama')
                                                is-invalid
                                            @enderror"
                                                name="nama" placeholder="Masukkan Nama Lengkap Anda ."
                                                value="{{ old('nama') }}" required>

                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-4 col-form-label">
                                        Email :
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="mb-3">
                                            <input type="email"
                                                class="form-control @error('email')
                                                is-invalid
                                            @enderror"
                                                name="email" placeholder="Masukkan Email  Anda ."
                                                value="{{ old('email') }}" required>

                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-4 col-form-label">
                                        No WA :
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="mb-3">
                                            <input type="text"
                                                class="form-control @error('nowa')
                                                is-invalid
                                            @enderror"
                                                name="nowa" placeholder="Masukkan Nomor WA Anda ."
                                                value="{{ old('nowa') }}" required>
                                            @error('nowa')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-4 col-form-label">
                                        Pesan :
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="mb-3">
                                            <textarea
                                                class="form-control @error('pesan')
                                                is-invalid
                                            @enderror"
                                                name="pesan" placeholder="Masukkan Pesan Anda ." required>{{ old('pesan') }}</textarea>
                                            @error('pesan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </div>

                            </div>
                        </div>
                    </form>
                    <div class="card mt-4">
                        <div class="card-body">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63709.55260437139!2d98.46000389159218!3d3.6224091779540846!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3030d60114970f8d%3A0x3039d80b220cbd0!2sBinjai%2C%20Kota%20Binjai%2C%20Sumatera%20Utara!5e0!3m2!1sid!2sid!4v1691080784795!5m2!1sid!2sid"
                                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" width="100%"
                                height="300px"></iframe>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </section>
@endsection
