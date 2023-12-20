@extends('layouts.app_bsadmin2')
@push('css')
    <link rel="stylesheet" href="{{ URL::asset('asset') }}/css/style.css">
    <style>
        /* hero section */
        /* .hero {
                                    position: relative;
                                    display: flex;
                                    align-items: center;
                                    background-repeat: no-repeat;
                                    background-size: cover;
                                    background-position: center;
                                }

                                .hero .item img {
                                    width: 500px;
                                    height: 500px;
                                }


                                .hero .content {
                                    position: absolute;
                                    top: 20%;
                                    padding: 1.4rem 7%;
                                    max-width: 60rem;
                                    color: #fff;
                                }

                                .hero .content h1 {
                                    font-size: 4rem;
                                    color: #fff;
                                    font-family: font3;
                                    text-shadow: 0px 1px 5px rgba(0, 0, 0, 0.5);
                                }

                                .hero .content h1 span {
                                    color: #800000;
                                }

                                .hero .content p {
                                    font-size: 1.6rem;
                                    margin-top: 1rem;
                                    font-family: font2;
                                    color: #fff;
                                    text-align: justify;
                                    max-width: 70%;
                                    text-shadow: 0px 1px 5px rgba(0, 0, 0, 0.5);
                                }

                                .hero .content .btn {
                                    padding: 0.5rem 2rem;
                                    font-size: 1.2rem;
                                    font-family: font2;
                                    text-shadow: 0px 1px 5px rgba(0, 0, 0, 0.5);
                                } */

        #tombol {
            position: relative;
            z-index: 99;
        }
    </style>
@endpush
@section('content')
    <div class="shadow p-3 mb-3 bg-white rouded">
        <div class="text-left">

            <a href="{{ route('slider.create') }}" class="btn btn-success">
                Tambah
            </a>
        </div>
    </div>

    @foreach ($model as $item)
        <div class="card shadow bg-white mb-3">
            <div class="card-body">
                <div class="hero" style="display: block !important;">
                    <div class="item">
                        <img src="{{ Storage::url($item->gambar_slider) }}" class="w-100" alt="{{ $item->gambar_slider }}">
                        <main class="content">
                            <h1>{{ config('app.name', 'Laravel') }} <span>Online</span></h1>
                            <p>
                                {{ $item->ket_slider }}
                            </p>
                            <a href="{{ route('produk.kategori', $item->kategori_id) }}" class="btn btn-primary">Beli
                                Sekarang</a>
                        </main>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex" id="tombol">

                    <a class="btn btn-warning mr-1" href="{{ route('slider.edit', $item->id) }}">Edit</a>

                    <form action="{{ route('slider.destroy', $item->id) }}" method="post"
                        id="dalete_form{{ $item->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger mr-1"
                            onclick="hapus_data('#dalete_form{{ $item->id }}')">Hapus</button>
                    </form>

                </div>

            </div>
        </div>
    @endforeach
@endsection
