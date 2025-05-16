@extends('layouts.main')
@section('title', $mobil->nama_mobil)
@section('content')
<div class="container mx-auto my-8 px-4">
    <!-- Banner Mobil -->
    @if($mobil->banner_mobil)
        <div class="w-full overflow-hidden mb-4">
            <img src="{{ asset('storage/'.$mobil->banner_mobil) }}" alt="{{ $mobil->nama_mobil }} Banner" class="w-full h-auto mb-10">
        </div>
    @endif

    <h1 class="text-4xl font-bold text-center mb-6">{{ $mobil->nama_mobil }}</h1>

    <!-- Highlight -->
    <p class="text-red-600 font-bold my-2 text-center">{{ $mobil->highlight }}</p>

    <!-- Deskripsi -->
    <p class="text-gray-700 mb-4 text-center">{{ $mobil->deskripsi }}</p>

    <!-- Gambar Warna Mobil -->
    <div class="mb-8 items-center">
        <div class="overflow-x-auto">
            <div class="flex space-x-4">
                @foreach ($mobil->warnaMobil as $warna)
                    <div class="flex flex-col items-center">
                        <div class="relative w-40 h-40 mb-2">
                            <div class="absolute top-0 left-0 w-full h-full" style="background-color: {{ $warna->warna_mobil }};"></div>
                        </div>
                        <span class="text-center">{{ $warna->warna_mobil }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Gambar Fitur Mobil -->
    <div class="mb-8">
        <div class="flex flex-col space-y-4"> <!-- Menggunakan flex-col untuk menampilkan fitur secara vertikal -->
            @foreach($mobil->fiturMobil as $fitur)
                <div class="flex flex-col items-center">
                    <div class="relative w-full" style="padding-top: 56.25%;"><!-- 16:9 aspect ratio -->
                        <img src="{{ asset('storage/'.$fitur->gambar_fitur_mobil) }}" alt="{{ $fitur->fitur_mobil }}" class="absolute top-0 left-0 w-full h-full object-cover">
                    </div>
                </div>
            @endforeach
        </div>
    </div>

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
                <a href="https://wa.me"
                   class="mt-auto py-2 rounded-lg bg-red-600 text-white text-center text-sm">
                   Booking Now!
                </a>
            </div>
        @endforeach
    </div>

</div>
@endsection
