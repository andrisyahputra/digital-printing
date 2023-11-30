<li class="menu-item {{ $page == 'dashboard' ? 'active' : '' }}">
    <a href="{{ route('user.dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
    </a>
</li>

<li class="menu-item {{ $page == 'pesanan' ? 'active' : '' }}">
    <a href="{{ route('pesanan-saya') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Pesanan Saya</div>
    </a>
</li>
