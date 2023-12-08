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

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
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
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($kerajangs as $item)
                                    @php
                                        $total += $item->produk->harga * $item->kuantitas;
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
                            <a href="{{ route('keranjang.checkout') }}" class="btn btn-success btn-sm">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
