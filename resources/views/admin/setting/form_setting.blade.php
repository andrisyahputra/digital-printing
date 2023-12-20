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
                {!! Form::label('gambar_depan', 'Foto Depan', ['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-3">

                    {!! Form::file('gambar_depan', [
                        'class' => 'form-control',
                        'id' => 'gambar_depan',
                    ]) !!}
                    <small>Foto Ukuran 350 X 350</small>

                    <span class="text-danger">{{ $errors->first('gambar_depan') }}</span>
                </div>
                <div class="col-sm-6">
                    @if ($model->gambar_depan != null)
                        <a target="_blank" href="{{ Storage::url($model->gambar_depan) }}">
                            <img style="height: 350px;" class="w-100" alt="{{ $model->gambar_depan }}"
                                src="{{ Storage::url($model->gambar_depan) }}">
                        </a>
                    @else
                        <a target="_blank" href="{{ asset('asset/foto/slider/slider1.jpg') }}">
                            <img style="height: 350px;" class="w-100" alt="defauld.jpg"
                                src="{{ asset('asset/foto/slider/slider1.jpg') }}">
                        </a>
                    @endif
                </div>
            </div>

            <div class="mb-3 form-group row">
                {!! Form::label('gdepan_ket', 'Keterangan Foto Depan', ['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-9">
                    {!! Form::textarea('gdepan_ket', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Masukkan Keterangannya Produk',
                        'id' => 'summernote',
                    ]) !!}

                    <span class="text-danger">{{ $errors->first('gdepan_ket') }}</span>
                </div>
            </div>

            <div class="mb-3 form-group row">
                {!! Form::label('maps', 'Google Maps', ['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-9">
                    {!! Form::textarea('maps', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Masukkan Google Maps Lokasi',
                    ]) !!}

                    <span class="text-danger">{{ $errors->first('maps') }}</span>
                </div>
            </div>

            <div class="mb-3 form-group row">
                {!! Form::label('produk_kami', 'Keterangan Produk Kami', ['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-9">
                    {!! Form::textarea('produk_kami', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Masukkan Keterangannya Produk Kami',
                        'id' => 'summernote2',
                    ]) !!}

                    <span class="text-danger">{{ $errors->first('produk_kami') }}</span>
                </div>
            </div>

            <div class="mb-3 form-group row">
                {!! Form::label('hub_kami', 'Keterangan Hubungi Kami', ['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-9">
                    {!! Form::textarea('hub_kami', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Masukkan Keterangannya Hubungi Kami',
                        'id' => 'summernote3',
                    ]) !!}

                    <span class="text-danger">{{ $errors->first('hub_kami') }}</span>
                </div>
            </div>




        </div>
        <div class="card-footer">
            <div class="text-right">

                {!! Form::submit('Simpan', ['class' => 'btn btn-success']) !!}
            </div>

        </div>
        {!! Form::close() !!}
    </div>
@endsection


@push('js')
    <script>
        $(document).ready(function() {
            $('#summernote2').summernote({
                tabsize: 2,
                height: 200
            });
            $('#summernote3').summernote({
                tabsize: 2,
                height: 200
            });
        });
    </script>
@endpush
