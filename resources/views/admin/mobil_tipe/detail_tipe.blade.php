@extends('admin.layouts.main')
@section('title', 'Detail Tipe Mobil')
@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-semibold mb-6 text-center">{{ $tipe->nama_tipe }}</h2>

    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <!-- Gambar Tipe Mobil -->
        @if($tipe->gambar_mobil_tipe)
            <img src="{{ asset('storage/' . $tipe->gambar_mobil_tipe) }}" alt="{{ $tipe->nama_tipe }}" class="w-full max-w-md center mx-auto mb-4">
        @endif

        <!-- Detail Mobil Tipe -->
        <div class="mb-4">
            <span class="font-medium">Spesifikasi:</span><br>
            <span>
                <ul class="list-disc list-inside flex-1 mb-4">
                    @foreach(explode("\n", $tipe->spesifikasi) as $baris)
                <li>{{ trim($baris) }}</li>
                @endforeach
            </span>
        </ul>
        </div>
        <div class="mb-4">
            <span class="font-medium">Harga Mobil:</span><br>
            <span>Rp {{ number_format($tipe->harga_mobil, 0, ',', '.') }}</span>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-6">
            <a href="{{ route('admin.mobil_tipe.index_tipe') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition duration-200">Kembali ke Daftar Tipe Mobil</a>
        </div>
    </div>
</div>
@endsection
