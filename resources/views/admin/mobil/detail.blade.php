@extends('admin.layouts.main')
@section('title', 'Detail Mobil')
@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-semibold mb-6 text-center">{{ $mobil->nama_mobil }}</h2>

    <div class="bg-white rounded-lg shadow p-6 mb-6">

        <!-- Banner Mobil -->
        @if($mobil->banner_mobil)
            <div class="w-full overflow-hidden">
                <img src="{{ asset('storage/'.$mobil->banner_mobil) }}" alt="{{ $mobil->nama_mobil }} Banner" class="w-full h-auto mb-10"> <!-- Full width tanpa margin -->
            </div>
        @endif

        <!-- Gambar Mobil dan Detail Mobil -->
        <div class="flex">
            <!-- Gambar Mobil -->
            <div class="flex-shrink-0">
                @if($mobil->gambar_mobil)
                    <img src="{{ asset('storage/'.$mobil->gambar_mobil) }}" alt="{{ $mobil->nama_mobil }}" class="w-full max-w-md mx-auto">
                @endif
            </div>

            <!-- Detail Mobil -->
            <div class="ml-6 flex-1"> <!-- Menambahkan margin kiri untuk jarak -->
                <div class="mb-4 grid grid-cols-1 gap-4">
                    <div>
                        <span class="font-medium">Jenis Mobil:</span><br>
                        {{ $mobil->jenis_mobil }}
                    </div>
                    <div>
                        <span class="font-medium">Harga Mulai:</span><br>
                        Rp {{ number_format($mobil->harga_mulai, 0, ',', '.') }}
                    </div>
                    <div>
                        <span class="font-medium">Highlight:</span><br>
                        {{ $mobil->highlight }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Deskripsi Mobil -->
        <div class="mb-8">
            <div>
                <span class="font-medium">Deskripsi:</span><br>
                {{ $mobil->deskripsi }}
            </div>
        </div>

        <!-- Fitur Mobil -->
        <div class="mb-8">
            <h3 class="font-semibold mb-4">Fitur Mobil:</h3>
            <div class="grid grid-cols-2 gap-4">
                @foreach($mobil->fiturMobil as $fitur)
                    <div class="flex flex-col items-center">
                        <div class="relative w-full" style="padding-top: 56.25%;"> <!-- 16:9 aspect ratio -->
                            <img src="{{ asset('storage/'.$fitur->gambar_fitur_mobil) }}" alt="{{ $fitur->fitur_mobil }}" class="absolute top-0 left-0 w-full h-full object-cover">
                        </div>
                        <span class="text-center mt-2">{{ $fitur->fitur_mobil }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Warna Mobil -->
        <div class="mb-8">
            <h3 class="font-semibold mb-4">Warna Mobil:</h3>
            <div class="grid grid-cols-2 gap-4">
                @foreach($mobil->warnaMobil as $warna)
                    <div class="flex flex-col items-center">
                        <div class="flex items-center justify-center rounded overflow-hidden mb-2 bg-white" style="background-color: {{ $warna->warna_mobil }}; min-width: 140px; min-height: 140px;">
                            <img src="{{ asset('storage/'.$warna->gambar_warna_mobil) }}" alt="{{ $warna->warna_mobil }}" class="max-w-full max-h-40 object-contain" style="display: block;">
                        </div>
                        <span class="text-center mt-1">{{ $warna->warna_mobil }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-6">
            <a href="{{ route('admin.mobil.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition duration-200">Kembali ke Daftar Mobil</a>
        </div>
    </div>
</div>
@endsection
