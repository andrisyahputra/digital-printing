<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="index.html">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>User</span></a>
</li>

<li class="nav-item {{ $page == 'pesanan' ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('pesanan-saya') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Pesanan</span></a>
</li>
