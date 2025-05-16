@if(isset($mobils) && $mobils->count() > 0)
    @foreach($mobils as $mobil)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col">
        <div class="relative">
            <img src="{{ asset('storage/'.$mobil->gambar_mobil) }}"
                alt="{{ $mobil->nama_mobil }}"
                class="w-full h-48 object-contain p-4">
        </div>
        <div class="p-4 flex flex-col flex-grow">
            <h2 class="font-bold text-xl mb-1 text-center text-gray-800">{{ $mobil->nama_mobil }}</h2>
            @if($mobil->harga_mulai && is_numeric(str_replace('.', '', $mobil->harga_mulai)))
            <p class="text-sm text-gray-500 mb-0.5 text-center">Harga mulai</p>
            <p class="text-red-600 font-bold text-lg mb-4 text-center">
                Rp {{ number_format(floatval(str_replace('.', '', $mobil->harga_mulai)), 0, ',', '.') }}
            </p>
            @else
            <p class="text-sm text-gray-500 mb-0.5 text-center">Harga mulai</p>
            <p class="text-red-600 font-bold text-lg mb-4 text-center">
                HUBUNGI SALES
            </p>
            @endif
            <div class="mt-auto grid grid-cols-1 gap-2 pt-2 border-t border-gray-200">
            <a href="{{ route('mobil.show', $mobil->id) }}"
                class="w-full text-center py-2.5 rounded-md bg-red-600 text-white text-sm font-medium hover:bg-red-700 transition duration-150">
                Detail
            </a>
            <a href="https://wa.me"
                class="w-full text-center py-2.5 rounded-md border border-red-600 text-red-600 text-sm font-medium hover:bg-red-50 transition duration-150">
                Minta Penawaran
            </a>
            </div>
        </div>
        </div>
    @endforeach
@endif
