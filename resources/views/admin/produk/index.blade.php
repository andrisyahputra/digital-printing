@extends('layouts.dashboard')
@section('content')
<div class="card">
    <div class="card-body">

        <table class="table table-bordered" id="myTable">
            <thead>
                <tr>
                    <th class="text-nowrap" style="width: 20px">No</th>
                    <th class="text-nowrap">Foto</th>
                    <th class="text-nowrap">Nama</th>
                    <th class="text-nowrap">Harga</th>
                    <th class="text-nowrap">Stok</th>
                    <th class="text-nowrap">Kategori</th>
                    <th class="text-nowrap">Tanggal</th>
                    <th class="text-nowrap" style="width: 170px">Tindakan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produks as $item)
                <tr>
                    <td class="text-nowrap">{{ $loop->iteration}}</td>
                    <td class="text-nowrap">
                        <a href="{{ Storage::url($item->foto) }}">
                            <img alt="{{ $item->foto }}" src="{{ Storage::url($item->foto) }}" width="100" class="img-fluid">
                        </a>
                    </td>
                    <td class="text-nowrap">{{ $item->nama }}</td>
                    <td class="text-nowrap">Rp {{ number_format($item->harga) }}</td>
                    <td class="text-nowrap">{{ $item->stok }}</td>
                    <td class="text-nowrap">{{ $item->kategori->nama }}</td>
                    <td class="text-nowrap">{{ date('d M Y', strtotime($item->created_at)) }}</td>
                    <td class="text-nowrap d-flex gap-2">
                        <a class="btn btn-warning" href="{{ route('produk.edit', $item->id) }}">Edit</a>
                        <form action="{{ route('produk.destroy',$item->id) }}" method="post" id="dalete_form{{ $item->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" onclick="hapus_data('#dalete_form{{ $item->id }}')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </div>
</div>
@endsection
