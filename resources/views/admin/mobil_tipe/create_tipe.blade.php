@extends('admin.layouts.main')
@section('title', 'Tambah Tipe Mobil')
@section('content')
    <h2 class="text-2xl font-semibold mb-6">Tambah Tipe Mobil</h2>

    <form action="{{ route('admin.mobil_tipe.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <!-- Input untuk Nama Mobil -->
            <div class="mb-8">
                <label for="id_mobil" class="block text-lg font-medium text-gray-700">Nama Mobil</label>
                <select name="id_mobil" id="id_mobil" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-2" required>
                    <option value="">Pilih Mobil</option>
                    @foreach($mobils as $mobil)
                        <option value="{{ $mobil->id }}">{{ $mobil->nama_mobil }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Input untuk Nama Tipe -->
            <div class="mb-8">
                <label for="nama_tipe" class="block text-lg font-medium text-gray-700">Nama Tipe</label>
                <input type="text" name="nama_tipe" id="nama_tipe" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-2" required>
            </div>

            <!-- Input untuk Spesifikasi -->
            <div class="mb-8">
                <label for="spesifikasi" class="block text-lg font-medium text-gray-700">Spesifikasi</label>
                <textarea name="spesifikasi" id="spesifikasi" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-2" rows="5"></textarea>
            </div>

            <!-- Input Gambar Mobil Tipe -->
            <div class="mb-8">
                <label class="block text-lg font-medium text-gray-700 mb-2">Gambar Mobil Tipe</label>
                <div class="flex items-center">
                    <input type="file" name="gambar_mobil_tipe" id="gambar_mobil_tipe" class="hidden" onchange="updateFileName()" />
                    <label for="gambar_mobil_tipe" class="cursor-pointer bg-gray-200 text-gray-700 rounded-md py-2 px-4 border border-gray-400 hover:bg-gray-300">Pilih File</label>
                    <span class="ml-2 text-gray-600" id="fileName">Tidak ada file yang dipilih</span>
                </div>
            </div>

            <!-- Input Harga Mobil -->
            <div class="mb-8">
                <label for="harga_mobil" class="block text-lg font-medium text-gray-700">Harga Mobil</label>
                <input type="number" name="harga_mobil" id="harga_mobil" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-2" required>
            </div>

            <!-- Tombol Simpan dan Kembali -->
            <div class="flex justify-between">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-200">Simpan</button>
                <a href="{{ route('admin.mobil_tipe.index_tipe') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition duration-200">Kembali</a>
            </div>
        </div>
    </form>

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
