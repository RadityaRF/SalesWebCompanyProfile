@extends('admin.layouts.main')
@section('title', 'Detail Tipe Mobil')
@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-bold mb-6 text-center">{{ $tipe->nama_tipe }}</h2>

    <div class="bg-white rounded-lg shadow p-4 sm:p-6 mb-6">
        <!-- Gambar Tipe Mobil -->
        @if($tipe->gambar_mobil_tipe)
            <div class="w-full flex justify-center mb-4">
                <img src="{{ asset('storage/' . $tipe->gambar_mobil_tipe) }}" alt="{{ $tipe->nama_tipe }}" class="w-full max-w-xs sm:max-w-md rounded-lg object-cover">
            </div>
        @endif

        <!-- Detail Mobil Tipe -->
        <div class="mb-4">
            <span class="font-medium">Spesifikasi:</span><br>
            <ul class="list-disc list-inside mb-4 text-sm sm:text-base">
                @foreach(explode("\n", $tipe->spesifikasi) as $baris)
                    <li>{{ trim($baris) }}</li>
                @endforeach
            </ul>
        </div>
        <div class="mb-4">
            <span class="font-medium">Harga Mobil:</span><br>
            <span class="text-base sm:text-lg font-semibold">Rp {{ number_format($tipe->harga_mobil, 0, ',', '.') }}</span>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-6 flex">
            <a href="{{ route('admin.mobil_tipe.index_tipe') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition duration-200 w-full sm:w-auto text-center">Kembali ke Daftar Tipe Mobil</a>
        </div>
    </div>
</div>
@endsection
<style>
@media (max-width: 640px) {
    .bg-white {
        padding: 1rem !important;
    }
    h2.text-2xl {
        font-size: 1.25rem;
    }
    .rounded-lg, .rounded-md {
        border-radius: 0.75rem !important;
    }
}
</style>
