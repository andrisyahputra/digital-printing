@extends('layouts.app_onlineshop')

@section('content')
    <div class="row justify-content-center" id="login">

        <div class="col-md-8">

            <div class="card o-hidden border-0 shadow-lg my-2">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">

                                    <h1 class="h4 text-gray-900 mb-1 mt-1">Daftar Akun</h1>
                                    <p class="lead">
                                        Silakan Daftar Akun untuk Membeli Produk melalui website ini.
                                    </p>
                                </div>
                                <form method="post" class="user" action="{{ route('register') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="nama" class="col-md-4 col-form-label">
                                            Nama Lengkap :
                                        </label>
                                        <div class="col-md-8">
                                            <input id="nama" type="text" name="name" value="{{ old('name') }}"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Masukan Nama...">

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label">
                                            Email :
                                        </label>
                                        <div class="col-md-8">
                                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Masukan Email...">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-md-4 col-form-label">
                                            Password :
                                        </label>
                                        <div class="col-md-8">
                                            <input type="password" name="password" autocomplete="new-password"
                                                id="password" class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Masukan Password...">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm" class="col-md-4 col-form-label">
                                            Konfirmasi Password :
                                        </label>
                                        <div class="col-md-8">
                                            <input type="password" id="password-confirm" name="password_confirmation"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                autocomplete="new-password" placeholder="Masukan Password Konfirmasi...">

                                            @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-md-4 col-form-label">
                                            No Telp :
                                        </label>
                                        <div class="col-md-8">
                                            <input type="tel" value="{{ old('notelp') }}" name="notelp"
                                                class="form-control @error('notelp') is-invalid @enderror"
                                                placeholder="Masukan No WA...">

                                            @error('notelp')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-md-4 col-form-label">
                                            No WA :
                                        </label>
                                        <div class="col-md-8">
                                            <input type="tel" value="{{ old('nowa') }}" name="nowa"
                                                class="form-control @error('nowa') is-invalid @enderror"
                                                placeholder="Masukan No WA...">
                                            @error('nowa')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-md-4 col-form-label">
                                            Foto :
                                        </label>
                                        <div class="col-md-8">
                                            <input type="file" name="foto"
                                                class="form-control @error('foto') is-invalid @enderror">

                                            @error('foto')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>


                                    <div class="text-right">
                                        <a href="{{ route('login') }}" class="btn btn-info me-2 ">
                                            Sudah Punya Akun
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            Daftar
                                        </button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
