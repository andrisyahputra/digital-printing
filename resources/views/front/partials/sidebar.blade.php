<div class="card">
    <div class="card-header">
        <h4>Kategori Produk</h4>
    </div>
    <div class="card-body">
        <ul class="nav navpills flex-column">
            <div class="nav-item">
                <a href="{{ url('produk') }}" class="nav-link">Semua
                    Produk</a>
            </div>
            @foreach ($kategoris as $kategori)
                <div class="nav-item">
                    <a href="{{ route('produk.kategori', $kategori->id) }}" class="nav-link">{{ $kategori->nama }}</a>
                </div>
            @endforeach
        </ul>
    </div>
</div>

{{-- <div class="row d-flex justify-content-center ">
    <ul class="nav nav-tabs" id="myTabs">
        <li class="nav-item">
            <a class="nav-link active" id="tab" data-bs-toggle="tab" href="{{ url('#semua_produk') }}">Semua</a>
        </li>

        @foreach ($kategoris as $kategori)
            <li class="nav-item">
                <a class="nav-link" id="tab{{ $kategori->id }}" data-bs-toggle="tab"
                    href="{{ url('#kategori_' . $kategori->id) }}">{{ $kategori->nama }}</a>
            </li>
        @endforeach
    </ul>
</div> --}}
