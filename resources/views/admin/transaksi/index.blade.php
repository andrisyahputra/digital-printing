@extends('layouts.app_bsadmin2')
@section('content')
    <div class="card shadow bg-white mt-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="tables">
                    <thead>
                        <tr>
                            <th class="text-nowrap" style="width: 20px">No</th>
                            <th class="text-nowrap">Order ID</th>
                            <th class="text-nowrap">Pembeli</th>
                            <th class="text-nowrap">Harga</th>
                            <th class="text-nowrap">Tanggal</th>
                            <th class="text-nowrap">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksis as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->order_id }}</td>
                                <td>{{ $item->pembeli }}</td>
                                <td>Rp {{ number_format($item->harga) }}</td>
                                <td>{{ $item->created_at_id() }}</td>
                                <td class="text-capitalize">{{ $item->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>
@endsection
