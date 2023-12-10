@extends('layouts.app_bsadmin2')

@push('js')
    <script>
        var options = {
            series: [{
                name: "Total Transaksi Berhasil",
                data: @json($dataTotalBulan)
            }],
            chart: {
                height: 280,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Data Total Transaksi Berhasil Perbulan',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: @json($dataBulan),
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value.toLocaleString("id-ID", {
                            style: "currency",
                            currency: "IDR"
                        });
                    }
                }
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>

    {{-- <script src="{{ $chart->cdn() }}"></script> --}}
    {{-- {{ $chart->script() }} --}}
@endpush

@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-4 col-xxl-5 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card border-left-primary shadow  mb-3">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Pendapatan Bulan ini</div>
                                        <div class="h3 mb-0 font-weight-bold text-gray-800">
                                            {{-- @dd($dataTotalBulan) --}}
                                            {{ format_rupiah(end($dataTotalBulan), true) }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card border-left-success shadow  mb-3">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Pendapatan Hari ini</div>
                                        <div class="h3 mb-0 font-weight-bold text-gray-800">
                                            {{ format_rupiah($pendapatanHariIni, true) }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-8 col-xxl-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Easdasdas</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div id="chart"></div>
                    {{-- <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>



    <!-- Content Row -->

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pesanan Terakhir</h6>
                </div>
                <div class="card-body">
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Order ID</th>
                                <th class="d-none d-xl-table-cell">
                                    Pembeli
                                </th>
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
                            @forelse ($pesans as $index => $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $index }}</td>
                                    <td class="d-none d-xl-table-cell">
                                        {{ $item->first()->pembeli->name }}
                                    </td>
                                    <td class="d-none d-xl-table-cell">
                                        {{ $item->count() }}
                                    </td>
                                    <td class="d-none d-xl-table-cell">
                                        {{ $item->first()->created_at_id() }}
                                    </td>
                                    <td>
                                        <span
                                            class="badge text-white @switch($item->first()->status)
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
                    @endswitch">{{ $item->first()->status }}</span>
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

    <!-- Content Row -->
@endsection
