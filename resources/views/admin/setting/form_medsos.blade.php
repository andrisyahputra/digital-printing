@extends('layouts.app_bsadmin2')
@section('content')
    {!! Form::model($model, [
        'route' => $route,
        'method' => $method,
    ]) !!}
    <div class="card shadow bg-white">
        <div class="card-body">

            <div class="mb-3 form-group row">
                {!! Form::label('fb', 'Facebook', ['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('fb', null, [
                        'class' => 'form-control',
                        'id' => 'fb',
                        'placeholder' => 'Masukkan URL Facebook Anda',
                    ]) !!}
                    <span class="text-danger">{{ $errors->first('fb') }}</span>
                </div>
            </div>


            <div class="mb-3 form-group row">
                {!! Form::label('ig', 'Instagram', ['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('ig', null, [
                        'class' => 'form-control',
                        'ig' => 'ig',
                        'placeholder' => 'Masukkan URL Instagram Anda',
                    ]) !!}
                    <span class="text-danger">{{ $errors->first('ig') }}</span>
                </div>
            </div>

            <div class="mb-3 form-group row">
                {!! Form::label('twitter', 'Twitter', ['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('twitter', null, [
                        'class' => 'form-control',
                        'id' => 'twitter',
                        'placeholder' => 'Masukkan URL Twitter Anda',
                    ]) !!}
                    <span class="text-danger">{{ $errors->first('twitter') }}</span>
                </div>
            </div>

            <div class="mb-3 form-group row">
                {!! Form::label('yt', 'Youtube', ['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('yt', null, [
                        'class' => 'form-control',
                        'id' => 'yt',
                        'placeholder' => 'Masukkan URL Youtube Anda',
                    ]) !!}
                    <span class="text-danger">{{ $errors->first('yt') }}</span>
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
