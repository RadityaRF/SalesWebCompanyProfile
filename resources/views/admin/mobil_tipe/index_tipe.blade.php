@extends('admin.layouts.main')
@section('title', 'Daftar Tipe Mobil')
@section('content')
<div>
    <!-- Header dengan tombol tambah -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-3 sm:gap-0">
        <h2 class="text-2xl sm:text-2xl font-bold text-gray-800 mb-2 sm:mb-0">Daftar Tipe Mobil</h2>
        <a href="{{ route('admin.mobil_tipe.create') }}"
           class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 sm:px-4 sm:py-2 rounded-lg flex items-center transition-colors duration-200 text-sm sm:text-base w-full sm:w-auto justify-center mt-2 sm:mt-0">
            <i class="lni lni-plus mr-2"></i> Tambah Tipe Mobil
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Sukses!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="space-y-6">
        @php
            // Urutkan mobil berdasarkan harga mulai (ascending)
            $sortedMobils = $mobils->sortBy('harga_mulai');
        @endphp

        @forelse($sortedMobils as $mobil)
            @php
                // Urutkan tipe mobil berdasarkan harga (ascending)
                $sortedTipe = $mobil->tipeMobil->sortBy('harga_mobil');
            @endphp

            @if($sortedTipe->count() > 0)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Header kelompok mobil -->
                <div class="bg-gray-50 px-4 py-3 sm:px-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-800">
                        {{ $mobil->nama_mobil }}
                        <span class="text-sm font-normal text-gray-500 ml-2">(Mulai dari Rp {{ number_format($mobil->harga_mulai, 0, ',', '.') }})</span>
                    </h3>
                </div>

                <!-- Daftar tipe mobil dalam kelompok ini -->
                <div class="divide-y divide-gray-200">
                    @foreach($sortedTipe as $tipe)
                    <div class="p-4 sm:p-6 flex flex-col sm:flex-row justify-between hover:bg-gray-50">
                        <div class="flex flex-col sm:flex-row w-full">
                            <div class="w-full sm:w-1/3 mb-4 sm:mb-0 sm:mr-6 flex-shrink-0">
                                @if($tipe->gambar_mobil_tipe)
                                <img src="{{ asset('storage/' . $tipe->gambar_mobil_tipe) }}" alt="{{ $tipe->nama_tipe }}" class="w-full h-auto object-cover rounded-lg">
                                @else
                                <div class="w-full h-40 bg-gray-200 flex items-center justify-center rounded-lg">
                                    <span class="text-gray-500">Gambar tidak tersedia</span>
                                </div>
                                @endif
                            </div>
                            <div class="flex-grow">
                                <h4 class="text-md sm:text-lg font-bold text-gray-800 mb-1">{{ $tipe->nama_tipe }}</h4>
                                <span class="inline-block bg-gray-200 text-gray-700 text-xs font-semibold px-2 py-1 rounded-full mb-2">{{ $mobil->jenis_mobil }}</span>
                                <p class="text-sm text-gray-500 mb-1">Harga</p>
                                <p class="text-xl sm:text-2xl font-bold text-red-600 mb-3 sm:mb-4">Rp {{ number_format($tipe->harga_mobil, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="flex flex-row sm:flex-col gap-2 sm:ml-4 w-full sm:w-auto sm:items-end">
                            <a href="{{ route('admin.mobil_tipe.show', $tipe->id) }}" class="w-full sm:w-32">
                                <button class="w-full justify-center text-xs sm:text-sm p-2 bg-blue-100 text-blue-600 rounded-md hover:bg-blue-200 transition-colors flex items-center">
                                    <i class="lni lni-eye text-sm"></i> <span class="ml-1 font-semibold">Detail</span>
                                </button>
                            </a>
                            <a href="{{ route('admin.mobil_tipe.edit', $tipe->id) }}" class="w-full sm:w-32">
                                <button class="w-full justify-center text-xs sm:text-sm p-2 bg-yellow-100 text-yellow-600 rounded-md hover:bg-yellow-200 transition-colors flex items-center">
                                    <i class="lni lni-pencil-1 text-sm"></i> <span class="ml-1 font-semibold">Edit</span>
                                </button>
                            </a>
                            <form action="{{ route('admin.mobil_tipe.destroy', $tipe->id) }}" method="POST" onsubmit="return confirm('Hapus tipe mobil ini?')" class="w-full sm:w-32">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-full justify-center text-xs sm:text-sm p-2 bg-red-100 text-red-600 rounded-md hover:bg-red-200 transition-colors flex items-center">
                                    <i class="lni lni-trash-3 text-sm"></i> <span class="ml-1 font-semibold">Hapus</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        @empty
        <div class="bg-white rounded-lg shadow p-10 text-center">
            <p class="text-gray-500 text-sm">Tidak ada data tipe mobil.</p>
        </div>
        @endforelse
    </div>

    @if ($mobils->hasPages())
    <div class="mt-6">
        {{ $mobils->links() }}
    </div>
    @endif
</div>
@endsection
