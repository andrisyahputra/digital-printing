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
                                <div class="mb-4 text-sm text-gray-600">
                                    Terima kasih telah mendaftar! Sebelum memulai, bisakah Anda memverifikasi alamat email
                                    Anda dengan mengeklik tautan yang baru saja kami kirimkan melalui email kepada Anda?
                                    Jika Anda tidak menerima email tersebut, kami dengan senang hati akan mengirimkan email
                                    lainnya kepada Anda.
                                </div>

                                @if (session('status') == 'verification-link-sent')
                                    <div class="mb-4 font-medium text-success text-sm text-green-600">
                                        Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat
                                        pendaftaran.
                                    </div>
                                @endif
                                <hr>
                                <form action="{{ route('verification.send') }}" method="post">
                                    @csrf

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Kirim Ulang Verifikasi Email
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
