<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <!-- Brand Besar -->
        <div class="sidebar-brand text-center mt-2">
            <a href="{{ url('/') }}" class="text-primary font-weight-bold">
                DPRD Kota Tegal
            </a>
        </div>
        <!-- Brand Mini -->
        <div class="sidebar-brand sidebar-brand-sm text-center">
            <a href="{{ url('/') }}" class="text-primary font-weight-bold">
                DPRD
            </a>
        </div>

        <ul class="sidebar-menu mt-4">

            <!-- Dashboard -->
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fire"></i> <span>Dashboard</span>
                </a>
            </li>

            <!-- Main Menu -->
            <li class="menu-header">Main Menu</li>

            <li class="{{ Request::is('backend/berita*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('berita.index') }}">
                    <i class="fas fa-newspaper"></i> <span>Berita</span>
                </a>
            </li>

            <li class="{{ Request::is('backend/anggota*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('anggota.index') }}">
                    <i class="fas fa-users"></i> <span>Anggota Dewan</span>
                </a>
            </li>

            <li class="{{ Request::is('backend/magang*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('magang.index') }}">
                    <i class="fas fa-user-graduate"></i> <span>Lowongan Magang</span>
                </a>
            </li>

            @php
                $idLowongan = isset($firstLowongan) && $firstLowongan ? $firstLowongan->id : 1;
            @endphp
            <li class="{{ Request::is('backend/magang/pendaftar/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('magang.pendaftar', ['id' => $idLowongan]) }}">
                    <i class="fas fa-user-check"></i> <span>Pendaftar Magang</span>
                </a>
            </li>

            <li class="{{ Request::is('backend/users*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.users.index') }}">
                    <i class="fas fa-user-cog"></i> <span>Manajemen User</span>
                </a>
            </li>

            <!-- Aspirasi -->
            <li class="menu-header">Aspirasi</li>

            <li class="{{ Request::is('backend/aspirasi') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('aspirasi.index') }}">
                    <i class="fas fa-comments"></i> <span>Data Aspirasi</span>
                </a>
            </li>

            <li class="{{ Request::is('backend/aspirasi/arsip') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('aspirasi.arsip') }}">
                    <i class="fas fa-archive"></i> <span>Arsip Aspirasi</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('laporan.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('laporan.index') }}">
                    <i class="fas fa-file-alt"></i> <span>Laporan</span>
                </a>
            </li>

           <!-- FORM logout di sidebar -->
<li>
    <a class="nav-link" href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
        <i class="fas fa-sign-out-alt"></i> <span>Keluar</span>
    </a>
    <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</li>

        </ul>
    </aside>
</div>
