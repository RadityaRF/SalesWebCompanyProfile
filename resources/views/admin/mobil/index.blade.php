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
                        <button class="p-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $m->id }}">
                            <i class="lni lni-eye"></i>
                        </button>
                        <a href="{{ route('admin.mobil.edit', $m->id) }}">
                            <button class="p-2 bg-yellow-100 text-yellow-600 rounded-lg hover:bg-yellow-200 transition-colors">
                                <i class="lni lni-pencil-1"></i>
                            </button>
                        </a>
                        <form action="{{ route('admin.mobil.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Hapus mobil ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors">
                                <i class="lni lni-trash-3"></i>
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

<!-- Modal Detail -->
@foreach($mobils as $m)
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
     id="modalDetail{{ $m->id }}" tabindex="-1" aria-labelledby="modalDetailLabel{{ $m->id }}" aria-hidden="true">
    <div class="modal-dialog relative w-auto pointer-events-none max-w-3xl mx-auto my-12">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-lg outline-none text-current">
            <div class="modal-header flex items-center justify-between p-4 border-b border-gray-200 rounded-t-lg bg-[#2B2828] text-white">
                <h5 class="text-xl font-medium" id="modalDetailLabel{{ $m->id }}">
                    {{ $m->nama_mobil }}
                </h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <i class="lni lni-close"></i>
                </button>
            </div>
            <div class="modal-body p-6">
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-gray-100 rounded-lg p-4 flex items-center justify-center">
                        <img src="{{ asset('storage/'.$m->gambar_mobil) }}" alt="{{ $m->nama_mobil }}"
                             class="max-h-64 object-contain rounded-lg">
                    </div>
                    <div class="space-y-4">
                        <div>
                            <h4 class="font-semibold text-gray-800">Detail Mobil</h4>
                            <div class="mt-2 space-y-2">
                                <p><span class="font-medium">Jenis:</span> {{ $m->jenis_mobil }}</p>
                                <p><span class="font-medium">Harga:</span> Rp {{ number_format($m->harga_mulai,0,',','.') }}</p>
                                <p><span class="font-medium">Highlight:</span> {{ $m->highlight }}</p>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Deskripsi</h4>
                            <p class="mt-2 text-gray-600">{{ $m->deskripsi }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer flex justify-end p-4 border-t border-gray-200 rounded-b-lg">
                <button type="button" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors"
                        data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

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
