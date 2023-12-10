<!-- Nav Item - Dashboard -->
<li class="nav-item @activeMenu('admin.dashboard')">
    <a class="nav-link" href="{{ route('admin.dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<li class="nav-item @activeMenu('kategori.index')">
    <a class="nav-link" href="{{ route('kategori.index') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Kategori</span></a>
</li>

<li class="nav-item @activeMenu('produk.*')">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
        aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Produk</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('produk.create') }}">Tambah Produk</a>
            <a class="collapse-item" href="{{ route('produk.index') }}">List Produk</a>
        </div>
    </div>
</li>

<li class="nav-item  @activeMenu('pesanan.*')">
    <a class="nav-link" href="{{ route('pesanan.index') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Pesanan</span></a>
</li>

<li class="nav-item @activeMenu('transaksi.*')">
    <a class="nav-link" href="{{ route('transaksi.index') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Transaksi</span></a>
</li>

<li class="nav-item @activeMenu('kontak.*')">
    <a class="nav-link" href="{{ route('kontak.index') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Pesan Pelanggan</span></a>
</li>

<li class="nav-item ">
    <a class="nav-link" href="$">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Pengaturan</span></a>
</li>