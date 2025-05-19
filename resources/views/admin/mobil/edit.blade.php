<!-- views/admin/mobil/edit.blade.php -->
@extends('admin.layouts.main')
@section('title', 'Edit Mobil')
@section('content')
<div class="px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <h2 class="text-xl sm:text-2xl font-semibold text-gray-800">Edit Mobil</h2>
    </div>

    @if ($errors->any())
    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.mobil.update', $mobil->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-6">
        @csrf
        @method('PUT')

        <!-- Grid Layout untuk Form -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Kolom Kiri -->
            <div class="space-y-6">
                <!-- Nama Mobil -->
                <div>
                    <label for="nama_mobil" class="block text-sm font-medium text-gray-700 mb-1">Nama Mobil</label>
                    <input type="text" name="nama_mobil" id="nama_mobil"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500"
                           value="{{ old('nama_mobil', $mobil->nama_mobil) }}" required>
                </div>

                <!-- Jenis Mobil -->
                <div>
                    <label for="jenis_mobil" class="block text-sm font-medium text-gray-700 mb-1">Jenis Mobil</label>
                    <select name="jenis_mobil" id="jenis_mobil"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500"
                            required>
                        <option value="">Pilih Jenis Mobil</option>
                        <option value="City Car & Hatchback" {{ old('jenis_mobil', $mobil->jenis_mobil) == 'City Car & Hatchback' ? 'selected' : '' }}>City Car & Hatchback</option>
                        <option value="MPV" {{ old('jenis_mobil', $mobil->jenis_mobil) == 'MPV' ? 'selected' : '' }}>MPV</option>
                        <option value="Sedan" {{ old('jenis_mobil', $mobil->jenis_mobil) == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                        <option value="Sports" {{ old('jenis_mobil', $mobil->jenis_mobil) == 'Sports' ? 'selected' : '' }}>Sports</option>
                        <option value="SUV" {{ old('jenis_mobil', $mobil->jenis_mobil) == 'SUV' ? 'selected' : '' }}>SUV</option>
                    </select>
                </div>

                <!-- Harga Mulai -->
                <div>
                    <label for="harga_mulai" class="block text-sm font-medium text-gray-700 mb-1">Harga Mulai</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500">Rp</span>
                        </div>
                        <input type="text" name="harga_mulai" id="harga_mulai"
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500"
                               value="{{ old('harga_mulai', $mobil->harga_mulai) }}">
                    </div>
                </div>

                <!-- Highlight -->
                <div>
                    <label for="highlight" class="block text-sm font-medium text-gray-700 mb-1">Highlight</label>
                    <input type="text" name="highlight" id="highlight"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500"
                           value="{{ old('highlight', $mobil->highlight) }}">
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="space-y-6">
                <!-- Gambar Mobil -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Mobil</label>
                    <div class="mt-1 flex items-center">
                        <label for="gambar_mobil" class="cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Pilih Gambar
                        </label>
                        <span class="ml-2 text-sm text-gray-500" id="gambar_mobil_label">Tidak ada file dipilih</span>
                        <input type="file" name="gambar_mobil" id="gambar_mobil" class="hidden" onchange="document.getElementById('gambar_mobil_label').textContent = this.files[0] ? this.files[0].name : 'Tidak ada file dipilih'">
                    </div>
                    @if($mobil->gambar_mobil)
                    <div class="mt-2">
                        <img src="{{ asset('storage/'.$mobil->gambar_mobil) }}" alt="{{ $mobil->nama_mobil }}" class="h-32 object-contain">
                        <label class="inline-flex items-center mt-2">
                            <input type="checkbox" name="hapus_gambar" class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-600">Hapus gambar ini</span>
                        </label>
                    </div>
                    @endif
                </div>

                <!-- Banner Mobil -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Banner Mobil</label>
                    <div class="mt-1 flex items-center">
                        <label for="banner_mobil" class="cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Pilih Banner
                        </label>
                        <span class="ml-2 text-sm text-gray-500" id="banner_mobil_label">Tidak ada file dipilih</span>
                        <input type="file" name="banner_mobil" id="banner_mobil" class="hidden" onchange="document.getElementById('banner_mobil_label').textContent = this.files[0] ? this.files[0].name : 'Tidak ada file dipilih'">
                    </div>
                    @if($mobil->banner_mobil)
                    <div class="mt-2">
                        <img src="{{ asset('storage/'.$mobil->banner_mobil) }}" alt="{{ $mobil->nama_mobil }} Banner" class="h-32 object-contain">
                        <label class="inline-flex items-center mt-2">
                            <input type="checkbox" name="hapus_banner" class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-600">Hapus banner ini</span>
                        </label>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Deskripsi (Full Width) -->
        <div class="mt-6">
            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4"
                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500">{{ old('deskripsi', $mobil->deskripsi) }}</textarea>
        </div>

        <!-- Fitur Mobil -->
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Fitur Mobil</label>
            <div id="fitur-container" class="space-y-2">
                @foreach($mobil->fiturMobil as $fitur)
                <div class="flex flex-col sm:flex-row gap-2">
                    <input type="hidden" name="fitur_id[]" value="{{ $fitur->id }}">
                    <input type="text" name="fitur[]" placeholder="Nama Fitur"
                           class="flex-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500"
                           value="{{ old('fitur.'.$loop->index, $fitur->fitur_mobil) }}">
                    <div class="flex items-center gap-2">
                        <input type="file" name="gambar_fitur[]"
                               class="px-3 py-1.5 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500">
                        @if($fitur->gambar_fitur)
                        <div class="flex items-center">
                            <img src="{{ asset('storage/'.$fitur->gambar_fitur) }}" class="h-8 w-8 object-cover rounded">
                            <label class="inline-flex items-center ml-2">
                                <input type="checkbox" name="hapus_fitur[]" value="{{ $fitur->id }}" class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                                <span class="ml-1 text-xs text-gray-600">Hapus</span>
                            </label>
                        </div>
                        @endif
                        <button type="button" onclick="removeFitur(this)" class="text-red-600 hover:text-red-800">
                            <i class="lni lni-trash-can text-lg"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
            <button type="button" onclick="addFitur()" class="mt-2 inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                <i class="lni lni-plus mr-1"></i> Tambah Fitur
            </button>
        </div>

        <!-- Warna Mobil -->
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Warna Mobil</label>
            <div id="warna-container" class="space-y-2">
                @foreach($mobil->warnaMobil as $warna)
                <div class="flex flex-col sm:flex-row gap-2">
                    <input type="hidden" name="warna_id[]" value="{{ $warna->id }}">
                    <input type="text" name="warna[]" placeholder="Nama Warna"
                           class="flex-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500"
                           value="{{ old('warna.'.$loop->index, $warna->warna_mobil) }}">
                    <div class="flex items-center gap-2">
                        <input type="file" name="gambar_warna[]"
                               class="px-3 py-1.5 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500">
                        @if($warna->gambar_warna)
                        <div class="flex items-center">
                            <img src="{{ asset('storage/'.$warna->gambar_warna) }}" class="h-8 w-8 object-cover rounded">
                            <label class="inline-flex items-center ml-2">
                                <input type="checkbox" name="hapus_warna[]" value="{{ $warna->id }}" class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                                <span class="ml-1 text-xs text-gray-600">Hapus</span>
                            </label>
                        </div>
                        @endif
                        <button type="button" onclick="removeWarna(this)" class="text-red-600 hover:text-red-800">
                            <i class="lni lni-trash-can text-lg"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
            <button type="button" onclick="addWarna()" class="mt-2 inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                <i class="lni lni-plus mr-1"></i> Tambah Warna
            </button>
        </div>

        <!-- Tombol Aksi -->
        <div class="mt-8 flex flex-col sm:flex-row justify-end gap-3">
            <a href="{{ route('admin.mobil.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                Kembali
            </a>
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Fungsi untuk menambah fitur
    function addFitur() {
        const container = document.getElementById('fitur-container');
        const div = document.createElement('div');
        div.className = 'flex flex-col sm:flex-row gap-2';
        div.innerHTML = `
            <input type="text" name="fitur[]" placeholder="Nama Fitur"
                   class="flex-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500">
            <div class="flex items-center gap-2">
                <input type="file" name="gambar_fitur[]"
                       class="px-3 py-1.5 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500">
                <button type="button" onclick="removeFitur(this)" class="text-red-600 hover:text-red-800">
                    <i class="lni lni-trash-can text-lg"></i>
                </button>
            </div>
        `;
        container.appendChild(div);
    }

    // Fungsi untuk menghapus fitur
    function removeFitur(button) {
        button.closest('.flex.flex-col').remove();
    }

    // Fungsi untuk menambah warna
    function addWarna() {
        const container = document.getElementById('warna-container');
        const div = document.createElement('div');
        div.className = 'flex flex-col sm:flex-row gap-2';
        div.innerHTML = `
            <input type="text" name="warna[]" placeholder="Nama Warna"
                   class="flex-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500">
            <div class="flex items-center gap-2">
                <input type="file" name="gambar_warna[]"
                       class="px-3 py-1.5 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500">
                <button type="button" onclick="removeWarna(this)" class="text-red-600 hover:text-red-800">
                    <i class="lni lni-trash-can text-lg"></i>
                </button>
            </div>
        `;
        container.appendChild(div);
    }

    // Fungsi untuk menghapus warna
    function removeWarna(button) {
        button.closest('.flex.flex-col').remove();
    }
</script>
@endpush
@endsection
