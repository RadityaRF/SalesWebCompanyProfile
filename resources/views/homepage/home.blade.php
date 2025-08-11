@extends('layouts.main')
@section('title', 'Toyota Indonesia')
@section('content')
    {{-- Hero Banner --}}
    <div class="mb-8">
        <img src="https://d1g6w7sntckt92.cloudfront.net/public/images/basic_pages/1P6MIA4KXm5sWzfrzEd4drn7PjZAvaR6q3lGNs72.jpg"
            alt="Toyota Let's Go Beyond"
            class="w-full h-auto object-cover shadow-md">

    </div>

    <h1 class="text-3xl font-bold text-center text-red-800 mb-6 md:mb-8">Pilih Mobil Toyota untuk Anda!</h1>

    {{-- Filter Desktop Only --}}
    <div class="mb-8 px-4">
        <ul id="filter-list" class="hidden md:flex justify-center space-x-2 min-w-max">
        @php
            $currentFilter = request()->query('jenis', 'All');
            $jenisList = ['All', 'SUV', 'Sedan', 'MPV', 'City Car & Hatchback', 'Sports'];
        @endphp

        @foreach($jenisList as $j)
            <li class="flex-shrink-0"> {{-- Pastikan item tidak menyusut --}}
            <a href="{{ url()->current() }}?jenis={{ urlencode($j) }}"
                data-filter="{{ $j }}"
                class="filter-link px-4 py-2 rounded-md text-sm font-medium border whitespace-nowrap
                        {{ $currentFilter === $j ?
                        'bg-red-600 text-white border-red-600' :
                        'bg-gray-100 text-gray-700 border-gray-300 hover:bg-gray-200' }}">
                {{ $j === 'City Car & Hatchback' ? 'City Car/Hatchback' : $j }}
            </a>
            </li>
        @endforeach
        </ul>
    </div>
    </div>

    {{-- Loading Indicator (Initially Hidden) --}}
    <div id="loading-indicator" class="hidden col-span-full text-center py-10">
        <div class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-red-600"></div>
        <p class="mt-2 text-gray-600">Memuat mobil...</p>
    </div>

    {{-- Car Grid Container --}}
    <div id="car-grid-container" class="grid grid-cols-1 xs:grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6 px-4 md:px-8 max-w-7xl mx-auto">
        @include('homepage.car_grid', ['mobils' => $mobils])
    </div>

    {{-- Empty State (Hidden by Default) --}}
    <div id="empty-state" class="hidden col-span-full text-center py-10">
        <i class="fas fa-car text-4xl text-gray-300 mb-3"></i>
        <p class="text-gray-500">Tidak ada mobil yang tersedia</p>
    </div>

    

    {{-- Contact Us --}}
    <div class="bg-red-900 text-white py-12 mt-20" id="contact-us">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 px-4">

            {{-- Left Column - Logo & About --}}
            <div>
                <h3 class="text-lg font-semibold mb-2">Toyota Signature Jakarta</h3>
                <p class="italic text-gray-300 mb-4">
                    Menjadi dealer Toyota pilihan utama di Indonesia yang menghadirkan pelayanan istimewa, kualitas terbaik, dan pengalaman kepemilikan mobil yang tak tertandingi.
                </p>
            </div>

            {{-- Middle Column - Opening Hours --}}
            <div>
                <h3 class="text-lg font-semibold mb-2">Jam Operasional</h3>
                <p class="font-medium text-gray-300 mb-2">Senin – Sabtu: 09.00 – 18.00</p>
                <p class="font-medium text-gray-300 mb-2">Minggu : 17.30 – 00.00</p>
                {{-- <p class="font-medium text-gray-300">Friday – Saturday: 12.00 – 14.45</p> --}}
            </div>

            {{-- Right Column - Contact Info --}}
            <div>
                <h3 class="text-lg font-semibold mb-2">Contact Info</h3>
                <p class="font-semibold text-gray-300 mb-2">
                    Rafi Nabil
                </p>
                {{-- WhatsApp --}}
                <a href="https://wa.me/6287784281500?text=Halo%20Rafi%20Nabil%2C%20saya%20tertarik%20dengan%20mobil%20Toyota-nya.%20Bisa%20dibantu%20info%20lebih%20lanjut%3F%20Terima%20kasih." target="_blank" class="italic flex items-center mb-2 hover:text-red-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20.52 3.48A11.8 11.8 0 0012.01 0C5.38 0 .01 5.37.01 12c0 2.11.55 4.18 1.6 6.01L0 24l6.19-1.61a11.97 11.97 0 005.82 1.49h.01c6.63 0 12-5.37 12-12 0-3.19-1.24-6.19-3.5-8.4zM12 21.54a9.57 9.57 0 01-4.88-1.34l-.35-.21-3.67.96.98-3.58-.23-.37A9.53 9.53 0 012.45 12c0-5.28 4.28-9.56 9.56-9.56 2.56 0 4.97 1 6.78 2.8a9.55 9.55 0 012.8 6.77c0 5.28-4.28 9.56-9.56 9.56zm5.26-7.17c-.29-.15-1.72-.85-1.99-.94-.27-.1-.47-.15-.67.15-.2.29-.77.94-.94 1.13-.17.2-.35.22-.64.07-.29-.15-1.23-.45-2.34-1.44-.86-.76-1.45-1.7-1.62-1.99-.17-.29-.02-.45.13-.59.14-.14.29-.34.44-.51.15-.17.2-.29.29-.49.1-.2.05-.37-.02-.52-.07-.15-.67-1.61-.92-2.21-.24-.58-.49-.5-.67-.51-.17 0-.37-.01-.57-.01s-.52.07-.8.37c-.27.29-1.05 1.02-1.05 2.48s1.08 2.88 1.23 3.07c.15.2 2.13 3.25 5.17 4.55.72.31 1.28.5 1.72.64.72.23 1.37.2 1.88.12.57-.08 1.72-.7 1.97-1.38.24-.67.24-1.24.17-1.38-.07-.15-.26-.24-.54-.39z"/>
                    </svg>
                    WhatsApp : Rafi Nabil
                </a>

                {{-- Email --}}
                <a href="mailto:rafinabil.toyotasignature@gmail.com?subject=Info%20Mobil%20Toyota&body=Halo%20Rafi%20Nabil%2C%0A%0ASaya%20tertarik%20dengan%20mobil%20Toyota-nya.%20Bisa%20dibantu%20info%20lebih%20lanjut%3F%0A%0ATerima%20kasih." target="_blank"
                class="italic flex items-center mb-2 hover:text-red-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 13.065l-11.74-8.77c.175-.148.394-.295.633-.295h22.214c.239 0 .458.147.633.295L12 13.065zm0 2.021l-12-8.965V20.25c0 .414.336.75.75.75h22.5c.414 0 .75-.336.75-.75V6.121l-12 8.965z"/>
                    </svg>
                    rafinabil.ToyotaSignature@gmail.com
                </a>

            </div>
        </div>
    </div>


    {{-- Google Maps Embed --}}
    <div class="mt-20 max-w-4xl mx-auto">
        <h2 class="text-xl font-semibold text-center mb-4">Lokasi Toyota Signature Motor</h2>
        <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
            <iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border:0;" loading="lazy" allowfullscreen src="https://maps.google.com/maps?q=Honda+Pekalongan+Motor&output=embed"></iframe>
        </div>
    </div>

