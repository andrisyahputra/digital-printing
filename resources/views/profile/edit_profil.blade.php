@extends('layouts.dashboard')
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('profile.update') }}" method="post">
                @csrf
                @method('patch')
                <div class="com-md-12 col-lg-6">


                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="nama" placeholder="Masukkan Nama!!" value="{{ old('name', auth()->user()->name) }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" rows="3"
                            placeholder="Masukkan Alamat!!">{{ old('name', auth()->user()->alamat) }}</textarea>

                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
