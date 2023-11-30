@extends('layouts.index')
@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-12 col-lg-6">
                <img class="default-img rounded-3" src="{{ Storage::url($produk->foto) }}" alt="{{ $produk->foto }}">
            </div>
            <div class="col-12 col-lg-6 mt-4 mt-lg-0">
                <h4>{{ $produk->nama }}</h3>
                <span class="badge rounded-pill text-bg-warning px-2 mt-2 py-1">{{ $produk->kategori->nama }}</span>
                <div class="mt-3" style="white-space: pre-line">{{ $produk->deskripsi }}</div>
                <h4 class="text-warning">Rp {{ number_format($produk->harga) }}</h4>
                <div class="mt-3 d-flex gap-1">
                    <button type="submit" class="btn btn-primary" onclick="add_card({{ $produk->id }},{{ $produk->stok }})">Tambah Keranjang</button>
                    <button type="button" class="btn btn-primary">Beli</button>
                </div>
            </div>
        </div>
    </div>
@endsection
