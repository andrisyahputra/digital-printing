@extends('layouts.app_onlineshop')

@section('content')
    <!-- Outer Row -->
    <div class="row justify-content-center py-5" id="login">

        <div class="col-md-5">

            <div class="card o-hidden border-0 shadow-lg my-2">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="px-5 pb-5 pt-1">

                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Lupa Password?</h1>
                                    <p class="mb-4">Kami mengerti, banyak hal terjadi. Cukup masukkan alamat email Anda di
                                        bawah dan kami akan mengirimkan Anda tautan untuk mengatur ulang kata sandi Anda!
                                    </p>
                                </div>
                                @if (session('status'))
                                    <div class="alert alert-info mb-4">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form action="{{ route('password.email') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input name="email" type="email"
                                            class="form-control form-control-user @error('email')
                                            is-invalid
                                        @enderror"
                                            id="exampleInputEmail" aria-describedby="emailHelp"
                                            placeholder="Masukkan Email Anda...">

                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Reset Password
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('register') }}">Daftar Akun</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="{{ route('login') }}">Sudah Punya Akun</a>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
