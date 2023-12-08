@extends('layouts.app_bsadmin2')
@section('content')
    <div class="card shadow bg-white mt-3">
        <div class="card-body">
            {!! Form::model(auth()->user(), [
                'route' => 'profile.update',
                'method' => 'PUT',
                'enctype' => 'multipart/form-data',
            ]) !!}
            @method('patch')
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3 form-group">
                        <label for="name" class="form-label">Nama</label>
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Masukkan name']) !!}
                        <span class="text-danger">{!! $errors->first('name') !!}</span>
                    </div>

                    <div class="mb-3 form-group">
                        <label for="email" class="form-label">Email</label>
                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Masukkan email']) !!}
                        <span class="text-danger">{!! $errors->first('email') !!}</span>
                    </div>

                    <div class="mb-3 form-group">
                        <label for="notelp" class="form-label">Nomor Telpon Anda</label>
                        {!! Form::tel('notelp', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Masukkan Nomor Hp Anda',
                            'id' => 'notelp',
                        ]) !!}
                        <span class="text-danger">{!! $errors->first('notelp') !!}</span>
                    </div>

                    <div class="mb-3 form-group">
                        <label for="nowa" class="form-label">Nomor WhatsApp</label>
                        {!! Form::tel('nowa', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Masukkan Nomor Hp Anda',
                            'id' => 'nowa',
                        ]) !!}
                        <span class="text-danger">{!! $errors->first('nowa') !!}</span>
                    </div>



                    <div class="mb-3 form-group">
                        <label for="password" class="form-label">Password</label>
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Masukkan Password Baru']) !!}
                        <span class="text-danger">{!! $errors->first('password') !!}</span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3 form-group">
                        @isset(auth()->user()->foto)
                            <a target="_blank" href="{{ Storage::url(auth()->user()->foto) }}">
                                <img width="300" alt="{{ auth()->user()->foto }}"
                                    src="{{ Storage::url(auth()->user()->foto) }}" class="img-thumbnail">
                            </a>
                        @endisset
                        {!! Form::file('foto', [
                            'class' => 'form-control mt-3',
                        ]) !!}

                        <span class="text-danger">{{ $errors->first('foto') }}</span>
                    </div>

                    <div class="mb-3 form-group">
                        {{-- {!! Form::label('alamat', 'Alamat Domisili', ['class' => 'col-sm-3 col-form-label']) !!}

                        {!! Form::textarea('alamat', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Masukkan Alamat Lengkap',
                        ]) !!}

                        <span class="text-danger">{{ $errors->first('alamat') }}</span> --}}

                    </div>


                </div>
            </div>







            {!! Form::submit('Simpan Perubahan', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection
