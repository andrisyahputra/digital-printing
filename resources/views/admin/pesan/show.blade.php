@extends('layouts.app_bsadmin2')
@section('content')
    <div class="card shadow bg-white">
        <div class="card-body">

            <div class="form-group row">
                <label for="nama" class="col-sm-3 col-form-label">Nama :</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" value="{{ $pesans->nama }}" id="nama" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">Email :</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" value="{{ $pesans->email }}" id="email" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="nowa" class="col-sm-3 col-form-label">No Telpon/WA :</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" value="{{ $pesans->nowa }}" id="nowa" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Isi Pesan :</label>
                <div class="col-sm-9">
                    <textarea class="form-control" readonly>{{ $pesans->pesan }}</textarea>
                </div>
            </div>

        </div>
    </div>
@endsection
