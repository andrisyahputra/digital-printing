@extends('layouts.app_bsadmin2')
@section('content')
    <div class="card shadow bg-white">
        <div class="card-body">
            {!! Form::model($model, [
                'route' => $route,
                'method' => $method,
                'enctype' => 'multipart/form-data',
            ]) !!}
            <div class="mb-3 form-group row">
                <div class="col-sm-12 mb-2">
                    @isset($model->gambar_slider)
                        <img height="700px" src="{{ Storage::url($model->gambar_slider) }}" class="w-100"
                            alt="{{ $model->gambar_slider }}">
                    @endisset
                </div>

                {!! Form::label('gambar_slider', 'Foto Slide Depan', ['class' => 'col-sm-3 col-form-label']) !!}



                <div class="col-sm-9">

                    {!! Form::file('gambar_slider', [
                        'class' => 'form-control',
                        'id' => 'gambar_slider',
                    ]) !!}
                    <small>Foto Ukuran 1900 X 700</small>

                    <span class="text-danger">{{ $errors->first('gambar_slider') }}</span>
                </div>

            </div>
            <div class="mb-3 form-group row">
                {!! Form::label('ket_slider', 'Keterangan Slider', ['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-9">
                    {!! Form::textarea('ket_slider', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Masukkan Keterangan Slider',
                        'required',
                    ]) !!}
                    <span class="text-danger">{{ $errors->first('ket_slider') }}</span>
                </div>
            </div>

            <div class="mb-3 form-group row">
                {!! Form::label('kategori_id', 'Kategori Slider', ['class' => 'col-sm-3 form-label']) !!}
                <div class="col-sm-9">
                    {!! Form::select('kategori_id', $kategoris, null, [
                        'class' => 'form-control',
                        'placeholder' => 'Pilih Kategori Slider',
                        'required',
                    ]) !!}
                    <span class="text-danger">{{ $errors->first('kategori_id') }}</span>
                </div>
            </div>

            <div class="card-footer">
                <div class="text-right">

                    {!! Form::submit('Simpan', ['class' => 'btn btn-success']) !!}
                </div>

            </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection
