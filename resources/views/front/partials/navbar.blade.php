<nav class="navbar sticky-top">
    <a href="/" class="navbar-logo">{{ config('app.name', 'Laravel') }} <span>Online</span></a>
    <div class="navbar-menu">
        <a href="/">Beranda</a>
        <a href="{{ route('produk') }}">Produk</a>
        {{-- <a href="#">Tentang Kami</a> --}}
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

                        <li>
                            <form action="{{ route('keranjang.destroy', $item->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="remove" title="Remove this item">X</button>
                            </form>
                            @switch($item->kategori_id)
                                @case(1)
                                @case(2)
                                    <a class="cart-img" href="#"><img src="{{ Storage::url($item->produk->foto) }}"
                                            alt="{{ $item->produk->foto }}"></a> <a class="cart-img" href="#"><img
                                            src="{{ Storage::url($item->foto) }}" alt="{{ $item->foto }}"
                                            width="50"></a>
                                    <h4><a href="#">{{ $item->produk->nama }}</a>
                                    </h4>

                                    <p class="quantity">{{ $item->kuantitas }}x = Panjang {{ $item->panjang }} & Lebar
                                        {{ $item->lebar }}
                                        <br>
                                        <span class="amount">Rp {{ number_format($totalSekarang) }}
                                        </span>
                                    </p>
                                @break

                                @case(3)
                                    <a class="cart-img" href="#"><img src="{{ Storage::url($item->produk->foto) }}"
                                            alt="{{ $item->produk->foto }}"></a> <a class="cart-img" href="#">
                                        <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->foto }}"
                                            width="50"></a>
                                    <h4><a href="#">{{ $item->produk->nama }}</a>
                                    </h4>
                                    <p class="quantity">{{ $item->kuantitas }}x - <span class="amount">Rp
                                            {{ number_format($item->produk->harga * $item->kuantitas) }}
                                        </span></p>
                                @break

                                @case(4)
                                    <a class="cart-img" href="#"><img src="{{ Storage::url($item->produk->foto) }}"
                                            alt="{{ $item->produk->foto }}"></a> <a class="cart-img" href="#">
                                        <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->foto }}"
                                            width="50"></a>
                                    <h4><a href="#">{{ $item->produk->nama }}</a>
                                    </h4>
                                    <p class="quantity">{{ $item->kuantitas }}x - Kertas <b><u>{{ $item->kertas }}</u></b>
                                        <br>
                                        <span class="amount">Rp
                                            {{ number_format($item->produk->harga * $item->kuantitas) }}
                                        </span>
                                    </p>
                                @break

                                @default
                                    <a class="cart-img" href="#"><img src="{{ Storage::url($item->produk->foto) }}"
                                            alt="{{ $item->produk->foto }}"></a>
                                    <h4><a href="#">{{ $item->produk->nama }}</a>
                                    </h4>
                                    <p class="quantity">{{ $item->kuantitas }}x - <span class="amount">Rp
                                            {{ number_format($item->produk->harga * $item->kuantitas) }}
                                        </span></p>
                            @endswitch

                        </li>
                    @endforeach
                </ul>
                <div class="bottom">
                    <div class="total">
                        <span>Total</span>
                        <span class="total-amount">Rp {{ number_format($total) }}</span>
                    </div>
                    {{-- <a href="{{ route('keranjang.checkout') }}" class="btn animate">Checkout</a> --}}

                    <a href="#" class="btn animate" onclick="modal('#rajaongkir')">Checkout</a>

                    {{-- <button data-bs-toggle="modal" data-bs-target="#modalCheckout" class="btn animate">Checkout</button> --}}
                </div>
            </div>
        @endif
    </div>

    <!--/ End Shopping Item -->
    {{-- modal --}}




    {{-- akhir mdoal --}}
