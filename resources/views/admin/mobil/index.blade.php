@extends('admin.layouts.main')
@section('title', 'Daftar Mobil')
@section('content')
<div>
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-3 sm:gap-0">
        <h2 class="text-2xl sm:text-2xl font-bold text-gray-800 mb-2 sm:mb-0">Daftar Mobil</h2>
        <a href="{{ route('admin.mobil.create') }}"
           class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 sm:px-4 sm:py-2 rounded-lg flex items-center transition-colors duration-200 text-sm sm:text-base w-full sm:w-auto justify-center mt-2 sm:mt-0">
            <i class="lni lni-plus mr-2"></i> Tambah Mobil
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Sukses!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        @forelse($mobils as $m)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 sm:p-6 flex flex-col sm:flex-row justify-between">
                <div class="flex flex-col sm:flex-row w-full">
                    <div class="w-full sm:w-1/3 mb-4 sm:mb-0 sm:mr-6 flex-shrink-0">
                        @if($m->gambar_mobil)
                        <img src="{{ asset('storage/' . $m->gambar_mobil) }}" alt="{{ $m->nama_mobil }}" class="w-full h-auto object-cover rounded-lg">
                        @else
                        <div class="w-full h-40 bg-gray-200 flex items-center justify-center rounded-lg">
                            <span class="text-gray-500">Gambar tidak tersedia</span>
                        </div>
                        @endif
                    </div>
                    <div class="flex-grow">
                        <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-1">{{ $m->nama_mobil }}</h3>
                        <span class="inline-block bg-gray-200 text-gray-700 text-xs font-semibold px-2 py-1 rounded-full mb-2">{{ $m->jenis_mobil }}</span>
                        <p class="text-sm text-gray-500 mb-1">Harga Mulai</p>
                        <p class="text-xl sm:text-2xl font-bold text-red-600 mb-3 sm:mb-4">Rp {{ number_format($m->harga_mulai, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="flex flex-row sm:flex-col gap-2 sm:ml-4 w-full sm:w-auto sm:items-end">
                    <a href="{{ route('admin.mobil.show', $m->id) }}" class="w-full sm:w-32">
                        <button class="w-full justify-center text-xs sm:text-sm p-2 bg-blue-100 text-blue-600 rounded-md hover:bg-blue-200 transition-colors flex items-center">
                            <i class="lni lni-eye text-sm"></i> <span class="ml-1 font-semibold">Detail</span>
                        </button>
                    </a>
                    <a href="{{ route('admin.mobil.edit', $m->id) }}" class="w-full sm:w-32">
                        <button class="w-full justify-center text-xs sm:text-sm p-2 bg-yellow-100 text-yellow-600 rounded-md hover:bg-yellow-200 transition-colors flex items-center">
                            <i class="lni lni-pencil-1 text-sm"></i> <span class="ml-1 font-semibold">Edit</span>
                        </button>
                    </a>
                    <form action="{{ route('admin.mobil.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Hapus mobil ini?')" class="w-full sm:w-32">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-full justify-center text-xs sm:text-sm p-2 bg-red-100 text-red-600 rounded-md hover:bg-red-200 transition-colors flex items-center">
                            <i class="lni lni-trash-3 text-sm"></i> <span class="ml-1 font-semibold">Hapus</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-1 md:col-span-1">
            <div class="bg-white rounded-lg shadow p-10 text-center">
                <p class="text-gray-500 text-sm">Tidak ada data mobil.</p>
            </div>
        </div>
        @endforelse
    </div>

    @if ($mobils->hasPages())
    <div class="mt-6">
        {{ $mobils->links() }}
    </div>
    @endif
</div>

@push('scripts')
{{--
    Skrip DataTable di-comment karena Anda menggunakan paginasi Laravel ($mobils->links()).
    Jika Anda ingin menggunakan DataTables, pastikan:
    1. jQuery dan DataTables JS/CSS sudah dimuat.
    2. Tabel HTML memiliki ID yang sesuai (misal: id="table-mobil").
    3. Paginasi DataTables mungkin perlu dikonfigurasi agar tidak bentrok dengan paginasi Laravel.
--}}
{{--
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Contoh inisialisasi DataTable jika Anda memutuskan untuk menggunakannya
    // $('#table-mobil-yang-sesuai-id-nya').DataTable({
    //     "paging": true, // Sesuaikan dengan kebutuhan
    //     "info": true,   // Sesuaikan dengan kebutuhan
    //     "language": {
    //         "search": "Cari:",
    //         "zeroRecords": "Data tidak ditemukan",
    //         "emptyTable": "Tidak ada data mobil"
    //     }
    // });
});
</script>
--}}
@endpush
@endsection
