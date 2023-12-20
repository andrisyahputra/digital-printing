@extends('layouts.app_bsadmin2')
@section('content')
    {!! Form::model($model, [
        'route' => $route,
        'method' => $method,
    ]) !!}
    <div class="card shadow bg-white">
        <div class="card-body">

            <div class="mb-3 form-group row">
                {!! Form::label('fot_tentang', 'Footer Tentang Toko', ['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-9">
                    {!! Form::textarea('fot_tentang', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Masukkan Tentang Footer',
                        'id' => 'summernote',
                    ]) !!}
                    <span class="text-danger">{{ $errors->first('fot_tentang') }}</span>
                </div>
            </div>


            <div class="mb-3 form-group row">
                {!! Form::label('fot_alamat', 'Footer Alamat', ['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-9">
                    {!! Form::textarea('fot_alamat', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Masukkan Alamat',
                        'id' => 'summernote2',
                    ]) !!}
                    <span class="text-danger">{{ $errors->first('fot_alamat') }}</span>
                </div>
            </div>

            <div class="mb-3 form-group row">
                {!! Form::label('fot_kontak', 'Footer Kontak', ['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-9">
                    {!! Form::textarea('fot_kontak', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Masukkan Kontak Kami',
                        'id' => 'summernote3',
                    ]) !!}
                    <span class="text-danger">{{ $errors->first('fot_kontak') }}</span>
                </div>
            </div>

            <div class="mb-3 form-group row">
                {!! Form::label('fot_jambuka', 'Footer Jam Buka', ['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-9">
                    {!! Form::textarea('fot_jambuka', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Masukkan Jam Buka',
                        'id' => 'summernote4',
                    ]) !!}
                    <span class="text-danger">{{ $errors->first('fot_jambuka') }}</span>
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
            $('#summernote4').summernote({
                tabsize: 2,
                height: 200
            });
        });
    </script>
@endpush
