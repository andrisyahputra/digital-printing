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
                                    <p class="lead">
                                        Silakan Buat Password baru
                                    </p>
                                </div>
                                <form action="{{ route('password.store') }}" method="post">
                                    @csrf

                                    <!-- Password Reset Token -->
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                    <div class="form-group">
                                        <input name="email" value="{{ old('email', $request->email) }}" type="email"
                                            class="form-control form-control-user @error('email')
                                            is-invalid
                                        @enderror"
                                            id="exampleInputEmail" aria-describedby="emailHelp"
                                            placeholder="Masukkan Email Anda..." required>

                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input name="password" type="password"
                                            class="form-control form-control-user @error('password')
                                            is-invalid
                                        @enderror"
                                            required autocomplete="new-password"
                                            placeholder="Masukkan password Baru Anda...">

                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input name="password_confirmation" type="password"
                                            class="form-control form-control-user @error('password_confirmation')
                                            is-invalid
                                        @enderror"
                                            required autocomplete="new-password"
                                            placeholder="Masukkan Konfirmasi Password Anda...">

                                        @error('password_confirmation')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Reset Password
                                    </button>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
