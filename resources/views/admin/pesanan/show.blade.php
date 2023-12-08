@extends('layouts.app_bsadmin2')
@section('content')
    <div class="card shadow bg-white mt-3">
        <div class="card-body">
            <div class="card-body">
                <h5>Order id : {{ $pesanans->first()->order_id }}</h5>
                <ul class="p-0" style="list-style: none">
                    <li>Pembeli : {{ ucwords($pesanans->first()->pembeli->name) }}</li>
                    <li>Alamat : {{ $pesanans->first()->pembeli->alamat }}</li>
                    <li>Tanggal : {{ $pesanans->first()->created_at->translatedFormat('H:i d-m-Y') }}</li>
                    <li>Status : {{ ucwords($pesanans->first()->status) }}</li>
                </ul>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-nowrap" style="width: 20px">No</th>
                                <th class="text-nowrap">Produk</th>
                                <th class="text-nowrap">Harga</th>
                                <th class="text-nowrap">Kuantitas</th>
                                <th class="text-nowrap">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @dd($pesanans) --}}
                            @foreach ($pesanans as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ number_format($item->harga) }}</td>
                                    <td>{{ $item->kuantitas }}</td>
                                    <td>{{ number_format($item->total) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <h4>Sub Total : Rp {{ number_format($subtotal) }}</h4>
                </div>
                <div class="d-flex justify-content-end mt-3 gap-3">
                    @switch($item->status)
                        @case('pending')
                            <div class="text-right">
                                <button class="btn btn-danger "
                                    onclick="tolak_pesanan('{{ route('pesanan.tolak', ['order_id' => $item->order_id]) }}')">Tolak</button>
                                <br>
                                <h4 class="text-warning">Pembeli Belum Melakukan Pembayaran !</h4>
                            </div>
                        @break

                        @case('success')
                            <button class="btn btn-danger mr-2"
                                onclick="tolak_pesanan('{{ route('pesanan.tolak', ['order_id' => $item->order_id]) }}')">Tolak</button>
                            <button class="btn btn-primary"
                                onclick="terima_pesanan('{{ route('pesanan.terima', ['order_id' => $item->order_id]) }}')">Terima</button>
                        @break

                        @case('diproses')
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" id="kirim_btn"
                                data-bs-target="#kirim_modal">Kirim</button>
                        @break

                        @case('dikirim')
                            <div>
                                <h4 class="text-success">Pesanan Dikirim !</h4>
                                <h5>NO Resi : {{ $pesanans->first()->dikirim()->resi }}</h5>
                                <h5>Expedisi : {{ ucfirst($pesanans->first()->dikirim()->expedisi) }}</h5>
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
                        <input type="hidden" name="order_id" value="{{ $pesanans->first()->order_id }}">
                        <div class="mb-3">
                            <label for="resi" class="form-label">Nomor Resi</label>
                            <input type="text" class="form-control @error('resi') is-invalid @enderror"
                                value="{{ old('resi') }}" name="resi" placeholder="Masukan no Resi">
                            @error('resi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="expedisi" class="form-label">Expedisi</label>
                            <select class="form-control  @error('expedisi') is-invalid @enderror" name="expedisi"
                                id="expedisi">
                                <option value="jnt" {{ old('expedisi') == 'jnt' ? 'selected' : '' }}>JNT</option>
                                <option value="sicepat" {{ old('expedisi') == 'sicepat' ? 'selected' : '' }}>Sicepat
                                </option>
                                <option value="pos" {{ old('expedisi') == 'pos' ? 'selected' : '' }}>POS</option>
                                <option value="jne" {{ old('expedisi') == 'jne' ? 'selected' : '' }}>JNE</option>
                            </select>
                            @error('expedisi')
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
@endsection

@push('js')
    <script>
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
