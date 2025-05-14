@extends('layouts.main')
@section('title', $mobil->nama_mobil)
@section('content')
  <div class="mb-8">
    <h1 class="text-3xl font-bold">{{ $mobil->nama_mobil }}</h1>
    <p class="text-gray-600 italic">Jenis: {{ $mobil->jenis_mobil }}</p>
  </div>

  <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
    @foreach($mobil->tipeMobil as $tipe)
      <div class="bg-white rounded-xl shadow-md p-4 flex flex-col">
        <img src="{{ asset('storage/'.$tipe->gambar_mobil_tipe) }}"
             alt="{{ $tipe->nama_tipe }}"
             class="h-40 object-contain mb-4">
        <h3 class="font-semibold mb-1">{{ $tipe->nama_tipe }}</h3>
        <p class="text-red-600 font-bold mb-2">
          Rp {{ number_format($tipe->harga_mobil,0,',','.') }}
        </p>
        <h3>Spesifikasi:</h3>
        <ul class="list-disc list-inside text-sm text-gray-700 flex-1 mb-4">
          @foreach(explode("\n", $tipe->spesifikasi) as $baris)
            <li>{{ trim($baris) }}</li>
          @endforeach
        </ul>
        <a href="#"
           class="mt-auto py-2 rounded-lg bg-red-600 text-white text-center text-sm">
          Booking Now!
        </a>
      </div>
    @endforeach
  </div>
@endsection
