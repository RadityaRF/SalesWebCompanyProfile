@extends('admin.layouts.main')
@section('title', 'Daftar Mobil')
@section('content')
<div>
    <!-- Header dengan tombol tambah -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Daftar Mobil</h2>
        <a href="{{ route('admin.mobil.create') }}"
           class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center transition-colors duration-200">
            <i class="lni lni-plus mr-2"></i> Tambah Mobil
        </a>
    </div>

    <!-- Tabel Mobil -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg shadow-md">
            <thead class="bg-[#2B2828] text-white">
                <tr>
                    <th class="py-3 px-4 text-left">Nama Mobil</th>
                    <th class="py-3 px-4 text-left">Jenis</th>
                    <th class="py-3 px-4 text-left">Harga Mulai</th>
                    <th class="py-3 px-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($mobils as $m)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <td class="py-4 px-4 font-semibold">{{ $m->nama_mobil }}</td>
                    <td class="py-4 px-4">{{ $m->jenis_mobil }}</td>
                    <td class="py-4 px-4">Rp {{ number_format($m->harga_mulai, 0, ',', '.') }}</td>
                    <td class="py-4 px-4 flex space-x-2">
                        <a href="{{ route('admin.mobil.show', $m->id) }}">
                            <button class="p-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors">
                                <i class="lni lni-eye"></i> Detail
                            </button>
                        </a>
                        <a href="{{ route('admin.mobil.edit', $m->id) }}">
                            <button class="p-2 bg-yellow-100 text-yellow-600 rounded-lg hover:bg-yellow-200 transition-colors">
                                <i class="lni lni-pencil-1"></i> Edit
                            </button>
                        </a>
                        <form action="{{ route('admin.mobil.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Hapus mobil ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors">
                                <i class="lni lni-trash-3"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $mobils->links() }}
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi DataTable
    $('#table-mobil').DataTable({
        "paging": false,
        "info": false,
        "language": {
            "search": "Cari:",
            "zeroRecords": "Data tidak ditemukan",
            "emptyTable": "Tidak ada data mobil"
        },
        "dom": '<"flex justify-between items-center mb-4"<"flex"f><"flex"l>>rt<"flex justify-between items-center mt-4"ip>'
    });
});
</script>
@endpush
@endsection
