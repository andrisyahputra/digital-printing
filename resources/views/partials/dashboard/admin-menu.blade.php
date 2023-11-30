<li class="menu-item {{ $page == 'dashboard' ? 'active' : '' }}">
    <a href="{{ route('admin.dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
    </a>
</li>

<li class="menu-item {{ $page == 'kategori' ? 'active' : '' }}">
    <a href="{{ route('kategori.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Kategori</div>
    </a>
</li>

<!-- Layouts -->
<li class="menu-item {{ $page == 'produk' ? 'open active' : '' }}">
    <a href="#" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-layout"></i>
        <div data-i18n="produk">Produk</div>
    </a>

    <ul class="menu-sub">
        <li class="menu-item {{  isset($menu) && $menu == 'create' ? 'active' : '' }}">
            <a href="{{ route('produk.create')}}" class="menu-link">
                <div data-i18n="Without navbar">Tambah Produk</div>
            </a>
        </li>
        <li class="menu-item {{  isset($menu) && $menu == 'index' ? 'active' : '' }}">
            <a href="{{ route('produk.index')}}" class="menu-link">
                <div data-i18n="Without menu">Daftar Produk</div>
            </a>
        </li>
    </ul>
</li>

<li class="menu-item {{ $page == 'pesanan' ? 'active' : '' }}">
    <a href="{{ route('pesanan.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Pesanan</div>
    </a>
</li>

<li class="menu-item {{ $page == 'transaksi' ? 'active' : '' }}">
    <a href="{{ route('transaksi.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Transaksi</div>
    </a>
</li>

<li class="menu-item">
    <a href="{{ url('index.html') }}" class="menu-link">
    <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Pengaturan</div>
    </a>
</li>