</nav>
@auth
    {{-- @push('modal') --}}
    <div class="modal fade" id="rajaongkir" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutModalLabel">Pilih Alamat Tujuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>



                @if (auth()->user()->alamat == null)
                    <div class="modal-body">
                        <!-- Isi modal di sini -->
                        <form action="{{ route('alamat.store') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="alamat" class="col-sm-3 col-form-label"> Alamat Lengkap:</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control" name="alamat_users"
                                        placeholder="Masukkan alamat @error('alamat')
                                    is-invalid
                                @enderror"
                                        id="alamat" required></textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="provinsi" class="col-sm-3 col-form-label"> Provinsi :</label>
                                <div class="col-sm-9">
                                    <div id="dataProvinsiUrl" data-url="{{ route('data.provinsi') }}"></div>
                                    <select name="provinsi" id="provinsi" class="form-control" required>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="distrik" class="col-sm-3 col-form-label"> Kota :</label>
                                <div class="col-sm-9">
                                    <div id="dataDistrikUrl" data-url="{{ route('data.distrik') }}"></div>
                                    <select name="distrik" id="distrik" class="form-control" required>

                                    </select>
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">

                        <button class="btn btn-primary" type="submit">Simpan Alamat</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <!-- Jika ingin langsung melakukan redirect saat tombol "Checkout" di dalam modal ditekan -->
                        {{-- {{-- <a href="{{ route('keranjang.checkout') }}" class="btn btn-info">Ganti Alamat</a> --}}
                    </div>
                    </form>
                @else
                    <div class="modal-body">
                        <textarea id="textareaAlamat" class="form-control" readonly>{{ 'Alama Lengkap ' . $alamatUser->alamat_users . ' Provinsi ' . provinsi($alamatUser->provinsi) . ' Kota ' . distrik($alamatUser->kota) }} </textarea>

                        <div id="contentToToggle">
                            <form action="{{ route('alamat.update', $alamatUser->id) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-3 col-form-label"> Alamat Lengkap:</label>
                                    <div class="col-sm-9">
                                        <textarea type="text" class="form-control" name="alamat_users"
                                            placeholder="Masukkan alamat @error('alamat')
                                    is-invalid
                                @enderror"
                                            id="alamat" required>{{ $alamatUser->alamat_users }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="provinsi" class="col-sm-3 col-form-label"> Provinsi :</label>
                                    <div class="col-sm-9">
                                        <div id="dataProvinsiUrl" data-url="{{ route('data.provinsi') }}"></div>
                                        <select name="provinsi" id="provinsi" class="form-control" required>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="distrik" class="col-sm-3 col-form-label"> Kota :</label>
                                    <div class="col-sm-9">
                                        <div id="dataDistrikUrl" data-url="{{ route('data.distrik') }}"></div>
                                        <select name="distrik" id="distrik" class="form-control" required>

                                        </select>
                                    </div>
                                </div>

                        </div>


                    </div>
                    {{-- </div> --}}
                    <div class="modal-footer">
                        <button id="toggleButton" type="button" class="btn btn-info">
                            Ubah Alamat
                        </button>

                        <button class="btn btn-primary" type="submit" id="btnUbah">Simpan Alamat</button>
                        @if (auth()->user()->kerajangs->count() == 0)
                            <a href="{{ route('produk') }}" class="btn btn-primary" id="btnCheckoutNull">Keranjang
                                Kosong Silakan Belanja</a>
                        @else
                            <div onclick="payment('{{ route('keranjang.checkout') }}')" id="btnCheckout"
                                class="btn btn-primary">Lanjutkan ke Checkout</div>
                        @endif
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                @endif
            </div>
            </form>
        </div>
    </div>
    </div>
    {{-- @endpush --}}
@endauth

@push('js')
    <script>
        // midtrans
        // var payment = document
        //     .getElementById("btnCheckout")
        //     .getAttribute("data-url");


        // var payButton = document.getElementById('btnCheckout');
        // payButton.addEventListener('click', function() async {

        //     try {
        //         const response = await fetch(payment, {
        //             method: 'get',
        //         });
        //         const token = await.response.text();
        //         console.log(token);
        //         // window.snap.pay('TRANSACTION_TOKEN_HERE');
        //     } catch (error) {
        //         console.log(error.message);
        //     }


        // });


        $(document).ready(function() {
            $("#btnUbah").toggleClass("d-none");
            $("#contentToToggle").toggleClass("d-none");
            $("#toggleButton").click(function() {
                $("#btnCheckoutNull").toggleClass("d-none");
                $("#btnCheckout").toggleClass("d-none");
                $("#btnUbah").toggleClass("d-none");
                $("#contentToToggle").toggleClass("d-none");
                $("#textareaAlamat").toggleClass("d-none");
            });
        });

        function payment(url) {
            const tombol = document.getElementById("btnCheckout");
            const originalContent = tombol.innerHTML; // Store the original content

            $.ajax({
                url: url,
                type: "get",
                beforeSend: function() {
                    $("#btnCheckout").replaceWith(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Melakukan Pembayaran'
                    );
                },
                success: function(response) {
                    window.snap.pay(response);
                },
                error: function(response) {
                    console.log(response);
                },
                complete: function() {
                    // Replace the spinner with the original content
                    tombol.replaceWith(originalContent);
                }
            });
        }


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
