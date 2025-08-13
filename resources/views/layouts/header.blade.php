<header class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto flex items-center justify-between p-6 px-4 sm:px-6">
        <!-- Logo and tagline -->
        <a href="{{ route('home') }}" class="flex items-center space-x-2">
            <img src="{{ asset('images/toyota_home_logo.svg') }}" alt="Honda" class="h-7">
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center space-x-6 text-sm uppercase">
            <a href="{{ route('home') }}#list-mobil" class="hover:text-red-600 transition-colors duration-200">List Mobil</a>
            <a href="{{ route('promo') }}"hover:text-red-600 transition-colors duration-200">Promo</a>
            <a href="{{ route('home') }}#contact-us" class="hover:text-red-600 transition-colors duration-200">Contact Us</a>
            <!-- <button aria-label="Search" class="hover:text-red-600 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button> -->
        </nav>

        <!-- Hamburger Menu (for mobile) -->
        <div class="md:hidden flex items-center">
            <button id="hamburger" aria-label="Toggle menu" class="focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Menu (Hidden by default) -->
    <div id="mobile-menu" class="hidden md:hidden bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3">
            <nav class="space-y-3 text-sm uppercase">
                <a href="{{ route('home') }}#list-mobil" class="block py-2 hover:text-red-600 transition-colors duration-200">List Mobil</a>
                <a href="{{ route('promo') }}" class="block py-2 hover:text-red-600 transition-colors duration-200">Promo</a>
                <a href="{{ route('home') }}#contact-us" class="block py-2 hover:text-red-600 transition-colors duration-200">Contact Us</a>
                <!-- <button aria-label="Search" class="block py-2 hover:text-red-600 transition-colors duration-200 w-full text-left">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Search
                    </div>
                </button> -->
            </nav>
        </div>
    </div>
</header>

<script>
    document.getElementById('hamburger').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');

        // Optional: Toggle aria-expanded attribute
        const isExpanded = this.getAttribute('aria-expanded') === 'true';
        this.setAttribute('aria-expanded', !isExpanded);
    });
</script>


<script>
    let lastScrollY = window.scrollY;
    const header = document.querySelector('header');

    window.addEventListener('scroll', () => {
        if (window.scrollY > lastScrollY) {
            // scrolling down → hide
            header.style.transform = 'translateY(-100%)';
        } else {
            // scrolling up → show
            header.style.transform = 'translateY(0)';
        }
        lastScrollY = window.scrollY;
    });
</script>

<style>
    header {
        transition: transform 0.3s ease;
    }
</style>
