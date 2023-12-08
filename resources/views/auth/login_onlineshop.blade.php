@extends('layouts.app_onlineshop')

@section('content')
    <!-- Outer Row -->
    <div class="row justify-content-center" id="login">

        <div class="col-md-5">

            <div class="card o-hidden border-0 shadow-lg my-2">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="px-5 pb-5 pt-1">
                                <div class="text-center">
                                    <img src="https://xsgames.co/randomusers/avatar.php?g=male&1" alt="logo.png"
                                        class="img-fluid rounded-circle" width="132" height="132">
                                </div>
                                <div class="text-center">
                                    <h1 class="h2">Selamat Datang di TokoOnline</h1>
                                    <p class="lead">
                                        Silakan login
                                    </p>
                                </div>
                                <form method="post" class="user" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="" class="col-md-2 col-form-label">
                                            <i class="fas fa-envelope"></i>
                                        </label>
                                        <div class="col-md-10">
                                            <input type="email" name="email"
                                                class="form-control  @error('email') is-invalid @enderror"
                                                placeholder="Masukan Email...">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-md-2 col-form-label">
                                            <i class="fas fa-lock"></i>
                                        </label>
                                        <div class="col-md-10">
                                            <input type="password" name="password"
                                                class="form-control  @error('password') is-invalid @enderror"
                                                placeholder="Masukan Password...">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="text-right">
                                        <a href="{{ route('register') }}" class="btn btn-info mr-3">
                                            Daftar Akun
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            Login
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
