<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Honda Indonesia')</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.0/dist/tailwind.min.css" rel="stylesheet">
  @stack('styles')
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

  {{-- Header --}}
  <header class="bg-white shadow">
    <div class="container mx-auto flex items-center justify-between p-6">
      <!-- Logo and tagline -->
      <a href="{{ route('home') }}" class="flex items-center space-x-2">
        <img src="{{ asset('images/honda-logo.svg') }}" alt="Honda" class="h-8">
        <span class="text-lg font-semibold text-gray-800">The Power of Dreams</span>
      </a>

      <!-- Desktop Navigation -->
      <nav class="hidden md:flex items-center space-x-6 text-sm uppercase">
        <a href="{{ route('home') }}" class="hover:text-red-600">Cars</a>
        <a href="#" class="hover:text-red-600">Promotions</a>
        <a href="#" class="hover:text-red-600">Booking</a>
        <button aria-label="Search" class="hover:text-red-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
               viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
        </button>
      </nav>

      <!-- Hamburger Menu (for mobile) -->
      <div class="md:hidden flex items-center">
        <button id="hamburger" aria-label="Toggle menu">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
               viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
      </div>
    </div>

    <!-- Mobile Navigation Menu (Hidden by default) -->
    <div id="mobile-menu" class="hidden md:hidden bg-white shadow-md">
      <div class="container mx-auto p-4">
        <nav class="space-y-4 text-sm uppercase">
          <a href="{{ route('home') }}" class="hover:text-red-600 block">Cars</a>
          <a href="#" class="hover:text-red-600 block">Promotions</a>
          <a href="#" class="hover:text-red-600 block">Booking</a>
          <button aria-label="Search" class="hover:text-red-600 block">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
          </button>
        </nav>
      </div>
    </div>
  </header>

  {{-- Hero Section (Banner/Carousel) --}}
  <div class="bg-gray-300 h-64 md:h-96">
    {{-- Insert Slider here if needed --}}
  </div>

  {{-- Main Content --}}
  <main class="container mx-auto p-6">
    @yield('content')
  </main>

  {{-- Footer --}}
  <footer class="bg-white border-t mt-12">
    <div class="container mx-auto p-6">
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        <!-- Logo and Contact -->
        <div class="space-y-4">
          <a href="{{ route('home') }}" class="flex items-center space-x-2">
            <img src="{{ asset('images/honda-logo.svg') }}" alt="Honda" class="h-8">
          </a>
          <p class="text-sm text-gray-600">Honda Indonesia - The Power of Dreams</p>
        </div>

        <!-- Navigation Links -->
        <div>
          <h3 class="font-semibold text-gray-800">Quick Links</h3>
          <ul class="space-y-2 text-sm text-gray-600">
            <li><a href="#" class="hover:text-red-600">About Us</a></li>
            <li><a href="#" class="hover:text-red-600">Careers</a></li>
            <li><a href="#" class="hover:text-red-600">Contact</a></li>
            <li><a href="#" class="hover:text-red-600">Privacy Policy</a></li>
          </ul>
        </div>

        <!-- Social Media Links -->
        <div>
          <h3 class="font-semibold text-gray-800">Follow Us</h3>
          <ul class="space-y-2 text-sm text-gray-600">
            <li><a href="#" class="hover:text-red-600">Facebook</a></li>
            <li><a href="#" class="hover:text-red-600">Instagram</a></li>
            <li><a href="#" class="hover:text-red-600">Twitter</a></li>
          </ul>
        </div>

        <!-- Contact Information -->
        <div>
          <h3 class="font-semibold text-gray-800">Contact</h3>
          <p class="text-sm text-gray-600">Call Us: 0800-123-4567</p>
          <p class="text-sm text-gray-600">Email: info@hondaindonesia.com</p>
        </div>
      </div>

      <!-- Bottom Legal Information -->
      <div class="mt-6 text-center text-sm text-gray-600">
        &copy; {{ date('Y') }} Honda Indonesia. All Rights Reserved.
      </div>
    </div>
  </footer>

  @stack('scripts')

  {{-- Script to Toggle Hamburger Menu --}}
  <script>
    document.getElementById('hamburger').addEventListener('click', function() {
      const menu = document.getElementById('mobile-menu');
      menu.classList.toggle('hidden');
    });
  </script>

</body>
</html>
