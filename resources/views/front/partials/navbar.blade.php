<nav class="navbar sticky-top">
    <a href="/" class="navbar-logo">Toko<span>Online</span></a>
    <div class="navbar-menu">
        <a href="/">Beranda</a>
        <a href="{{ route('produk') }}">Produk</a>
        <a href="#">Tentang Kami</a>
        <a href="{{ route('kontak') }}">Kontak</a>
    </div>

    <div class="navbar-icon">
        <a href="#" id="btn-search"><i class="fas fa-search"></i></a>

        {{-- <php if (empty($_SESSION['keranjang_belanja'])) : ?> --}}
        @if ($kerajangs == null)
            {{-- <a href="keranjang.php"><i class="fas fa-shopping-cart">(0)</i></a> --}}
            <a href="{{ route('keranjang.index') }}" id="btn-cart"><i class="fas fa-shopping-cart">(0)</i></a>
        @else
            {{-- <a href="keranjang.php"><i class="fas fa-shopping-cart">({{ $kerajangs->count() }})</i></a> --}}
            <a href="{{ route('keranjang.index') }}" id="btn-cart"><i
                    class="fas fa-shopping-cart">({{ $kerajangs->count() }})</i></a>
        @endif
        {{-- <php else : ?> --}}
        {{-- <php
        $item = 0;
        foreach ($_SESSION['keranjang_belanja'] as $id_produk => $jumlah) {
            $item++;
        }
        ?> --}}
        {{-- <php endif; ?> --}}

        <a href="#" id="btn-user"><i class="fas fa-user"></i></a>
        <a href="#" id="btn-menu"><i class="fas fa-bars"></i></a>

        <form action="{{ route('produk') }}" method="get">
            <div class="search-form">
                <input type="search" name="search" id="search-box" class="form-control" placeholder="Cari Produk">
                <button class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>

    <div class="user">
        @if (Auth::check())
            <li><a
                    href="{{ route(strtolower(implode('|',auth()->user()->getRoleNames()->toArray())) . '.dashboard') }}">Profil</a>
            </li>
            <li><a href="#" onclick="confirmLogout()">logout</a></li>
        @else
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Daftar</a></li>
        @endif
    </div>

    <!-- Shopping Item -->

    <div class="cart">
        @if (Auth::check())
            <div class="shopping-item p-2">
                <div class="dropdown-cart-header d-flex justify-content-between ">
                    <span>{{ $kerajangs->count() }} Items</span>
                    {{-- <a href="{{ route('keranjang') }}">View Cart</a> --}}
                    <a href="">View Cart</a>
                </div>
                <ul class="shopping-list">
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($kerajangs as $item)
                        @php
                            $total += $item->produk->harga * $item->kuantitas;
                        @endphp

                        <li>
                            <form action="{{ route('keranjang.destroy', $item->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="remove" title="Remove this item">X</button>
                            </form>
                            <a class="cart-img" href="#"><img src="{{ Storage::url($item->produk->foto) }}"
                                    alt="{{ $item->produk->foto }}"></a>
                            <h4><a href="#">{{ $item->produk->nama }}</a>
                            </h4>
                            <p class="quantity">{{ $item->kuantitas }}x - <span class="amount">Rp
                                    {{ number_format($item->produk->harga * $item->kuantitas) }}</span></p>
                        </li>
                    @endforeach
                </ul>
                <div class="bottom">
                    <div class="total">
                        <span>Total</span>
                        <span class="total-amount">Rp {{ number_format($total) }}</span>
                    </div>
                    {{-- <a href="{{ route('keranjang.checkout') }}" class="btn animate">Checkout</a> --}}
                    <a href="#" class="btn animate" data-toggle="modal" data-target="#checkoutModal">Checkout</a>

                    {{-- <button data-bs-toggle="modal" data-bs-target="#modalCheckout" class="btn animate">Checkout</button> --}}
                </div>
            </div>
        @endif
    </div>

    <!--/ End Shopping Item -->
    {{-- modal --}}




    {{-- akhir mdoal --}}
</nav>

{{-- @push('modal') --}}
<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">Pilih Alamat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Isi modal di sini -->
                <form action="" method="post">

                    <div class="form-group row">
                        <label for="alamat" class="col-sm-3 col-form-label"> Alamat Lengkap:</label>
                        <div class="col-sm-9">
                            <textarea type="text" class="form-control" name="alamat" placeholder="Masukkan alamat" id="alamat" required></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="provinsi" class="col-sm-3 col-form-label"> Provinsi :</label>
                        <div class="col-sm-9">
                            <select name="provinsi" id="provinsi" class="form-control" required>

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="distrik" class="col-sm-3 col-form-label"> Distrik :</label>
                        <div class="col-sm-9">
                            <select name="distrik" id="distrik" class="form-control" required>

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ekspedisi" class="col-sm-3 col-form-label"> Ekspedisi :</label>
                        <div class="col-sm-9">
                            <select name="ekspedisi" id="ekspedisi" class="form-control" required>

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="paket" class="col-sm-3 col-form-label"> paket :</label>
                        <div class="col-sm-9">
                            <select name="paket" id="paket" class="form-control" required>

                            </select>
                        </div>
                    </div>

                    <input type="text" name="total_berat" class="form-control" value="<?= $subberat ?>" readonly>
                    <input type="text" name="total_berat" class="form-control" value="120" readonly>
                    <input type="text" name="nama_provinsi" class="form-control" readonly>
                    <input type="text" name="nama_distrik" class="form-control" readonly>
                    <input type="text" name="type_distrik" class="form-control" readonly>
                    <input type="text" name="kode_pos" class="form-control" readonly>
                    <input type="text" name="nama_ekspedisi" class="form-control" readonly>
                    <input type="text" name="paket" class="form-control" readonly>
                    <input type="text" name="ongkir" class="form-control" readonly>
                    <input type="text" name="etd" class="form-control" readonly>

                    <div class="text-right">
                        <button name="checkout" class="btn-success">Checkout</button>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <!-- Jika ingin langsung melakukan redirect saat tombol "Checkout" di dalam modal ditekan -->
                <a href="{{ route('keranjang.checkout') }}" class="btn btn-primary">Lanjutkan ke Checkout</a>
            </div>
        </div>
    </div>
</div>
{{-- @endpush --}}

@push('js')
    <script>
        function confirmLogout() {
            alertify.confirm("Logout", "Yakin Ingin Keluar?",
                function() {
                    // Jika pengguna menekan tombol OK
                    logout();
                },
                function() {
                    // Jika pengguna menekan tombol Cancel
                    alertify.error('Logout canceled');
                });
        }

        function logout() {
            // Implementasi fungsi logout di sini (contoh: redirect ke route logout-user)
            window.location.href = '{{ route('logout') }}';
        }
    </script>
@endpush
