{{-- Sidebar Header with Desktop Toggle --}}
<div class="p-4 flex items-center justify-between border-b border-[#252222]">
    <div class="w-8 h-8 hidden md:flex items-center justify-center">
        <button class="toggle-btn text-white focus:outline-none" aria-label="Toggle sidebar collapse">
            <i class="lni lni-list text-xl"></i>
        </button>
    </div>

    <div class="sidebar-logo flex-grow text-center px-2"> {{-- Pastikan text-center dan flex-grow --}}
        <a href="{{ route('admin.dashboard') }}" class="text-xl font-semibold text-white hover:text-red-500 transition-colors">
            <span class="full-text">Honda Admin</span>
            {{-- <span class="collapsed-text hidden">HA</span> --}} {{-- Teks alternatif untuk sidebar collapsed --}}
        </a>
    </div>

    <div class="w-8 h-8 hidden md:block" aria-hidden="true"></div>
</div>

{{-- Navigation Links --}}
<ul class="sidebar-nav p-4 space-y-2">
    <li class="sidebar-item">
        <a href="{{ route('admin.dashboard') }}"
           class="sidebar-link flex items-center p-3 rounded-lg hover:bg-[#252222] hover:text-red-500 transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-[#252222] text-red-500' : '' }}">
            <i class="lni lni-home-2 mr-3"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a href="{{ route('admin.mobil.index') }}"
           class="sidebar-link flex items-center p-3 rounded-lg hover:bg-[#252222] hover:text-red-500 transition-colors duration-200 {{ request()->routeIs('admin.mobil.*') ? 'bg-[#252222] text-red-500' : '' }}">
            <i class="lni lni-car-4 mr-3"></i>
            <span>Daftar Mobil</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a href="{{ route('admin.mobil_tipe.index_tipe') }}"
           class="sidebar-link flex items-center p-3 rounded-lg hover:bg-[#252222] hover:text-red-500 transition-colors duration-200 {{ request()->routeIs('admin.mobil_tipe.*') ? 'bg-[#252222] text-red-500' : '' }}">
            <i class="lni lni-layers-1 mr-3"></i>
            <span>Tipe Mobil</span>
        </a>
    </li>
</ul>

{{-- Sidebar Footer with Logout --}}
<div class="sidebar-footer p-4 border-t border-[#252222] absolute bottom-0 w-full">
    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit"
                class="w-full flex items-center p-3 rounded-lg hover:bg-[#252222] hover:text-red-500 transition-colors duration-200">
            <i class="lni lni-exit mr-3"></i>
            <span>Logout</span>
        </button>
    </form>
</div>
