@extends('layouts.app')

@section('title', 'Honda Indonesia')

@section('content')
  <h1 class="text-3xl font-bold text-red-600 mb-6">Pilih Mobil Honda untuk Anda!</h1>

  {{-- Filter jenis (All, SUV, Sedan, …) --}}
  <ul class="flex space-x-4 overflow-x-auto mb-8">
    @foreach(['All','City Car & Hatchback','MPV','Sedan','Sports','SUV'] as $j)
      <li>
        <a href="{{ route('home', ['jenis'=>$j]) }}"
           class="px-4 py-2 rounded-full text-sm font-medium
             {{ $filter === $j ? 'bg-red-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
          {{ $j }}
        </a>
      </li>
    @endforeach
  </ul>

  {{-- Grid kartu mobil (4 kolom desktop) --}}
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach($mobils as $mobil)
      <div class="bg-white rounded-xl shadow-md p-4 flex flex-col">
        <img src="{{ asset('storage/'.$mobil->gambar_mobil) }}"
             alt="{{ $mobil->nama_mobil }}"
             class="h-40 object-contain mb-4 mx-auto">
        <h2 class="font-semibold text-lg mb-1 text-center">{{ $mobil->nama_mobil }}</h2>
        <p class="text-xs text-gray-500 mb-1 text-center">harga mulai</p>
        <p class="text-red-600 font-bold mb-4 text-center">
          @if(is_numeric($mobil->harga_mulai))
            Rp {{ number_format($mobil->harga_mulai,0,',','.') }}
          @else
            HUBUNGI DEALER
          @endif
        </p>
        <div class="mt-auto flex space-x-2">
          <a href="{{ route('mobil.show', $mobil->id) }}"
             class="flex-1 text-center py-2 rounded-lg bg-red-600 text-white text-sm">
            Detail
          </a>
          <button disabled
             class="flex-1 text-center py-2 rounded-lg bg-gray-200 text-gray-400 text-sm">
            Minta Penawaran
          </button>
        </div>
      </div>
    @endforeach
  </div>
@endsection
