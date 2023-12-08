@push('css')
    <style>
        .inner_text {
            background-color: rgba(0, 0, 0, 0.212);
            color: red !important;
            position: absolute;
            z-index: 20;
            text-align: center;
            align-items: center;
            width: 100%;
            height: 100%;
            display: none;
        }
    </style>
@endpush


<div class="card ">
    <div class="inner_text" style="{{ $produk->stok == 0 ? 'display: flex;' : '' }}">
        <h5 style="width: 100%; text-align: center; font-weight: bold; ">Habis</h5>
    </div>
    <img src="{{ Storage::url($produk->foto) }}" alt="{{ $produk->foto }}">
    <div class="card-body content">
        <h5>{{ $produk->nama }}</h5>
        <p>Rp. {{ number_format($produk->harga) }}</p>
        <a class="btn btn-sm btn-success m-1 " onclick="add_card({{ $produk->id }},{{ $produk->stok }})">
            <i class="fas fa-shopping-cart"></i> Tambah Keranjang
        </a>
        <a href="{{ route('product-details', $produk->id) }}" class="btn btn-sm btn-success m-1">
            <i class="fas fa-eye"></i> Details
        </a>

    </div>
</div>
