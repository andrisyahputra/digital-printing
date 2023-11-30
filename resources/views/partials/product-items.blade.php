@push('css')
    <style>
        .habis{
            /* filter: brightness(50%); */
            position: relative;
        }
        .inner_text{
            background-color: rgba(0, 0, 0, 0.212);
            color: white !important;
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

<div class="col-xl-3 col-lg-4 col-md-4 col-12">
    <div class="single-product {{ $produk->stok == 0 ? 'habis' : '' }}">
        <div class="inner_text" style="{{ $produk->stok == 0 ? 'display: flex;' : '' }}"><div style="width: 100%; text-align: center">Habis</div></div>
        <div class="product-img">
            <a href="{{ route('product-details', $produk->id) }}">
                <img class="default-img" src="{{ Storage::url($produk->foto) }}" alt="{{ $produk->foto }}">
                <img class="hover-img" src="{{ Storage::url($produk->foto) }}" alt="{{ $produk->foto }}">
            </a>
            <div class="button-head">
                <div class="product-action">
                    <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="{{ url("#") }}"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                    <a title="Wishlist" href="{{ url("#") }}"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                    <a title="Compare" href="{{ url("#") }}"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
                </div>
                <div class="product-action-2">
                    <a onclick="add_card({{ $produk->id }},{{ $produk->stok }})">Tambah Keranjan</a>

                </div>
            </div>
        </div>
        <div class="product-content">
            <h3><a href="{{ route('product-details', $produk->id) }}">{{ $produk->nama }}</a></h3>
            <div class="product-price">
                <span>Rp. {{ number_format($produk->harga) }}</span>
            </div>
        </div>
    </div>
</div>
