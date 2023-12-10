<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>


    @include('partials.css_dashboard')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="{{ route(strtolower(implode('|',auth()->user()->getRoleNames()->toArray())) . '.dashboard') }}">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-store-alt"></i>
                </div>
                <div class="sidebar-brand-text mx-2">Toko Online</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            {{-- menu --}}
            @if (auth()->user()->hasRole('Admin'))
                @include('partials.menu.admin-menu')
            @endif
            @if (auth()->user()->hasRole('User'))
                @include('partials.menu.user-menu')
            @endif
            {{-- akhir menu --}}


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                        action="{{ route('pesanan.cari') }}" method="get">
                        <div class="input-group">
                            <input type="text" name="order_id" class="form-control bg-light border-0 small"
                                placeholder="Cari Order ID..." value="{{ request()->input('order_id') }}"
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">{{ $totalTransaksi }}</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Transaksi Masuk
                                </h6>
                                {{-- <php foreach ($transaksi as $key => $item) : ?> --}}
                                @forelse ($transaksi as $index => $item)
                                    <a class="dropdown-item d-flex align-items-center"
                                        @if (auth()->user()->hasRole('User')) href="{{ route('pesanan-saya.show', $index) }}"
                                        @else
                                        href="{{ route('pesanan.show', $index) }} @endif ">
                                        <div class="mr-3">
                                            <div
                                                class="icon-circle
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
                    @endswitch">
                                                <i class="fas fa-exclamation-triangle text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">
                                                {{ $item->first()->created_at_id() }}</div>
                                            Total Barang {{ $item->count() }} <br>
                                            .
                                        </div>
                                    </a>
@empty
 @endforelse


                                        @if (auth()->user()->hasRole('User'))
                                            <a class="dropdown-item text-center small text-gray-500"
                                                href="{{ route('pesanan-saya.index') }}">Lihat Semua Pesanan</a>
                                        @else
                                            <a class="dropdown-item text-center small text-gray-500"
                                                href="{{ route('pesanan.index') }}">Lihat Semua Pesanan</a>
                                        @endif

                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        @if (auth()->user()->hasRole('Admin'))
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-envelope fa-fw"></i>
                                    <!-- Counter - Messages -->
                                    <span class="badge badge-danger badge-counter">{{ $totalPesanan }}</span>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="messagesDropdown">
                                    <h6 class="dropdown-header">
                                        Pesan Masuk
                                    </h6>
                                    <?php foreach ($pesanans as $item) : ?>
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{{ route('kontak.show', $item->id) }}">

                                        <div>
                                            <div class="text-truncate">
                                                {{ $item->nama }}
                                            </div>
                                            <div class="small text-gray-500">{{ $item->email }}</div>
                                        </div>
                                    </a>
                                    <?php endforeach; ?>
                                    <a class="dropdown-item text-center small text-gray-500"
                                        href="{{ route('kontak.index') }}">Lihat Semua
                                        Pesan</a>
                                </div>
                            </li>
                        @endif

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div>
                                    <span
                                        class="mr-2 d-none d-lg-inline text-gray-600 small">{{ ucwords(auth()->user()->name) }}</span>
                                    <br>
                                    <span
                                        class="mr-2 d-none d-lg-inline text-gray-400 small">{{ ucwords(implode('|',auth()->user()->getRoleNames()->toArray())) }}</span>
                                </div>
                                <img class="img-profile rounded-circle"
                                    src="{{ Storage::url(auth()->user()->foto) }}" alt="{{ auth()->user()->foto }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="post" id="logout_form">
                                    @csrf
                                    {{-- @method('delete') --}}
                                    <a href="#" class="dropdown-item" onclick="logout('#logout_form')">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                    {{-- <div class="dropdown-item" onclick="logout('#logout_form')">
                                        <i class="bx bx-power-off me-2"></i>
                                        <span class="align-middle">Log Out</span>
                                    </div> --}}
                                </form>

                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @section('content')
                        <div class="shadow p-3 mb-3 bg-white rouded">
                            <h5>
                                <b>{{ $title }}</b>
                            </h5>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                <strong>Berhasil</strong> {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                <strong>Gagal</strong> {{ session('error') }}
                            </div>
                        @endif
                        {{-- konten --}}

                        @yield('content')
                        {{-- akhir konten --}}

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2021</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>


        {{-- modal --}}
        @stack('modal')
        {{-- akhir modal --}}

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="{{ route('logout') }}">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.js_dashboard')

    </body>

    </html>
