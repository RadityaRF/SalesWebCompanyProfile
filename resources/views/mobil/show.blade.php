@extends('layouts.main')
@section('title', $mobil->nama_mobil)

@push('styles')
{{-- Font Awesome untuk ikon jika belum ada di layout utama --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    /* Custom scrollbar untuk WebKit browsers */
    .custom-scrollbar::-webkit-scrollbar {
        height: 6px;
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #edf2f7; /* gray-200 */
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #e53e3e; /* red-600 */
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #c53030; /* red-700 */
    }

    /* For Firefox */
    .custom-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: #e53e3e #edf2f7;
    }

    .feature-image-container {
        position: relative;
        width: 100%;
        padding-top: 56.25%; /* 16:9 Aspect Ratio */
        background-color: #f7fafc; /* gray-100 as placeholder background */
    }
    .feature-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .color-option-card {
        width: 200px; /* Lebar kartu untuk opsi warna */
        flex-shrink: 0; /* Mencegah penyusutan saat di flex container */
    }
    .color-option-image-container {
        height: 120px; /* Tinggi tetap untuk gambar opsi warna */
        background-color: #e2e8f0; /* gray-300 */
    }

    .type-card-image {
        height: 160px; /* Sesuaikan tinggi gambar pada kartu tipe */
        object-fit: contain; /* Agar gambar tidak terpotong */
    }
</style>
@endpush

@section('content')
<div class="bg-gray-50"> {{-- Latar belakang umum untuk halaman --}}

    @if($mobil->banner_mobil)
        <section class="mb-6 md:mb-8">
            <div class="w-full max-h-[600px] overflow-hidden"> {{-- Batasi tinggi banner maks --}}
                <img src="{{ asset('storage/'.$mobil->banner_mobil) }}" alt="{{ $mobil->nama_mobil }} Banner" class="w-full h-full object-cover">
            </div>
        </section>
    @endif

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 pb-8 md:pb-12">

        <section class="text-center pt-6 pb-8 md:pt-8 md:pb-10">
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-800 mb-8">{{ $mobil->nama_mobil }}</h1>
            @if($mobil->highlight)
                <p class="text-lg sm:text-xl text-red-600 font-semibold mb-3">{{ $mobil->highlight }}</p>
            @endif
            @if($mobil->deskripsi)
                <p class="text-gray-700 text-sm sm:text-base max-w-3xl mx-auto leading-relaxed">{{ $mobil->deskripsi }}</p>
            @endif
        </section>

        @if($mobil->warnaMobil && $mobil->warnaMobil->count() > 0)
            <section class="mb-8 md:mb-12">
                <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Pilihan Warna</h2>
                <div class="flex overflow-x-auto space-x-4 pb-4 custom-scrollbar px-2 -mx-2">
                    @foreach ($mobil->warnaMobil as $warna)
                        <div class="color-option-card bg-white rounded-lg shadow-md overflow-hidden group">
                            <div class="color-option-image-container flex items-center justify-center">
                                <img src="{{ asset('storage/'.$warna->gambar_warna_mobil) }}" alt="{{ $warna->nama_warna ?? $warna->warna_mobil }}" class="w-full h-full object-cover">
                                {{-- Fallback jika tidak ada gambar spesifik per warna, gunakan div berwarna dari kode asli Anda --}}
                                <div class="w-full h-full" style="background-color: {{ $warna->hex_code_warna ?? $warna->warna_mobil }};">
                                     {{-- Jika ingin ada efek saat hover atau sbg placeholder, bisa tambahkan ikon atau teks di sini --}}
                                </div>
                            </div>
                            <div class="p-3 text-center">
                                <span class="text-sm font-medium text-gray-700">{{ $warna->nama_warna ?? $warna->warna_mobil }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if($mobil->fiturMobil && $mobil->fiturMobil->count() > 0)
            <section class="mb-8 md:mb-12">
                <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Fitur Unggulan</h2>
                <div class="space-y-6 md:space-y-8">
                    @foreach($mobil->fiturMobil as $fitur)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <div class="feature-image-container">
                                <img src="{{ asset('storage/'.$fitur->gambar_fitur_mobil) }}"
                                     alt="{{ $fitur->nama_fitur ?? $fitur->fitur_mobil ?? 'Fitur '.$mobil->nama_mobil }}"
                                     class="feature-image">
                            </div>
                            {{-- teks fitur dihilangkan, hanya gambar --}}
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Spesifikasi dan Tipe Mobil -->
        <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            @foreach($mobil->tipeMobil as $tipe)
                <div class="bg-white rounded-xl shadow-md p-4 flex flex-col">
                    <img src="{{ asset('storage/'.$tipe->gambar_mobil_tipe) }}"
                        alt="{{ $tipe->nama_tipe }}"
                        class="h-40 object-contain mb-4 rounded-lg">
                    <h3 class="font-bold mb-1 text-lg text-center">{{ $tipe->nama_tipe }}</h3>
                    <p class="text-2xl text-red-600 font-bold mb-2 text-center">
                        Rp {{ number_format($tipe->harga_mobil,0,',','.') }}
                    </p>
                    <h3>Spesifikasi:</h3>
                    <ul class="list-disc list-inside text-sm text-gray-700 flex-1 mb-4">
                    @foreach(explode("\n", $tipe->spesifikasi) as $baris)
                        <li>{{ trim($baris) }}</li>
                    @endforeach
                    </ul>
                    <a href="https://wa.me" class="mt-auto py-2 rounded-lg bg-red-600 text-white text-center text-sm">
                        Booking Now!
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Script tambahan jika diperlukan
    console.log("Halaman detail mobil {{ $mobil->nama_mobil }} telah dimuat.");
});
</script>
@endpush
