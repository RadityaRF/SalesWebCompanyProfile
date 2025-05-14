<div class="wrapper flex">
    <!-- Sidebar -->
    <aside id="sidebar" class="bg-[#2B2828] text-white w-64 min-h-screen transition-all duration-300 ease-in-out fixed">
        {{-- <div class="p-4 flex items-center justify-between border-b border-[#252222]">
            <button class="toggle-btn text-white focus:outline-none">
                <i class="lni lni-list text-xl"></i>
            </button>
            <div class="sidebar-logo">
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-semibold text-white hover:text-red-500 transition-colors">
                    Honda Admin
                </a>
            </div>
        </div> --}}

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
    </aside>
</div>

<style>
    .sidebar-link.active {
        background-color: #252222;
        color: #ef4444;
    }

    /* Smooth transition for sidebar collapse */
    #sidebar.collapsed {
        width: 80px;
    }

    #sidebar.collapsed .sidebar-logo,
    #sidebar.collapsed span {
        display: none;
    }

    #sidebar.collapsed .sidebar-link {
        justify-content: center;
    }

    #sidebar.collapsed .sidebar-link i {
        margin-right: 0;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.querySelector('.toggle-btn');
    const sidebar = document.getElementById('sidebar');

    toggleBtn.addEventListener('click', function() {
        sidebar.classList.toggle('collapsed');

        // Adjust main content margin
        const main = document.querySelector('.main');
        if (sidebar.classList.contains('collapsed')) {
            main.classList.remove('ml-64');
            main.classList.add('ml-20');
        } else {
            main.classList.remove('ml-20');
            main.classList.add('ml-64');
        }
    });
});
</script>
