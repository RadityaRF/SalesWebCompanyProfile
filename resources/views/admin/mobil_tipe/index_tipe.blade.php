@extends('admin.layouts.main')
@section('title', 'Daftar Tipe Mobil')
@section('content')
<div>
    <!-- Header dengan tombol tambah -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Daftar Tipe Mobil</h2>
        <a href="{{ route('admin.mobil_tipe.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center transition-colors duration-200">
            <i class="lni lni-plus mr-2"></i> Tambah Tipe Mobil
        </a>
    </div>

    <!-- Tabel Tipe Mobil -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg shadow-md">
            <thead class="bg-[#2B2828] text-white">
                <tr>
                    <th class="py-3 px-4 text-left">Nama Mobil</th>
                    <th class="py-3 px-4 text-left">Nama Tipe</th>
                    <th class="py-3 px-4 text-left">Jenis Mobil</th>
                    <th class="py-3 px-4 text-left">Harga Mobil</th>
                    <th class="py-3 px-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($mobils as $mobil)
                    @php
                        $sortedTipe = $mobil->tipeMobil->sortBy('harga_mobil');
                    @endphp
                    @foreach($sortedTipe as $tipe)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="py-4 px-4 font-semibold">{{ $mobil->nama_mobil }}</td>
                            <td class="py-4 px-4">{{ $tipe->nama_tipe }}</td>
                            <td class="py-4 px-4">{{ $mobil->jenis_mobil }}</td>
                            <td class="py-4 px-4">Rp {{ number_format($tipe->harga_mobil, 0, ',', '.') }}</td>
                            <td class="py-4 px-4 flex space-x-2">
                                <a href="{{ route('admin.mobil_tipe.show', $tipe->id) }}">
                                    <button class="p-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors">
                                        <i class="lni lni-eye"></i> Detail
                                    </button>
                                </a>
                                <a href="{{ route('admin.mobil_tipe.edit', $tipe->id) }}">
                                    <button class="p-2 bg-yellow-100 text-yellow-600 rounded-lg hover:bg-yellow-200 transition-colors">
                                        <i class="lni lni-pencil-1"></i> Edit
                                    </button>
                                </a>
                                <form action="{{ route('admin.mobil_tipe.destroy', $tipe->id) }}" method="POST" onsubmit="return confirm('Hapus tipe mobil ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors">
                                        <i class="lni lni-trash-3"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $mobils->links() }}
    </div>
</div>
@endsection
