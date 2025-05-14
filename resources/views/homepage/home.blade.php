@extends('layouts.main')
@section('title', 'Honda Indonesia')
@section('content')
    {{-- Hero Banner --}}
    <div class="mb-8">
        <img src="{{ asset('images/banner-honda-en1.jpg') }}" alt="Honda e:N1 Electrify Your Journey"
            class="w-full h-auto object-cover shadow-md">
    </div>

    <h1 class="text-3xl font-bold text-center text-red-800 mb-6 md:mb-8">Pilih Mobil Honda untuk Anda!</h1>

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
</script>
@endpush
