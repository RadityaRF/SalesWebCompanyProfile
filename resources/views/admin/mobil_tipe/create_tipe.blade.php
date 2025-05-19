@extends('admin.layouts.main')
@section('title', 'Tambah Tipe Mobil')
@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-bold mb-6 text-center">Tambah Tipe Mobil</h2>
</div>
<div class="px-4 py-4 sm:px-6">
    <form action="{{ route('admin.mobil_tipe.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-base">
        @csrf
        <!-- Nama Mobil -->
        <div>
            <label for="id_mobil" class="block text-base font-medium text-gray-700">Nama Mobil</label>
            <select name="id_mobil" id="id_mobil" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md text-base focus:ring-red-500 focus:border-red-500 bg-white" required>
                <option value="">Pilih Mobil</option>
                @foreach($mobils as $mobil)
                    <option value="{{ $mobil->id }}">{{ $mobil->nama_mobil }}</option>
                @endforeach
            </select>
        </div>
        <!-- Nama Tipe -->
        <div>
            <label for="nama_tipe" class="block text-base font-medium text-gray-700">Nama Tipe</label>
            <input type="text" name="nama_tipe" id="nama_tipe" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md text-base focus:ring-red-500 focus:border-red-500 bg-white" required>
        </div>
        <!-- Spesifikasi -->
        <div>
            <label for="spesifikasi" class="block text-base font-medium text-gray-700">Spesifikasi</label>
            <textarea name="spesifikasi" id="spesifikasi" rows="5" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md text-base focus:ring-red-500 focus:border-red-500 bg-white"></textarea>
        </div>
        <!-- Gambar Tipe Mobil -->
        <div>
            <label class="block text-base font-medium text-gray-700">Gambar Tipe Mobil</label>
            <div class="mt-1 flex items-center">
                <label for="gambar_mobil_tipe" class="flex-1 cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-red-500">
                    <span>Pilih File</span>
                    <input type="file" name="gambar_mobil_tipe" id="gambar_mobil_tipe" class="sr-only" onchange="updateFileName()">
                </label>
                <span class="ml-2 text-xs text-gray-500 truncate" id="fileName">Tidak ada file yang dipilih</span>
            </div>
        </div>
        <!-- Harga Mobil -->
        <div>
            <label for="harga_mobil" class="block text-base font-medium text-gray-700">Harga Mobil</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 text-base">Rp</span>
                </div>
                <input type="number" name="harga_mobil" id="harga_mobil" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md text-base focus:ring-red-500 focus:border-red-500 bg-white" required>
            </div>
        </div>
        <!-- Tombol Aksi -->
        <div class="pt-4 flex flex-col space-y-3 sm:flex-row sm:space-y-0 sm:space-x-3 sm:justify-end">
            <a href="{{ route('admin.mobil_tipe.index_tipe') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-red-500">
                Kembali
            </a>
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-1 focus:ring-red-500">
                Simpan Tipe Mobil
            </button>
        </div>
    </form>
</div>
@push('scripts')
<script>
    function updateFileName() {
        const fileInput = document.getElementById('gambar_mobil_tipe');
        const fileNameDisplay = document.getElementById('fileName');
        const file = fileInput.files[0];
        fileNameDisplay.textContent = file ? file.name : 'Tidak ada file yang dipilih';
    }
</script>
@endpush
@endsection
