<!-- Nav Item - Dashboard -->
<li class="nav-item @activeMenu('user.dashboard')">
    <a class="nav-link" href="{{ route('user.dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>User</span></a>
</li>

<li class="nav-item @activeMenu('pesanan-saya.*')">
    <a class="nav-link" href="{{ route('pesanan-saya.index') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Pesanan</span></a>
</li>
