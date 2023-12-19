@extends('layouts.app_bsadmin2')
@section('content')
    <div class="card shadow bg-white mt-3">
        <div class="card-body">
            <div class="card-body">
                @if ($pesanans == null)
                    <h5 class="text-center my-5">
                        Order ID
                        @isset($_GET['order_id'])
                            <u><b> {{ $_GET['order_id'] }}</b></u>
                        @endisset

                        Data Tidak DiTemukan
                    </h5>
                @else
                    {{-- @dd($pesanans->count()); --}}

                    <h5>Order id : {{ $pesanans->first()->order_id }}</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="p-0" style="list-style: none">
                                <li>Pembeli : {{ ucwords($pesanans->first()->pembeli->name) }}</li>
                                <li>Tanggal : {{ $pesanans->first()->created_at->translatedFormat('H:i d-m-Y') }}</li>
                                <li>Status : {{ ucwords($pesanans->first()->status) }}</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="p-0" style="list-style: none">
                                <li>Alamat Lengkap :
                                    {{ $pesanans->first()->pembeli->alamat->alamat_users }}
                                </li>
                                <li>Provinsi : {{ provinsi($pesanans->first()->pembeli->alamat->provinsi) }}</li>
                                <li>kota : {{ distrik($pesanans->first()->pembeli->alamat->kota) }}</li>
                            </ul>
                        </div>
                    </div>
                    @if ($pesanansProduk->count() >= 1)
                        <h5>Pesanan Produk</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap" style="width: 20px">No</th>
                                        <th class="text-nowrap">Produk</th>
                                        <th class="text-nowrap">Harga</th>
                                        <th class="text-nowrap">Kuantitas</th>
                                        <th class="text-nowrap">Foto Pesanan</th>
                                        <th class="text-nowrap">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @dd($item); --}}
                                    {{-- @dd($pesanans) --}}
                                    @foreach ($pesanansProduk as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ number_format($item->harga) }}</td>
                                            <td>{{ $item->kuantitas }}</td>
                                            <td class="text-center">
                                                <a href="#" data-toggle="modal" data-target="#photoModal"
                                                    data-photo="{{ Storage::url($item->produk->foto) }}">
                                                    <img alt="{{ $item->produk->foto }}"
                                                        src="{{ Storage::url($item->produk->foto) }}" width="100"
                                                        class="img-fluid">
                                                </a>
                                            </td>

                                            <td>{{ number_format($item->total) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    @if ($pesanansStiker->count() >= 1)
                        <h5>Pesanan Stiker</h5>
                        <div class="table-responsive">
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
                                    {{-- @dd($pesanans) --}}

                                    @foreach ($pesanansStiker as $item)
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
                        </div>
                    @endif

                    @if ($pesanansSpanduk->count() >= 1)
                        <h5>Pesanan Spanduk</h5>
                        <div class="table-responsive">
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
                                    {{-- @dd($pesanans) --}}

                                    @foreach ($pesanansSpanduk as $item)
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
                        </div>
                    @endif

                    @if ($pesanansKartuNama->count() >= 1)
                        <h5>Pesanan Kartu Nama</h5>
                        <div class="table-responsive">
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
                                    {{-- @dd($pesanans) --}}

                                    @foreach ($pesanansSpanduk as $item)
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
                        </div>
                    @endif

                    @if ($pesanansBrosur->count() >= 1)
                        <h5>Pesanan Brosur</h5>
                        <div class="table-responsive">
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
                                    {{-- @dd($pesanans) --}}

                                    @foreach ($pesanansSpanduk as $item)
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
                        </div>
                    @endif


                    <div class="d-flex justify-content-end mt-3">
                        <h4>Sub Total : Rp {{ number_format($subtotal) }}</h4>
                    </div>
                    <div class="d-flex justify-content-end mt-3 gap-3">
                        @switch($pesanans->first()->status)
                            @case('pending')
                                <div class="text-right">
                                    <button class="btn btn-danger m-1"
                                        onclick="tolak_pesanan('{{ route('pesanan.tolak', ['order_id' => $pesanans->first()->order_id]) }}')">Batal
                                        Pesan</button>
                                    <button class="btn btn-success m-1" id="pay-button">Bayar</button>
                                    <br>


                                    <h4 class="text-warning">Pembeli Belum
                                        Melakukan
                                        Pembayaran !</h4>
                                </div>
                            @break

                            @case('success')
                                {{-- <button class="btn btn-danger mr-2"
                                onclick="tolak_pesanan('{{ route('pesanan.tolak', ['order_id' => $item->order_id]) }}')">Tolak</button> --}}
                                {{-- <button class="btn btn-success"
                                onclick="pesanan_diterima('{{ route('pesanan.terima', ['order_id' => $item->order_id]) }}')">Pesanan
                                Terima</button> --}}
                                <h4 class="text-info">Pesanan Sedang Di Proses</h4>
                            @break

                            @case('diproses')
                                <h4 class="text-success">Pesanan Sedang Melakukan Pengiriman</h4>
                            @break

                            @case('dikirim')
                                <div>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" id="kirim_btn"
                                        data-bs-target="#kirim_terima">Pesanan Terima</button>
                                    {{-- <button class="btn btn-success"
                                        onclick="pesanan_diterima('{{ route('pesanan.terima', ['order_id' => $item->order_id]) }}')">Pesanan
                                        Terima</button> --}}
                                    <h4 class="text-success">Pesanan Dikirim !</h4>
                                    <h5>NO Resi : {{ $pesanans->first()->dikirim()->resi }}</h5>
                                    <h5>Expedisi : {{ ucfirst($pesanans->first()->dikirim()->expedisi) }}</h5>
                                </div>
                            @break

                            @case('diterima')
                                <h4 class="text-succes">Terimakasih Pembelian Layanan Kami</h4>
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
    <div class="modal fade" id="kirim_terima" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Pesanan Diterima</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('pesanan.diterima') }}" enctype='multipart/form-data'>
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $pesanans->first()->order_id }}">
                        <input type="hidden" name="pesanan_id" value="{{ $pesanans->first()->id }}">
                        <div class="mb-3">
                            <label for="foto" class="form-label">Bukti Diterima</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                name="foto">
                            @error('foto')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Kirim Bukti</button>
                    </form>
                </div>


                {{-- modal foto --}}
                <!-- Add this to your HTML -->


                {{-- akhir modal foto --}}
            </div>
        </div>
    </div>

    <div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="photoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="photoModalLabel">Photo Pesanan</h5>
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
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $pesanans->first()->tranksaksi()->snap_token }}', {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    window.location.reload();
                    alert("payment success!");
                    console.log(result);
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('Pembayaran Belum Dilakukan');
                }
            })
        });
        // tampilkan modal foto

        // akhir modal foto
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
        function pesanan_diterima(terima_url) {
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
