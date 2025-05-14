@extends('admin.layouts.main')
@section('title', 'Tambah Mobil')
@section('content')
    <h2 class="text-2xl font-semibold mb-6">Tambah Mobil</h2>

    <form action="{{ route('admin.mobil.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="mb-8">
                <label for="nama_mobil" class="block text-lg font-medium text-gray-700">Nama Mobil</label>
                <input type="text" name="nama_mobil" id="nama_mobil" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-2" required>
            </div>

            <div class="mb-8">
                <label for="jenis_mobil" class="block text-lg font-medium text-gray-700">Jenis Mobil</label>
                <select name="jenis_mobil" id="jenis_mobil" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-2" required>
                    <option value="City Car & Hatchback">City Car & Hatchback</option>
                    <option value="MPV">MPV</option>
                    <option value="Sedan">Sedan</option>
                    <option value="Sports">Sports</option>
                    <option value="SUV">SUV</option>
                </select>
            </div>

            <div class="mb-8">
                <label class="block text-lg font-medium text-gray-700 mb-2">Gambar Mobil</label>
                <div class="flex items-center">
                    <input type="file" name="gambar_mobil" id="gambar_mobil" class="hidden" onchange="updateFileName()" />
                    <label for="gambar_mobil" class="cursor-pointer bg-gray-200 text-gray-700 rounded-md py-2 px-4 border border-gray-400 hover:bg-gray-300">Pilih File</label>
                    <span class="ml-2 text-gray-600" id="fileName">Tidak ada file yang dipilih</span>
                </div>
            </div>

            <div class="mb-8">
                <label for="highlight" class="block text-lg font-medium text-gray-700">Highlight</label>
                <input type="text" name="highlight" id="highlight" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-2">
            </div>

            <div class="mb-8">
                <label for="deskripsi" class="block text-lg font-medium text-gray-700">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-2" rows="5"></textarea>
            </div>

            <div class="mb-8">
                <label for="harga_mulai" class="block text-lg font-medium text-gray-700">Harga Mulai</label>
                <input type="text" name="harga_mulai" id="harga_mulai" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-2">
            </div>

            <div class="flex justify-between">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-200">Simpan</button>
                <a href="{{ route('admin.mobil.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition duration-200">Kembali</a>
            </div>
        </div>
    </form>

    @push('scripts')
    <script>
        function updateFileName() {
            const fileInput = document.getElementById('gambar_mobil');
            const fileNameDisplay = document.getElementById('fileName');
            const file = fileInput.files[0];
            fileNameDisplay.textContent = file ? file.name : 'Tidak ada file yang dipilih';
        }
    </script>
    @endpush
@endsection
