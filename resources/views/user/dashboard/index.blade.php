@extends('layouts.app_bsadmin2')

@section('content')
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pesanan Sudah Dibayar</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Order ID</th>
                                    <th class="d-none d-xl-table-cell">
                                        Jumlah Pesanan
                                    </th>
                                    <th class="d-none d-md-table-cell">
                                        Tanggal
                                    </th>
                                    <th class="d-none d-md-table-cell">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pesansBayar as $index => $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $index }}</td>
                                        <td class="d-none d-xl-table-cell">
                                            {{ $item->count() }}
                                            {{-- tes1 --}}
                                        </td>
                                        <td class="d-none d-xl-table-cell">
                                            {{ $item->first()->created_at_id() }}
                                            {{-- tes1 --}}
                                        </td>
                                        <td>
                                            <span
                                                class="badge text-white
                                            @switch($item->first()->status)
                        @case('pending')
                            bg-warning
                        @break

                        @case('success')
                           bg-success
                        @break

                        @case('diproses')
                            bg-primary
                        @break

                        @case('dikirim')
                            bg-info
                        @break

                        @case('cancel')
                            bg-danger
                        @break

                        @case('tolak')
                            bg-danger
                        @break
                    @endswitch
                    ">
                                                {{ $item->first()->status }}

                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <td class="text-center" colspan="5">Tidak Ada Data Kas</td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pesanan Belum Dibayar</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Order ID</th>
                                    <th class="d-none d-xl-table-cell">
                                        Jumlah Pesanan
                                    </th>
                                    <th class="d-none d-md-table-cell">
                                        Tanggal
                                    </th>
                                    <th class="d-none d-md-table-cell">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pesansBelum as $index => $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $index }}</td>
                                        <td class="d-none d-xl-table-cell">
                                            {{ $item->count() }}
                                            {{-- tes1 --}}
                                        </td>
                                        <td class="d-none d-xl-table-cell">
                                            {{ $item->first()->created_at_id() }}
                                            {{-- tes1 --}}
                                        </td>
                                        <td>
                                            <span
                                                class="badge text-white
                                            @switch($item->first()->status)
                        @case('pending')
                            bg-warning
                        @break

                        @case('success')
                           bg-success
                        @break

                        @case('diproses')
                            bg-primary
                        @break

                        @case('dikirim')
                            bg-info
                        @break

                        @case('cancel')
                            bg-danger
                        @break

                        @case('tolak')
                            bg-danger
                        @break
                    @endswitch
                    ">
                                                {{ $item->first()->status }}

                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <td class="text-center" colspan="5">Tidak Ada Data Kas</td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
