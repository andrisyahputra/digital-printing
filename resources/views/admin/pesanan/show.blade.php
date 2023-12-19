@extends('layouts.app_bsadmin2')
@section('content')
    <div class="card shadow bg-white mt-3">
        <div class="card-body">
            <div class="card-body">
                @if ($pesans == null)
                    <h5 class="text-center my-5">
                        Order ID
                        @isset($_GET['order_id'])
                            <u><b> {{ $_GET['order_id'] }}</b></u>
                        @endisset

                        Data Tidak DiTemukan
                    </h5>
                @else
                    <h5>Order id : {{ $pesans->first()->order_id }}</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="p-0" style="list-style: none">
                                <li>Pembeli : {{ ucwords($pesans->first()->pembeli->name) }}</li>

                                <li>Tanggal : {{ $pesans->first()->created_at->translatedFormat('H:i d-m-Y') }}</li>
                                <li>Status : {{ ucwords($pesans->first()->status) }}</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="p-0" style="list-style: none">
                                <li>Alamat Lengkap :
                                    {{ $pesans->first()->pembeli->alamat->alamat_users }}
                                </li>
                                <li>Provinsi : {{ provinsi($pesans->first()->pembeli->alamat->provinsi) }}</li>
                                <li>kota : {{ distrik($pesans->first()->pembeli->alamat->kota) }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="table-responsive">
                        @php
                            $totalBerat = 0;
                        @endphp
                        @if ($pesansProduk->count() >= 1)
                            <h5>Pesanan Produk</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap" style="width: 20px">No</th>
                                        <th class="text-nowrap">Produk</th>
                                        <th class="text-nowrap">Harga</th>
                                        <th class="text-nowrap">Kuantitas</th>
                                        <th class="text-nowrap">Berat Produk</th>
                                        <th class="text-nowrap">Total</th>
                                        <th class="text-nowrap">Foto Produk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @dd($pesans) --}}

                                    @foreach ($pesansProduk as $item)
                                        @php
                                            $totalBerat += floatval($item->panjang) * floatval($item->lebar) * $item->kuantitas * $item->produk->weight;
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ number_format($item->harga) }}</td>
                                            <td>{{ $item->kuantitas }}</td>
                                            <td>{{ floatval($item->panjang) * floatval($item->lebar) * $item->kuantitas * $item->produk->weight }}
                                            </td>
                                            <td>{{ number_format($item->total) }}</td>
                                            <td class="text-center">
                                                <a href="#" data-toggle="modal" data-target="#photoModal"
                                                    data-photo="{{ Storage::url($item->produk->foto) }}">
                                                    <img alt="{{ $item->produk->foto }}"
                                                        src="{{ Storage::url($item->produk->foto) }}" width="100"
                                                        class="img-fluid">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        @if ($pesansStiker->count() >= 1)
                            <h5>Pesanan Stiker</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap" style="width: 20px">No</th>
                                        <th class="text-nowrap">Produk</th>
                                        <th class="text-nowrap">Harga</th>
                                        <th class="text-nowrap">Kuantitas</th>
                                        <th class="text-nowrap">Keterangan</th>
                                        <th class="text-nowrap">Panjang</th>
                                        <th class="text-nowrap">Lebar</th>
                                        <th class="text-nowrap">Foto Pesanan</th>
                                        <th class="text-nowrap">Berat Produk</th>
                                        <th class="text-nowrap">Total</th>
                                        <th class="text-nowrap">Foto Produk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @dd($pesans) --}}

                                    @foreach ($pesansStiker as $item)
                                        @php
                                            $totalBerat += floatval($item->panjang) * floatval($item->lebar) * $item->kuantitas * $item->produk->weight;
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ number_format($item->harga) }}</td>
                                            <td>{{ $item->kuantitas }}</td>
                                            <td>{{ $item->keterangan }}</td>
                                            <td>{{ $item->panjang }} Meter</td>
                                            <td>{{ $item->lebar }} Meter</td>
                                            <td>
                                                {{-- @dd($item->foto_pesanans) --}}
                                                @foreach ($item->foto_pesanans as $itemFoto)
                                                    <a href="#" class="m-1" data-toggle="modal"
                                                        data-target="#photoModal"
                                                        data-photo="{{ Storage::url($itemFoto->foto) }}">
                                                        <img alt="{{ $itemFoto->foto }}"
                                                            src="{{ Storage::url($itemFoto->foto) }}" width="100"
                                                            class="img-fluid">
                                                    </a>
                                                @endforeach
                                            </td>
                                            <td>{{ floatval($item->panjang) * floatval($item->lebar) * $item->kuantitas * $item->produk->weight }}
                                            </td>
                                            <td>{{ number_format($item->total) }}</td>
                                            <td class="text-center">
                                                <a href="#" data-toggle="modal" data-target="#photoModal"
                                                    data-photo="{{ Storage::url($item->produk->foto) }}">
                                                    <img alt="{{ $item->produk->foto }}"
                                                        src="{{ Storage::url($item->produk->foto) }}" width="100"
                                                        class="img-fluid">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        @if ($pesansSpanduk->count() >= 1)
                            <h5>Pesanan Spanduk</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap" style="width: 20px">No</th>
                                        <th class="text-nowrap">Produk</th>
                                        <th class="text-nowrap">Harga</th>
                                        <th class="text-nowrap">Kuantitas</th>
                                        <th class="text-nowrap">Keterangan</th>
                                        <th class="text-nowrap">Panjang</th>
                                        <th class="text-nowrap">Lebar</th>
                                        <th class="text-nowrap">Foto Pesanan</th>
                                        <th class="text-nowrap">Berat Produk</th>
                                        <th class="text-nowrap">Total</th>
                                        <th class="text-nowrap">Foto Produk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @dd($pesans) --}}

                                    @foreach ($pesansSpanduk as $item)
                                        @php
                                            $totalBerat += floatval($item->panjang) * floatval($item->lebar) * $item->kuantitas * $item->produk->weight;
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ number_format($item->harga) }}</td>
                                            <td>{{ $item->kuantitas }}</td>
                                            <td>{{ $item->keterangan }}</td>
                                            <td>{{ $item->panjang }} Meter</td>
                                            <td>{{ $item->lebar }} Meter</td>
                                            <td>
                                                {{-- @dd($item->foto_pesanans) --}}
                                                @foreach ($item->foto_pesanans as $itemFoto)
                                                    <a href="#" class="m-1" data-toggle="modal"
                                                        data-target="#photoModal"
                                                        data-photo="{{ Storage::url($itemFoto->foto) }}">
                                                        <img alt="{{ $itemFoto->foto }}"
                                                            src="{{ Storage::url($itemFoto->foto) }}" width="100"
                                                            class="img-fluid">
                                                    </a>
                                                @endforeach
                                            </td>
                                            <td>{{ floatval($item->panjang) * floatval($item->lebar) * $item->kuantitas * $item->produk->weight }}
                                            </td>
                                            <td>{{ number_format($item->total) }}</td>
                                            <td class="text-center">
                                                <a href="#" data-toggle="modal" data-target="#photoModal"
                                                    data-photo="{{ Storage::url($item->produk->foto) }}">
                                                    <img alt="{{ $item->produk->foto }}"
                                                        src="{{ Storage::url($item->produk->foto) }}" width="100"
                                                        class="img-fluid">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        @if ($pesansKartuNama->count() >= 1)
                            <h5>Pesanan Kartu Nama</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap" style="width: 20px">No</th>
                                        <th class="text-nowrap">Produk</th>
                                        <th class="text-nowrap">Harga</th>
                                        <th class="text-nowrap">Kuantitas</th>
                                        <th class="text-nowrap">Keterangan</th>
                                        <th class="text-nowrap">Foto Pesanan</th>
                                        <th class="text-nowrap">Berat Produk</th>
                                        <th class="text-nowrap">Total</th>
                                        <th class="text-nowrap">Foto Produk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @dd($pesans) --}}

                                    @foreach ($pesansSpanduk as $item)
                                        @php
                                            $totalBerat += floatval($item->panjang) * floatval($item->lebar) * $item->kuantitas * $item->produk->weight;
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ number_format($item->harga) }}</td>
                                            <td>{{ $item->kuantitas }} Kotak</td>
                                            <td>{{ $item->keterangan }}</td>
                                            <td>
                                                {{-- @dd($item->foto_pesanans) --}}
                                                @foreach ($item->foto_pesanans as $itemFoto)
                                                    <a href="#" class="m-1" data-toggle="modal"
                                                        data-target="#photoModal"
                                                        data-photo="{{ Storage::url($itemFoto->foto) }}">
                                                        <img alt="{{ $itemFoto->foto }}"
                                                            src="{{ Storage::url($itemFoto->foto) }}" width="100"
                                                            class="img-fluid">
                                                    </a>
                                                @endforeach
                                            </td>
                                            <td>{{ floatval($item->panjang) * floatval($item->lebar) * $item->kuantitas * $item->produk->weight }}
                                            </td>
                                            <td>{{ number_format($item->total) }}</td>
                                            <td class="text-center">
                                                <a href="#" data-toggle="modal" data-target="#photoModal"
                                                    data-photo="{{ Storage::url($item->produk->foto) }}">
                                                    <img alt="{{ $item->produk->foto }}"
                                                        src="{{ Storage::url($item->produk->foto) }}" width="100"
                                                        class="img-fluid">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        @if ($pesansBrosur->count() >= 1)
                            <h5>Pesanan Brosur</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap" style="width: 20px">No</th>
                                        <th class="text-nowrap">Produk</th>
                                        <th class="text-nowrap">Harga</th>
                                        <th class="text-nowrap">Kuantitas</th>
                                        <th class="text-nowrap">Kertas</th>
                                        <th class="text-nowrap">Keterangan</th>
                                        <th class="text-nowrap">Foto Pesanan</th>
                                        <th class="text-nowrap">Berat Produk</th>
                                        <th class="text-nowrap">Total</th>
                                        <th class="text-nowrap">Foto Produk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @dd($pesans) --}}

                                    @foreach ($pesansSpanduk as $item)
                                        @php
                                            $totalBerat += floatval($item->panjang) * floatval($item->lebar) * $item->kuantitas * $item->produk->weight;
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ number_format($item->harga) }}</td>
                                            <td>{{ $item->kuantitas }} Per Rim</td>
                                            <td>{{ $item->kertas }}</td>
                                            <td>{{ $item->keterangan }}</td>
                                            <td>
                                                {{-- @dd($item->foto_pesanans) --}}
                                                @foreach ($item->foto_pesanans as $itemFoto)
                                                    <a href="#" class="m-1" data-toggle="modal"
                                                        data-target="#photoModal"
                                                        data-photo="{{ Storage::url($itemFoto->foto) }}">
                                                        <img alt="{{ $itemFoto->foto }}"
                                                            src="{{ Storage::url($itemFoto->foto) }}" width="100"
                                                            class="img-fluid">
                                                    </a>
                                                @endforeach
                                            </td>
                                            <td>{{ floatval($item->panjang) * floatval($item->lebar) * $item->kuantitas * $item->produk->weight }}
                                            </td>
                                            <td>{{ number_format($item->total) }}</td>
                                            <td class="text-center">
                                                <a href="#" data-toggle="modal" data-target="#photoModal"
                                                    data-photo="{{ Storage::url($item->produk->foto) }}">
                                                    <img alt="{{ $item->produk->foto }}"
                                                        src="{{ Storage::url($item->produk->foto) }}" width="100"
                                                        class="img-fluid">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        {{-- <h4>Sub Berat {{ $totalBerat }}</h4> --}}
                        <h4>Sub Total : Rp {{ number_format($subtotal) }}</h4>
                    </div>
                    <div class="d-flex justify-content-end mt-3 gap-3">
                        @switch($pesans->first()->status)
                            @case('pending')
                                <div class="text-right">
                                    <button class="btn btn-danger m-1"
                                        onclick="tolak_pesanan('{{ route('pesanan.tolak', ['order_id' => $pesans->first()->order_id]) }}')">Tolak</button>
                                    <button class="btn btn-success m-1" id="pay-button">Bayar</button>
                                    <br>

                                    {{-- @dd($pesans->first()->tranksaksi()->token_payment) --}}
                                    <h4 class="text-warning">Pembeli Belum Melakukan Pembayaran !</h4>
                                </div>
                            @break

                            @case('success')
                                <button class="btn btn-danger mr-2"
                                    onclick="tolak_pesanan('{{ route('pesanan.tolak', ['order_id' => $pesans->first()->order_id]) }}')">Tolak</button>
                                <button class="btn btn-primary"
                                    onclick="terima_pesanan('{{ route('pesanan.terima', ['order_id' => $pesans->first()->order_id]) }}')">Terima</button>
                            @break

                            @case('diproses')
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" id="kirim_btn"
                                    data-bs-target="#kirim_modal">Kirim</button>
                            @break

                            @case('dikirim')
                                <div>
                                    <h4 class="text-success">Pesanan Dikirim !</h4>
                                    <h5>NO Resi : {{ $pesans->first()->dikirim()->resi }}</h5>
                                    <h5>Expedisi : {{ ucfirst($pesans->first()->dikirim()->expedisi) }}</h5>
                                    <h5>Paket Dikirim : {{ ucwords($pesans->first()->dikirim()->paket) }}</h5>
                                </div>
                            @break

                            @case('diterima')
                                <div>
                                    <h4 class="text-success text-center">Bukti Pembelian </h4>
                                    <br>
                                    <a href="#" data-toggle="modal" data-target="#photoModal"
                                        data-photo="{{ Storage::url($pesans->first()->diterima()->foto) }}">
                                        <img alt="{{ $pesans->first()->diterima()->foto }}"
                                            src="{{ Storage::url($pesans->first()->diterima()->foto) }}" width="300"
                                            class="img-fluid">
                                    </a>
                                </div>
                            @break

                            @case('cancel')
                                <h4 class="text-danger">Pesanan di Cancel karena produk di tolak!</h4>
                            @break

                            @case('tolak')
                                <h4 class="text-danger">Pesanan Ditolak Uang Akan Di kembalikan!</h4>
                            @break
                        @endswitch

                    </div>
            </div>
        </div>
    </div>

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="kirim_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Kirim Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('pesanan-dikirim.store') }}">
                        @csrf
                        {{-- <input type="hidden" id="total_berat" value="{{ $totalBerat }}"> --}}
                        <input type="hidden" id="total_berat" value="{{ $totalBerat }}">
                        <input type="hidden" id="iddistrik" value="{{ $pesans->first()->pembeli->alamat->kota }}">
                        <input type="hidden" name="order_id" value="{{ $pesans->first()->order_id }}">
                        <div class="mb-3">
                            <label for="resi" class="form-label">Nomor Resi</label>
                            <input type="text" class="form-control @error('resi') is-invalid @enderror"
                                value="{{ old('resi') }}" name="resi" placeholder="Masukan no Resi">
                            @error('resi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <hr>
                        <h5>Dari Barang YG Dikirim</h5>
                        {{-- <div class="mb-3">
                            <label for="provinsi" class="form-label">Provinsi</label>

                            <div id="dataProvinsiUrl" data-url="{{ route('data.provinsi') }}"></div>
                            <select name="provinsi" id="provinsi" class="form-control" required>
                            </select>
                            @error('provinsi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="distrik" class="form-label">distrik</label>

                            <div id="dataDistrikUrl" data-url="{{ route('data.distrik') }}"></div>
                            <select name="distrik" id="distrik" class="form-control" required>
                            </select>
                            @error('distrik')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div> --}}
                        <hr>
                        <div class="mb-3">
                            <label for="expedisi" class="form-label">Expedisi</label>

                            <div id="dataEkspedisiUrl" data-url="{{ route('data.ekspedisi') }}"></div>
                            <select name="expedisi" id="ekspedisi" class="form-control" required>
                            </select>
                            @error('expedisi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="paket" class="form-label">Paket</label>
                            <div id="dataPaketUrl" data-url="{{ route('data.paket') }}"></div>
                            <select name="paket" id="paket" class="form-control" required>
                            </select>
                            @error('paket')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Kirim Pesanan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="photoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="photoModalLabel">Photo Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="modalPhoto" src="" alt="Modal Photo" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#photoModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var photoUrl = button.data('photo');
                var modal = $(this);
                modal.find('#modalPhoto').attr('src', photoUrl);
            });
        });





        function tolak_pesanan(tolak_url) {
            Swal.fire({
                title: 'Pesanan?',
                text: "Yakin ingin menolak...?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya',
                cencelButtonText: 'batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // $(form_id).submit()
                    window.location.href = tolak_url
                }
            })
        }
        // function tolak_pesanan(tolak_url) {
        //     var pesan = confirm('Yakin ingin menolak...?')
        //     if (pesan) {
        //         window.location.href = tolak_url
        //     }
        // }
        function terima_pesanan(terima_url) {
            Swal.fire({
                title: 'Pesanan?',
                text: "Yakin ingin Menerima Pesanan ini...?",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya',
                cencelButtonText: 'batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // $(form_id).submit()
                    window.location.href = terima_url
                }
            })
        }

        // function terima_pesanan(terima_url) {
        //     var pesan = confirm('Yakin ingin Menerima Pesanan ini...?')
        //     if (pesan) {
        //         window.location.href = terima_url
        //     }
        // }
    </script>
    @error('resi')
        <script>
            $('#kirim_btn').trigger('click')
        </script>
    @enderror
@endpush
