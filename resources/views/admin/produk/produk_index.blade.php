@extends('layouts.app_bsadmin2')
@section('content')
    {{-- <a href="index.php?halaman=tambah_produk" class="btn btn-sm btn-success">Tambah</a> --}}

    <div class="card shadow bg-white mt-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="tables">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Berat</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Foto</th>
                            <th scope="col">opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produks as $item)
                            <tr class="">
                                <td width="50">{{ $loop->iteration }}</td>
                                <td>{{ $item->kategori->nama }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ FormatRupiah($item->harga, true) }}</td>
                                <td>{{ $item->weight }} Gram</td>
                                <td>{{ $item->stok }}</td>
                                <td>{{ $item->created_at->translatedFormat('d-m-Y') }}</td>
                                <td class="text-center">
                                    <a href="{{ Storage::url($item->foto) }}">
                                        <img alt="{{ $item->foto }}" src="{{ Storage::url($item->foto) }}" width="100"
                                            class="img-fluid">
                                    </a>
                                </td>
                                <td width="150">
                                    <div class="d-flex justify-content-between">

                                        <a class="btn btn-warning mr-1"
                                            href="{{ route('produk.edit', $item->id) }}">Edit</a>
                                        <form action="{{ route('produk.destroy', $item->id) }}" method="post"
                                            id="dalete_form{{ $item->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger"
                                                onclick="hapus_data('#dalete_form{{ $item->id }}')">Hapus</button>
                                        </form>
                                    </div>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
