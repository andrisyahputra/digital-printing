@extends('layouts.app_bsadmin2')
@section('content')
    <div class="card shadow bg-white mt-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="tables">
                    <thead>
                        <tr>
                            <th class="text-nowrap" style="width: 20px">No</th>
                            <th class="text-nowrap">Nama</th>
                            <th class="text-nowrap">Email</th>
                            <th class="text-nowrap">Nomor Telp/WA</th>
                            <th class="text-nowrap" style="width: 170px">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesans as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->nowa }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('kontak.show', $item->id) }}"
                                        role="button">Cek
                                        Pesan</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>
@endsection
