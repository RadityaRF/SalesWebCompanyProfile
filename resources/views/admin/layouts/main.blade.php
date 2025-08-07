<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin Panel') - Toyota Web Sales</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/honda-symbol.png') }}" type="image/svg+xml">
    <style>
        /* Styles untuk desktop collapsed state */
        #sidebar.collapsed .sidebar-logo .full-text,
        #sidebar.collapsed ul.sidebar-nav span {
            display: none;
        }
        #sidebar.collapsed .sidebar-logo .collapsed-text {
            display: inline;
        }
        #sidebar.collapsed ul.sidebar-nav .sidebar-link {
            justify-content: center;
        }
        #sidebar.collapsed ul.sidebar-nav .sidebar-link i {
            margin-right: 0;
        }
        #sidebar.collapsed .sidebar-footer span {
            display: none;
        }
        #sidebar.collapsed .sidebar-footer button {
            justify-content: center;
        }
        #sidebar.collapsed .sidebar-footer button i {
            margin-right: 0;
        }

        /* Mobile header styles */
        #mobile-header {
            height: 60px;
            background-color: #ffffff;  /* Mengubah latar belakang header menjadi putih */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center; /* Memusatkan logo */
            padding: 0 16px;  /* Padding untuk offset */
            position: fixed; /* Tambahkan agar header tetap di atas */
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
        }

        #header-logo {
            max-height: 22px; /* Ukuran logo diperkecil dari 40px ke 28px */
            width: auto;
        }

        #mobile-header button {
            background-color: #343a40; /* Tombol menjadi gelap */
            color: #ffffff; /* Warna teks tombol menjadi putih */
            border: none; /* Menghilangkan border tombol */
            padding: 5px; /* Menambahkan padding untuk tombol */
            border-radius: 5px; /* Menambahkan sudut bulat */
            transition: background-color 0.3s; /* Efek transisi saat hover */
            position: absolute; /* Menggunakan absolut untuk mengatur posisi tombol */
            left: 16px; /* Posisi tombol hamburger di kiri */
        }

        #mobile-header button:hover {
            background-color: #495057; /* Mengubah warna saat hover */
        }

        /* Overlay untuk mobile sidebar dengan efek blur */
        #sidebar-overlay {
            background: rgba(0,0,0,0.2); /* Lebih transparan */
            backdrop-filter: blur(6px); /* Efek blur pada halaman di belakang sidebar */
        }
        /* Sembunyikan header saat sidebar mobile terbuka */
        body.sidebar-open #mobile-header {
            display: none !important;
        }

        /* Non-scroll pada mobile jika konten pendek */
        @media (max-width: 767px) {
            html, body {
                overscroll-behavior: none;
                touch-action: pan-x pan-y;
                height: 100%;
            }
            body {
                min-height: 100vh;
                max-height: 100vh;
                overflow-y: auto;
            }
            .main {
                min-height: calc(100vh - 70px); /* 70px = header mobile */
            }
        }

        @media (min-width: 768px) {
            #mobile-header {
                display: none; /* Sembunyikan header di tampilan desktop */
            }
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Mobile Header - Menampilkan logo saja -->
    <header id="mobile-header">
        <button id="mobile-sidebar-toggle" aria-label="Toggle sidebar">
            <i class="lni lni-menu-hamburger-1 text-xl"></i>
        </button>
        <img id="header-logo" src="{{ asset('images/honda-logo.svg') }}" alt="Honda Logo"> {{-- Logo di tengah --}}
    </header>

    <!-- Overlay untuk mobile sidebar -->
    <div id="sidebar-overlay" class="md:hidden fixed inset-0 bg-black bg-opacity-50 z-40 hidden" aria-hidden="true"></div>

    <div class="flex">
        <!-- Sidebar -->
        <aside id="sidebar"
               class="bg-[#2B2828] text-white min-h-screen fixed top-0 left-0 z-[60]
                      transform -translate-x-full md:translate-x-0 md:w-64
                      transition-all duration-300 ease-in-out shadow-lg md:shadow-none">
            @include('admin.layouts.sidebar')
        </aside>

        <!-- Main Content -->
        <div class="main flex-1 min-h-screen mt-[70px] md:mt-0 md:ml-64 transition-all duration-300 ease-in-out">
            <div class="p-4 sm:p-6">
                <div class="max-w-full mx-auto">
                    <main>
                        @yield('content')
                    </main>

                    <footer class="mt-8 pt-6 border-t border-gray-200 text-center text-xs sm:text-sm text-gray-500">
                        &copy; {{ date('Y') }} - All Rights Reserved.
                    </footer>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.querySelector('.main');
        const desktopToggleBtn = document.querySelector('.toggle-btn');
        const mobileSidebarToggleBtn = document.getElementById('mobile-sidebar-toggle');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const header = document.getElementById('mobile-header'); // Mengambil elemen header

        const DESKTOP_BREAKPOINT = 768;

        function applyDesktopCollapsedState(isCollapsed) {
            if (window.innerWidth < DESKTOP_BREAKPOINT) {
                mainContent.classList.remove('md:ml-64', 'md:ml-20');
                sidebar.classList.remove('collapsed', 'md:w-20', 'md:w-64');
                return;
            }

            if (isCollapsed) {
                sidebar.classList.add('collapsed');
                sidebar.classList.remove('md:w-64');
                sidebar.classList.add('md:w-20');
                mainContent.classList.remove('md:ml-64');
                mainContent.classList.add('md:ml-20');
            } else {
                sidebar.classList.remove('collapsed');
                sidebar.classList.remove('md:w-20');
                sidebar.classList.add('md:w-64');
                mainContent.classList.remove('md:ml-20');
                mainContent.classList.add('md:ml-64');
            }
        }

        if (desktopToggleBtn) {
            desktopToggleBtn.addEventListener('click', function() {
                const isCurrentlyCollapsed = sidebar.classList.contains('collapsed');
                applyDesktopCollapsedState(!isCurrentlyCollapsed);
                localStorage.setItem('sidebarCollapsed', !isCurrentlyCollapsed);
            });
        }

        function initializeDesktopView() {
            if (window.innerWidth >= DESKTOP_BREAKPOINT) {
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.add('md:translate-x-0');
                sidebarOverlay.classList.add('hidden');
                if (mobileSidebarToggleBtn) {
                    mobileSidebarToggleBtn.setAttribute('aria-expanded', 'false');
                }

                if (localStorage.getItem('sidebarCollapsed') === 'true') {
                    applyDesktopCollapsedState(true);
                } else {
                    applyDesktopCollapsedState(false);
                }
            } else {
                sidebar.classList.remove('md:translate-x-0');
                sidebar.classList.remove('collapsed', 'md:w-20', 'md:w-64');
                mainContent.classList.remove('md:ml-64', 'md:ml-20');
                if(!sidebar.classList.contains('translate-x-0')) {
                    sidebar.classList.add('-translate-x-full');
                }
            }
        }

        initializeDesktopView();

        if (mobileSidebarToggleBtn) {
            mobileSidebarToggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('-translate-x-full');
                sidebar.classList.toggle('translate-x-0');
                sidebarOverlay.classList.toggle('hidden');
                const isExpanded = !sidebar.classList.contains('-translate-x-full');

                // Tambahkan/lepaskan class pada body untuk kontrol header
                if (isExpanded) {
                    document.body.classList.add('sidebar-open');
                } else {
                    document.body.classList.remove('sidebar-open');
                }

                mobileSidebarToggleBtn.setAttribute('aria-expanded', isExpanded);
            });
        }
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('translate-x-0');
                sidebarOverlay.classList.add('hidden');
                document.body.classList.remove('sidebar-open');
                if (mobileSidebarToggleBtn) {
                    mobileSidebarToggleBtn.setAttribute('aria-expanded', 'false');
                }
            });
        }

        window.addEventListener('resize', initializeDesktopView);
    });
    </script>

    @stack('scripts')
</body>
</html>
