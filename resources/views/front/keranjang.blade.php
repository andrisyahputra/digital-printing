@extends('layouts.app_onlineshop')

@section('content')
    <section class="page-keranjang">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="index.php">Beranda</a></li>
                <li>Keranjang Belanja</li>
            </ul>

            <div class="card box">
                <div class="card-body">
                    <h2>Keranjang Belanja</h2>
                    {{-- <php if (empty($_SESSION['keranjang_belanja'])) : ?>
                    <p>Anda memiliki (0) items didalam keranjang belanja</p>
                    <php else : ?>
                    <php
                    $item = 0;
                    foreach ($_SESSION['keranjang_belanja'] as $id_produk => $jumlah) {
                        $item++;
                    }
                    ?> --}}
                    <p>Anda memiliki ({{ $kerajangs->count() }}) items didalam keranjang belanja</p>
                    {{-- <php endif; ?> --}}

                </div>
            </div>
            @php
                $total = 0;
            @endphp

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        @if ($kerajangsProduk->count() >= 1)
                            <h5>Keranjang Produk</h5>
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Produk</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <php
                                $nomor = 1;
                                foreach ($_SESSION['keranjang_belanja'] as $id_produk => $jumlah) :
                                    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                                    $pecah = $ambil->fetch_assoc();
                                    $subtotal = $pecah['harga_produk'] * $jumlah;
                                ?> --}}

                                    @foreach ($kerajangsProduk as $item)
                                        @php
                                            if ($item->kategori_id == '1' || $item->kategori_id == '2') {
                                                //stiker
                                                //                 var luas = parseFloat(panjang) * parseFloat(lebar);
                                                // var total = luas * jumlah * harga;
                                                $luas = floatval($item->panjang) * floatval($item->lebar);
                                                $totalSekarang = $luas * $item->produk->harga * $item->kuantitas;
                                                $total += $totalSekarang;
                                                // } elseif ($item->kategori_id == '2') {
                                                // } elseif ($item->kategori_id == '3') {
                                                // } elseif ($item->kategori_id == '4') {
                                            } else {
                                                $total += $item->produk->harga * $item->kuantitas;
                                            }
                                        @endphp
                                        <tr class="">
                                            <td width="25px">{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ Storage::url($item->produk->foto) }}"
                                                    alt="{{ $item->produk->foto }}" width="50">
                                            </td>
                                            <td>{{ $item->produk->nama }}</td>
                                            <td>{{ $item->kuantitas }}x</td>
                                            <td>Rp {{ number_format($item->produk->harga) }}</td>
                                            <td>Rp
                                                {{ number_format($item->produk->harga * $item->kuantitas) }}</td>
                                            <td>
                                                <form action="{{ route('keranjang.destroy', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>
                                                        Hapus</button>
                                                </form>

                                            </td>
                                        </tr>
                                        {{-- <php endforeach; ?> --}}
                                    @endforeach

                                </tbody>
                            </table>
                        @endif

                        @if ($kerajangsStiker->count() >= 1)
                            <h5>Keranjang Stiker</h5>
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Produk</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Panjang</th>
                                        <th scope="col">Lebar</th>
                                        <th scope="col">Foto Pesanan</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <php
                                $nomor = 1;
                                foreach ($_SESSION['keranjang_belanja'] as $id_produk => $jumlah) :
                                    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                                    $pecah = $ambil->fetch_assoc();
                                    $subtotal = $pecah['harga_produk'] * $jumlah;
                                ?> --}}

                                    @foreach ($kerajangsStiker as $item)
                                        @php
                                            if ($item->kategori_id == '1' || $item->kategori_id == '2') {
                                                //stiker
                                                //                 var luas = parseFloat(panjang) * parseFloat(lebar);
                                                // var total = luas * jumlah * harga;
                                                $luas = floatval($item->panjang) * floatval($item->lebar);
                                                $totalSekarang = $luas * $item->produk->harga * $item->kuantitas;
                                                $total += $totalSekarang;
                                                // } elseif ($item->kategori_id == '2') {
                                                // } elseif ($item->kategori_id == '3') {
                                                // } elseif ($item->kategori_id == '4') {
                                            } else {
                                                $total += $item->produk->harga * $item->kuantitas;
                                            }
                                        @endphp
                                        <tr class="">
                                            <td width="25px">{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ Storage::url($item->produk->foto) }}"
                                                    alt="{{ $item->produk->foto }}" width="50">
                                            </td>
                                            <td>{{ $item->produk->nama }}</td>
                                            <td>{{ $item->kuantitas }}x</td>
                                            <td>{{ $item->keterangan }}</td>
                                            <td>{{ $item->panjang }} Meter</td>
                                            <td>{{ $item->lebar }} Meter</td>
                                            <td>
                                                @if ($item->foto != null)
                                                    <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->foto }}"
                                                        width="50">
                                                @else
                                                    Foto dari Digital Printing
                                                @endif
                                            </td>
                                            <td>Rp {{ number_format($item->produk->harga) }}</td>
                                            <td>Rp
                                                {{ number_format($totalSekarang) }}</td>
                                            <td>
                                                <form action="{{ route('keranjang.destroy', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>
                                                        Hapus</button>
                                                </form>

                                            </td>
                                        </tr>
                                        {{-- <php endforeach; ?> --}}
                                    @endforeach

                                </tbody>
                            </table>
                        @endif
                        @if ($kerajangsKartuNama->count() >= 1)
                            <h5>Keranjang Kartu Nama</h5>
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Produk</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Foto Pesanan</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <php
                                $nomor = 1;
                                foreach ($_SESSION['keranjang_belanja'] as $id_produk => $jumlah) :
                                    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                                    $pecah = $ambil->fetch_assoc();
                                    $subtotal = $pecah['harga_produk'] * $jumlah;
                                ?> --}}

                                    @foreach ($kerajangsKartuNama as $item)
                                        @php
                                            if ($item->kategori_id == '1' || $item->kategori_id == '2') {
                                                //stiker
                                                //                 var luas = parseFloat(panjang) * parseFloat(lebar);
                                                // var total = luas * jumlah * harga;
                                                $luas = floatval($item->panjang) * floatval($item->lebar);
                                                $totalSekarang = $luas * $item->produk->harga * $item->kuantitas;
                                                $total += $totalSekarang;
                                                // } elseif ($item->kategori_id == '2') {
                                                // } elseif ($item->kategori_id == '3') {
                                                // } elseif ($item->kategori_id == '4') {
                                            } else {
                                                $total += $item->produk->harga * $item->kuantitas;
                                            }
                                        @endphp
                                        <tr class="">
                                            <td width="25px">{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ Storage::url($item->produk->foto) }}"
                                                    alt="{{ $item->produk->foto }}" width="50">
                                            </td>
                                            <td>{{ $item->produk->nama }}</td>
                                            <td>{{ $item->kuantitas }} perkotak</td>
                                            <td>{{ $item->keterangan }}</td>
                                            <td>
                                                @if ($item->foto != null)
                                                    <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->foto }}"
                                                        width="50">
                                                @else
                                                    Foto dari Digital Printing
                                                @endif
                                            </td>
                                            <td>Rp {{ number_format($item->produk->harga) }}</td>
                                            <td>Rp
                                                {{ number_format($item->produk->harga * $item->kuantitas) }}</td>
                                            <td>
                                                <form action="{{ route('keranjang.destroy', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>
                                                        Hapus</button>
                                                </form>

                                            </td>
                                        </tr>
                                        {{-- <php endforeach; ?> --}}
                                    @endforeach

                                </tbody>
                            </table>
                        @endif

                        @if ($kerajangsSpanduk->count() >= 1)
                            <h5>Keranjang Spaduk</h5>
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Produk</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Panjang</th>
                                        <th scope="col">Lebar</th>
                                        <th scope="col">Foto Pesanan</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <php
                                $nomor = 1;
                                foreach ($_SESSION['keranjang_belanja'] as $id_produk => $jumlah) :
                                    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                                    $pecah = $ambil->fetch_assoc();
                                    $subtotal = $pecah['harga_produk'] * $jumlah;
                                ?> --}}

                                    @foreach ($kerajangsSpanduk as $item)
                                        @php
                                            if ($item->kategori_id == '1' || $item->kategori_id == '2') {
                                                //stiker
                                                //                 var luas = parseFloat(panjang) * parseFloat(lebar);
                                                // var total = luas * jumlah * harga;
                                                $luas = floatval($item->panjang) * floatval($item->lebar);
                                                $totalSekarang = $luas * $item->produk->harga * $item->kuantitas;
                                                $total += $totalSekarang;
                                                // } elseif ($item->kategori_id == '2') {
                                                // } elseif ($item->kategori_id == '3') {
                                                // } elseif ($item->kategori_id == '4') {
                                            } else {
                                                $total += $item->produk->harga * $item->kuantitas;
                                            }
                                        @endphp
                                        <tr class="">
                                            <td width="25px">{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ Storage::url($item->produk->foto) }}"
                                                    alt="{{ $item->produk->foto }}" width="50">
                                            </td>
                                            <td>{{ $item->produk->nama }}</td>
                                            <td>{{ $item->kuantitas }}x</td>
                                            <td>{{ $item->keterangan }}</td>
                                            <td>{{ $item->panjang }} Meter</td>
                                            <td>{{ $item->lebar }} Meter</td>
                                            <td>
                                                @if ($item->foto != null)
                                                    <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->foto }}"
                                                        width="50">
                                                @else
                                                    Foto dari Digital Printing
                                                @endif
                                            </td>
                                            <td>Rp {{ number_format($item->produk->harga) }}</td>
                                            <td>Rp
                                                {{ number_format($totalSekarang) }}</td>
                                            <td>
                                                <form action="{{ route('keranjang.destroy', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>
                                                        Hapus</button>
                                                </form>

                                            </td>
                                        </tr>
                                        {{-- <php endforeach; ?> --}}
                                    @endforeach

                                </tbody>
                            </table>
                        @endif

                        @if ($kerajangsBrosur->count() >= 1)
                            <h5>Keranjang Brosur</h5>
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Produk</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Jenis Kertas</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Foto Pesanan</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <php
                                $nomor = 1;
                                foreach ($_SESSION['keranjang_belanja'] as $id_produk => $jumlah) :
                                    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                                    $pecah = $ambil->fetch_assoc();
                                    $subtotal = $pecah['harga_produk'] * $jumlah;
                                ?> --}}
                                    @foreach ($kerajangsBrosur as $item)
                                        @php
                                            if ($item->kategori_id == '1' || $item->kategori_id == '2') {
                                                //stiker
                                                //                 var luas = parseFloat(panjang) * parseFloat(lebar);
                                                // var total = luas * jumlah * harga;
                                                $luas = floatval($item->panjang) * floatval($item->lebar);
                                                $totalSekarang = $luas * $item->produk->harga * $item->kuantitas;
                                                $total += $totalSekarang;
                                                // } elseif ($item->kategori_id == '2') {
                                                // } elseif ($item->kategori_id == '3') {
                                                // } elseif ($item->kategori_id == '4') {
                                            } else {
                                                $total += $item->produk->harga * $item->kuantitas;
                                            }
                                        @endphp
                                        <tr class="">
                                            <td width="25px">{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ Storage::url($item->produk->foto) }}"
                                                    alt="{{ $item->produk->foto }}" width="50">
                                            </td>
                                            <td>{{ $item->produk->nama }}</td>
                                            <td>{{ $item->kuantitas }} Per Rim</td>
                                            <td>{{ $item->kertas }}</td>
                                            <td>{{ $item->keterangan }}</td>
                                            <td>
                                                @if ($itemfoto != null)
                                                    <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->foto }}"
                                                        width="50">
                                                @else
                                                    Foto dari Digital Printing
                                                @endif
                                            </td>
                                            <td>Rp {{ number_format($item->produk->harga) }}</td>
                                            <td>Rp
                                                {{ number_format($item->produk->harga * $item->kuantitas) }}</td>
                                            <td>
                                                <form action="{{ route('keranjang.destroy', $item->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>
                                                        Hapus</button>
                                                </form>

                                            </td>
                                        </tr>
                                        {{-- <php endforeach; ?> --}}
                                    @endforeach

                                </tbody>
                            </table>
                        @endif
                    </div>
                    {{-- <div class="text-end"> --}}
                    <h4>Total Keseluruhan Rp {{ number_format($total) }}</h4>
                    {{-- </div> --}}
                </div>
                <div class="card-header">

                    <div class="row">
                        <div class="col-md-10">
                            <a href="produk.php" class="btn btn-info btn-sm">Kembali Belanja</a>
                        </div>
                        <div class="col-md-2 text-right">
                            <a onclick="modal('#rajaongkir')" class="btn btn-success btn-sm">Checkout</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
