<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Menu</span>
                </li>

                <!-- Menu Dashboard -->
                <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}">
                        <i class="la la-dashboard"></i>
                        <span> Dashboard</span>
                    </a>
                </li>

                <!-- Submenu Data -->
                <li class="submenu {{ set_active(['datadiri', 'pendidikan', 'pekerjaan']) }}">
                    <a href="#">
                        <i class="la la-user"></i>
                        <span> Data Pegawai</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->routeIs('datadiri') || request()->routeIs('pendidikan') || request()->routeIs('pekerjaan') ? 'display: block;' : 'display: none;' }}">
                        <li><a class="{{ set_active(['datadiri']) }}" href="{{ route('datadiri') }}">Data Diri</a></li>
                        <li><a class="{{ set_active(['pendidikan']) }}" href="{{ route('pendidikan') }}">Pendidikan</a></li>
                        <li><a class="{{ set_active(['pekerjaan']) }}" href="{{ route('pekerjaan') }}">Riwayat Pekerjaan</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
