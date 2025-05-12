<div class="wrapper">
    <aside id="sidebar">
        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <i class="lni lni-list"></i>
            </button>
            <div class="sidebar-logo">
                <a href="{{ route('admin.dashboard') }}">Web Sales</a>
            </div>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                    <i class="lni lni-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.mobil.index') }}" class="sidebar-link">
                    <i class="lni lni-pencil-alt"></i>
                    <span>Daftar Mobil</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.mobil.index_tipe') }}" class="sidebar-link">
                    <i class="lni lni-pencil-alt"></i>
                    <span>Daftar Tipe Mobil</span>
                </a>
            </li>
        </ul>
        {{-- <div class="sidebar-footer">
            <a href="{{ route('profilAdmin') }}" class="sidebar-link">
                <i class="fas fa-user"></i>
                <span>Profil Admin</span>
            </a>
        </div> --}}
        {{-- <div class="sidebar-footer">
            <a href="{{ route('halamanTentang') }}" class="sidebar-link">
                <i class="lni lni-code-alt"></i>
                <span>Tentang</span>
            </a>
        </div> --}}
        <div class="sidebar-footer">
            <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>
    <div class="main p-3">
        @yield('content')
    </div>
</div>
