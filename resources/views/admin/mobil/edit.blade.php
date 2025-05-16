@extends('admin.layouts.main')
@section('title', 'Edit Mobil')
@section('content')
    <h2 class="text-2xl font-semibold mb-6">Edit Mobil</h2>

    <form action="{{ route('admin.mobil.update', $mobil->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Menandakan metode PUT untuk update -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <!-- Input untuk Nama Mobil -->
            <div class="mb-8">
                <label for="nama_mobil" class="block text-lg font-medium text-gray-700">Nama Mobil</label>
                <input type="text" name="nama_mobil" id="nama_mobil" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-2" value="{{ old('nama_mobil', $mobil->nama_mobil) }}" required>
            </div>

            <!-- Input untuk Jenis Mobil -->
            <div class="mb-8">
                <label for="jenis_mobil" class="block text-lg font-medium text-gray-700">Jenis Mobil</label>
                <select name="jenis_mobil" id="jenis_mobil" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-2" required>
                    <option value="City Car & Hatchback" {{ $mobil->jenis_mobil == 'City Car & Hatchback' ? 'selected' : '' }}>City Car & Hatchback</option>
                    <option value="MPV" {{ $mobil->jenis_mobil == 'MPV' ? 'selected' : '' }}>MPV</option>
                    <option value="Sedan" {{ $mobil->jenis_mobil == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                    <option value="Sports" {{ $mobil->jenis_mobil == 'Sports' ? 'selected' : '' }}>Sports</option>
                    <option value="SUV" {{ $mobil->jenis_mobil == 'SUV' ? 'selected' : '' }}>SUV</option>
                </select>
            </div>

            <!-- Input Gambar Mobil -->
            <div class="mb-8">
                <label class="block text-lg font-medium text-gray-700 mb-2">Gambar Mobil</label>
                <div class="flex items-center">
                    <input type="file" name="gambar_mobil" id="gambar_mobil" class="hidden" onchange="updateFileName()" />
                    <label for="gambar_mobil" class="cursor-pointer bg-gray-200 text-gray-700 rounded-md py-2 px-4 border border-gray-400 hover:bg-gray-300">Pilih File</label>
                    <span class="ml-2 text-gray-600" id="fileName">Tidak ada file yang dipilih</span>
                </div>
                @if($mobil->gambar_mobil)
                    <div class="mt-2">
                        <img src="{{ asset('storage/'.$mobil->gambar_mobil) }}" alt="{{ $mobil->nama_mobil }}" class="img-fluid" style="max-width: 200px;">
                    </div>
                @endif
            </div>

            <!-- Input Gambar Banner Mobil -->
            <div class="mb-8">
                <label class="block text-lg font-medium text-gray-700 mb-2">Banner Mobil</label>
                <div class="flex items-center">
                    <input type="file" name="banner_mobil" id="banner_mobil" class="hidden" onchange="updateBannerFileName()" />
                    <label for="banner_mobil" class="cursor-pointer bg-gray-200 text-gray-700 rounded-md py-2 px-4 border border-gray-400 hover:bg-gray-300">Pilih Banner</label>
                    <span class="ml-2 text-gray-600" id="bannerFileName">Tidak ada file yang dipilih</span>
                </div>
                @if($mobil->banner_mobil)
                    <div class="mt-2">
                        <img src="{{ asset('storage/'.$mobil->banner_mobil) }}" alt="{{ $mobil->nama_mobil }} Banner" class="img-fluid" style="max-width: 200px;">
                    </div>
                @endif
            </div>

            <!-- Input Highlight -->
            <div class="mb-8">
                <label for="highlight" class="block text-lg font-medium text-gray-700">Highlight</label>
                <input type="text" name="highlight" id="highlight" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-2" value="{{ old('highlight', $mobil->highlight) }}">
            </div>

            <!-- Input Deskripsi -->
            <div class="mb-8">
                <label for="deskripsi" class="block text-lg font-medium text-gray-700">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-2" rows="5">{{ old('deskripsi', $mobil->deskripsi) }}</textarea>
            </div>

            <!-- Input Harga Mulai -->
            <div class="mb-8">
                <label for="harga_mulai" class="block text-lg font-medium text-gray-700">Harga Mulai</label>
                <input type="text" name="harga_mulai" id="harga_mulai" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-2" value="{{ old('harga_mulai', $mobil->harga_mulai) }}">
            </div>

            <!-- Input Fitur Mobil -->
            <div class="mb-8">
                <label class="block text-lg font-medium text-gray-700">Fitur Mobil</label>
                <div id="fitur-container">
                    @foreach ($mobil->fiturMobil as $key => $fitur)
                        <div class="flex items-center mb-2">
                            <input type="text" name="fitur[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-2" placeholder="Nama Fitur" value="{{ $fitur->fitur_mobil }}">
                            <input type="file" name="gambar_fitur[]" class="mt-1 block border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-2 ml-2">
                            <button type="button" class="ml-2 bg-red-600 text-white rounded-md p-2" onclick="removeFitur(this)">Hapus</button>
                            <!-- Tambahkan checkbox untuk menghapus fitur -->
                            <input type="checkbox" name="hapus_fitur[]" value="{{ $fitur->id }}" class="ml-2"> Hapus
                        </div>
                    @endforeach
                </div>
                <button type="button" class="mt-2 bg-blue-600 text-white rounded-md p-2" onclick="addFitur()">Tambah Fitur</button>
            </div>

            <!-- Input Warna Mobil -->
            <div class="mb-8">
                <label class="block text-lg font-medium text-gray-700">Warna Mobil</label>
                <div id="warna-container">
                    @foreach ($mobil->warnaMobil as $warna)
                        <div class="flex items-center mb-2">
                            <input type="text" name="warna[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-2" placeholder="Nama Warna" value="{{ $warna->warna_mobil }}">
                            <input type="file" name="gambar_warna[]" class="mt-1 block border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-2 ml-2">
                            <button type="button" class="ml-2 bg-red-600 text-white rounded-md p-2" onclick="removeWarna(this)">Hapus</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="mt-2 bg-blue-600 text-white rounded-md p-2" onclick="addWarna()">Tambah Warna</button>
            </div>

            <!-- Tombol Simpan dan Kembali -->
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

        function updateBannerFileName() {
            const bannerFileInput = document.getElementById('banner_mobil');
            const bannerFileNameDisplay = document.getElementById('bannerFileName');
            const file = bannerFileInput.files[0];
            bannerFileNameDisplay.textContent = file ? file.name : 'Tidak ada file yang dipilih';
        }

        function addFitur() {
            const container = document.getElementById('fitur-container');
            const newFitur = document.createElement('div');
            newFitur.className = 'flex items-center mb-2';
            newFitur.innerHTML = `
                <input type="text" name="fitur[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-2" placeholder="Nama Fitur">
                <input type="file" name="gambar_fitur[]" class="mt-1 block border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-2 ml-2">
                <button type="button" class="ml-2 bg-red-600 text-white rounded-md p-2" onclick="removeFitur(this)">Hapus</button>
            `;
            container.appendChild(newFitur);
        }

        function removeFitur(button) {
            button.parentElement.remove();
        }

        function addWarna() {
            const container = document.getElementById('warna-container');
            const newWarna = document.createElement('div');
            newWarna.className = 'flex items-center mb-2';
            newWarna.innerHTML = `
                <input type="text" name="warna[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-2" placeholder="Nama Warna">
                <input type="file" name="gambar_warna[]" class="mt-1 block border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-2 ml-2">
                <button type="button" class="ml-2 bg-red-600 text-white rounded-md p-2" onclick="removeWarna(this)">Hapus</button>
            `;
            container.appendChild(newWarna);
        }

        function removeWarna(button) {
            button.parentElement.remove();
        }
    </script>
    @endpush
@endsection
