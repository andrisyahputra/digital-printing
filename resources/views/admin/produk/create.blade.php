@extends('layouts.dashboard')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="row row-cols-1 row-cols-lg-2">
            <div class="col">
                    <div class="form-group mb-3">
                        <label for="foto">Foto:</label>
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" placeholder="Upload foto">
                        @error('foto')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama produk" value="{{ old('nama') }}">
                        @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="harga">Harga:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                            <input type="number" class="form-control text-end curencyField @error('harga') is-invalid @enderror" id="harga" name="harga" placeholder="Harga produk" value="{{ old('harga') }}" aria-describedby="basic-addon1">
                        </div>
                        @error('harga')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="stok">Stok:</label>

                            <input type="number" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" placeholder="Stok Produk" value="{{ old('stok', 1) }}" aria-describedby="basic-addon1" min="1">

                        @error('stok')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group mb-3">
                        <label for="kategori_id">Kategori:</label>
                        <select class="form-control @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" placeholder="Pilih kategori">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('kategori_id') == $category->id ? 'selected' : '' }}>{{ $category->nama }}</option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
            </div>
            <div class="col">
                <div class="form-group mb-3">
                    <label for="deskripsi">Deskripsi:</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" placeholder="Deskripsi produk" rows="7">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-lg-end">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
    </div>
</div>
@endsection