@endsection

@push('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    .filter-link {
      transition: all 0.2s ease;
      min-width: 80px;
      text-align: center;
    }
    @media (max-width: 767px) {
      #filter-list {
        display: none !important;
      }
    }
  </style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterLinks = document.querySelectorAll('.filter-link');
    const carGridContainer = document.getElementById('car-grid-container');
    const loadingIndicator = document.getElementById('loading-indicator');
    const emptyState = document.getElementById('empty-state');

    // Check if mobile device
    const isMobile = () => window.innerWidth < 768;

    filterLinks.forEach(link => {
        link.addEventListener('click', async function(e) {
        if (isMobile()) {
            e.preventDefault();
            return;
        }

        e.preventDefault();
        const filterValue = this.dataset.filter;

        // Show loading
        carGridContainer.classList.add('opacity-50');
        loadingIndicator.classList.remove('hidden');
        emptyState.classList.add('hidden');

        try {
            const response = await fetch(`{{ route('mobil.filter') }}?jenis=${encodeURIComponent(filterValue)}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
            });

            if (!response.ok) throw new Error('Network response was not ok');

            const html = await response.text();
            carGridContainer.innerHTML = html;

            // Update active filter UI
            filterLinks.forEach(link => {
            link.classList.toggle('bg-red-600', link.dataset.filter === filterValue);
            link.classList.toggle('text-white', link.dataset.filter === filterValue);
            link.classList.toggle('border-red-600', link.dataset.filter === filterValue);
            link.classList.toggle('bg-gray-100', link.dataset.filter !== filterValue);
            link.classList.toggle('text-gray-700', link.dataset.filter !== filterValue);
            link.classList.toggle('border-gray-300', link.dataset.filter !== filterValue);
            });

            // Update URL without reload
            history.pushState({}, '', `{{ url()->current() }}?jenis=${encodeURIComponent(filterValue)}`);

            // Show empty state if no cars
            if (carGridContainer.querySelector('.bg-white') === null) {
            emptyState.classList.remove('hidden');
            }
        } catch (error) {
            console.error('Error:', error);
            carGridContainer.innerHTML = `
            <div class="col-span-full text-center py-10">
                <i class="fas fa-exclamation-triangle text-red-500 text-2xl mb-2"></i>
                <p class="text-red-500">Gagal memuat data. Silakan coba lagi.</p>
                <button onclick="window.location.reload()" class="mt-2 px-4 py-2 bg-red-100 text-red-600 rounded">
                Muat Ulang
                </button>
            </div>
            `;
        } finally {
            loadingIndicator.classList.add('hidden');
            carGridContainer.classList.remove('opacity-50');
        }
        });
    });

    // Handle browser back/forward
    window.addEventListener('popstate', function() {
        window.location.reload();
    });
});
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('a[href*="#contact-us"]').forEach(link => {
        link.addEventListener('click', function (e) {
            if (window.location.pathname === '{{ route('home', [], false) }}') {
                e.preventDefault();
                const target = document.querySelector('#contact-section');
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    });
});
</script>
</script>
@endpush
