<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel - Honda Indonesia</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Line Icons -->
    <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/honda-logo.svg') }}" type="image/svg+xml">
<body class="bg-gray-50">
    <div class="wrapper flex">
        <!-- Include Sidebar -->
        <aside id="sidebar" class="w-64 min-h-screen fixed top-0 left-0 z-50">
            @include('admin.layouts.sidebar')
        </aside>

        <!-- Main Content -->
        <div class="main flex-1 ml-64 p-4 min-h-screen">
            <div class="max-w-full mx-auto">
                <!-- Content -->
                <main class="bg-white rounded-lg shadow p-6">
                    @yield('content')
                </main>

                <!-- Footer -->
                <footer class="mt-6 text-center text-sm text-gray-500">
                    &copy; {{ date('Y') }} - All Rights Reserved.
                </footer>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Toggle sidebar functionality
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.querySelector('.toggle-btn');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main');

            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('ml-64');
                mainContent.classList.toggle('ml-20');

                // Save state in localStorage
                const isCollapsed = sidebar.classList.contains('collapsed');
                localStorage.setItem('sidebarCollapsed', isCollapsed);
            });

            // Load saved state
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                sidebar.classList.add('collapsed');
                mainContent.classList.remove('ml-64');
                mainContent.classList.add('ml-20');
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
