@extends('layouts.app_bsadmin2')
@section('content')
    {!! Form::model($model, [
        'route' => $route,
        'method' => $method,
        'enctype' => 'multipart/form-data',
    ]) !!}
    <div class="card shadow bg-white">
        <div class="card-body">

            <div class="mb-3 form-group row">
                {!! Form::label('kategori_id', 'Kategori Produk', ['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-9">

                    {!! Form::select('kategori_id', $kategoris, null, [
                        'class' => 'form-control',
                        'required',
                        'placeholder' => 'Pilih Kategori Produk',
                    ]) !!}
                    <span class="text-danger">{{ $errors->first('kategori_id') }}</span>
                </div>
            </div>

            <div class="mb-3 form-group row">
                {!! Form::label('nama', 'Nama Produk', ['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('nama', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Masukkan Nama Produk',
                    ]) !!}
                    <span class="text-danger">{{ $errors->first('nama') }}</span>
                </div>
            </div>

            <div class="mb-3 form-group row">
                {!! Form::label('foto', 'Foto Produk', ['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-9">
                    @isset($model->foto)
                        <a target="_blank" href="{{ Storage::url($model->foto) }}">
                            <img width="150" alt="{{ $model->foto }}" src="{{ Storage::url($model->foto) }}"
                                class="img-thumbnail">
                        </a>
                    @endisset
                    {!! Form::file('foto', [
                        'class' => 'form-control',
                    ]) !!}

                    <span class="text-danger">{{ $errors->first('foto') }}</span>
                </div>
            </div>

            <div class="mb-3 form-group row">
                {!! Form::label('stok', 'Stok Produk', ['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-9">
                    {!! Form::number('stok', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Masukkan Berat Produk',
                    ]) !!}

                    <span class="text-danger">{{ $errors->first('stok') }}</span>
                </div>
            </div>

            <div class="mb-3 form-group row">
                {!! Form::label('weight', 'Berat Produk Berapa Gram', ['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-9">
                    {!! Form::number('weight', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Masukkan weight Produk',
                    ]) !!}

                    <span class="text-danger">{{ $errors->first('stok') }}</span>
                </div>
            </div>

            <div class="mb-3 form-group row">
                {!! Form::label('harga', 'Harga Produk', ['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-9">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                        {!! Form::number('harga', null, [
                            'class' => 'form-control text-right curencyField',
                            'placeholder' => 'Masukkan harga Produk',
                        ]) !!}
                    </div>
                    <span class="text-danger">{{ $errors->first('stok') }}</span>
                </div>
            </div>

            <div class="mb-3 form-group row">
                {!! Form::label('deskripsi', 'Deskripsi Produk', ['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-9">
                    {!! Form::textarea('deskripsi', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Masukkan Deskripsi Produk',
                        'id' => 'summernote',
                    ]) !!}

                    <span class="text-danger">{{ $errors->first('deskripsi') }}</span>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <div class="text-right">

                {!! Form::submit('Simpan', ['class' => 'btn btn-success']) !!}
            </div>

        </div>

        {{-- <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf --}}


        {{-- <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Foto Produk</label>
                    <div class="col-sm-9">
                        <div class="input-foto">
                            <input type="file" name="foto[]" class="form-control" required>
                        </div>
                        <span class="btn btn-sm btn-success mt-3 btn-tambah">
                            <i class="fas fa-plus"></i>
                        </span>
                        @error('foto')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Nama Ketegori</label>
                    <div class="col-sm-9">
                        <select name="id_kategori" class="form-control" required>
                            <option selected disabled>Pilih Nama Kategori</option>
                            <php foreach ($kategori as $key => $item) : ?>
                            <option value="<= $item['id_kategori'] ?>"><= $item['nama_kategori'] ?></option>
                            <php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Nama Produk</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="nama" placeholder="Masukan Produk" required>
                    </div>
                    @error('nama')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Harga Produk</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="harga" placeholder="Masukan Harga" required>
                    </div>
                    @error('harga')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Berat Produk</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="berat" placeholder="Masukan Berat" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Foto Produk</label>
                    <div class="col-sm-9">
                        <div class="input-foto">
                            <input type="file" name="foto[]" class="form-control" required>
                        </div>
                        <span class="btn btn-sm btn-success mt-3 btn-tambah">
                            <i class="fas fa-plus"></i>
                        </span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Deskripsi Produk</label>
                    <div class="col-sm-9">
                        <div class="mb-3">
                            <label for="" class="form-label"></label>
                            <textarea type="text" class="form-control" name="deskripsi" placeholder="Masukan Produk" rows="3"></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Stok Produk</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="stok" placeholder="Masukan Stok" required>
                    </div>
                </div>

            </div>
            --}}
        {{-- </div> --}}
        {!! Form::close() !!}
    </div>
    {{-- </form> --}}
@endsection
