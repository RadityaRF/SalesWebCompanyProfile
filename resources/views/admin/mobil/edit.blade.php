@extends('admin.layouts.main')
@section('title', 'Edit Mobil')
@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-bold mb-6 text-center">Edit Mobil</h2>
</div>
<div class="px-4 py-4 sm:px-6">
    @if ($errors->any())
    <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 text-red-700 rounded">
        <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li class="text-sm">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form id="form-edit-mobil" action="{{ route('admin.mobil.update', $mobil->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-base">
        @csrf
        @method('PUT')

        <!-- Nama Mobil -->
        <div>
            <label for="nama_mobil" class="block text-base font-medium text-gray-700">Nama Mobil</label>
            <input type="text" name="nama_mobil" id="nama_mobil"
                   class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md text-base focus:ring-red-500 focus:border-red-500 bg-white"
                   value="{{ old('nama_mobil', $mobil->nama_mobil) }}" required>
        </div>

        <!-- Jenis Mobil -->
        <div>
            <label for="jenis_mobil" class="block text-base font-medium text-gray-700">Jenis Mobil</label>
            <select name="jenis_mobil" id="jenis_mobil"
                    class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md text-base focus:ring-red-500 focus:border-red-500 bg-white"
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
            <label for="harga_mulai" class="block text-base font-medium text-gray-700">Harga Mulai</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 text-base">Rp</span>
                </div>
                <input type="text" name="harga_mulai" id="harga_mulai"
                       class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md text-base focus:ring-red-500 focus:border-red-500 bg-white"
                       value="{{ old('harga_mulai', $mobil->harga_mulai) }}">
            </div>
        </div>

        <!-- Highlight -->
        <div>
            <label for="highlight" class="block text-base font-medium text-gray-700">Highlight</label>
            <input type="text" name="highlight" id="highlight"
                   class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md text-base focus:ring-red-500 focus:border-red-500 bg-white"
                   value="{{ old('highlight', $mobil->highlight) }}">
        </div>

        <!-- Gambar Mobil -->
        <div>
            <label class="block text-base font-medium text-gray-700">Gambar Mobil</label>
            <div class="mt-1 flex items-center">
                <label for="gambar_mobil" class="flex-1 cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-red-500">
                    <span>Pilih Gambar</span>
                    <input type="file" name="gambar_mobil" id="gambar_mobil" class="sr-only">
                </label>
                <span class="ml-2 text-xs text-gray-500 truncate" id="gambar_mobil_label">Belum dipilih</span>
            </div>
            @if($mobil->gambar_mobil)
            <div class="mt-2 flex items-center" id="preview-gambar-mobil">
                <img src="{{ asset('storage/'.$mobil->gambar_mobil) }}" class="h-12 w-12 object-cover rounded">
                <button type="button" onclick="hapusGambarMobil()" class="ml-2 p-2 text-red-600 hover:text-red-800" title="Hapus gambar">
                    <i class="lni lni-trash-3 text-base"></i>
                </button>
            </div>
            @endif
        </div>

        <!-- Banner Mobil -->
        <div>
            <label class="block text-base font-medium text-gray-700">Banner Mobil</label>
            <div class="mt-1 flex items-center">
                <label for="banner_mobil" class="flex-1 cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-red-500">
                    <span>Pilih Banner</span>
                    <input type="file" name="banner_mobil" id="banner_mobil" class="sr-only">
                </label>
                <span class="ml-2 text-xs text-gray-500 truncate" id="banner_mobil_label">Belum dipilih</span>
            </div>
            @if($mobil->banner_mobil)
            <div class="mt-2 flex items-center" id="preview-banner-mobil">
                <img src="{{ asset('storage/'.$mobil->banner_mobil) }}" class="h-12 w-12 object-cover rounded">
                <button type="button" onclick="hapusBannerMobil()" class="ml-2 p-2 text-red-600 hover:text-red-800" title="Hapus banner">
                    <i class="lni lni-trash-3 text-base"></i>
                </button>
            </div>
            @endif
        </div>

        <!-- Deskripsi -->
        <div>
            <label for="deskripsi" class="block text-base font-medium text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="3"
                      class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md text-base focus:ring-red-500 focus:border-red-500 bg-white">{{ old('deskripsi', $mobil->deskripsi) }}</textarea>
        </div>

        <!-- Fitur Mobil -->
        <div>
            <label class="block text-base font-medium text-gray-700">Fitur Mobil</label>
            <div id="fitur-container" class="mt-2 space-y-2">
                @foreach($mobil->fiturMobil as $fitur)
                <div class="flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:space-x-2">
                    <input type="hidden" name="fitur_id[]" value="{{ $fitur->id }}">
                    <input type="text" name="fitur[]" placeholder="Nama Fitur"
                           class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-base focus:ring-red-500 focus:border-red-500"
                           value="{{ old('fitur.'.$loop->index, $fitur->fitur_mobil) }}">
                    <div class="flex items-center space-x-2">
                        <label class="flex-1 cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-red-500">
                            <span>Gambar</span>
                            <input type="file" name="gambar_fitur[]" class="sr-only">
                        </label>
                        @if($fitur->gambar_fitur)
                        <div class="flex items-center">
                            <img src="{{ asset('storage/'.$fitur->gambar_fitur) }}" class="h-8 w-8 object-cover rounded">
                            <label class="ml-1 inline-flex items-center">
                                <input type="checkbox" name="hapus_fitur[]" value="{{ $fitur->id }}" class="h-3 w-3 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                                <span class="ml-1 text-xs text-gray-600">Hapus</span>
                            </label>
                        </div>
                        @endif
                        <button type="button" onclick="removeFitur(this)" class="p-2 text-red-600 hover:text-red-800">
                            <i class="lni lni-trash-3 text-base"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
            <button type="button" onclick="addFitur()" class="mt-2 inline-flex items-center px-3 py-1.5 border border-transparent text-base font-medium rounded shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-1 focus:ring-red-500">
                <i class="lni lni-plus mr-1 text-base"></i> Tambah Fitur
            </button>
        </div>

        <!-- Warna Mobil -->
        <div>
            <label class="block text-base font-medium text-gray-700">Warna Mobil</label>
            <div id="warna-container" class="mt-2 space-y-2">
                @foreach($mobil->warnaMobil as $warna)
                <div class="flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:space-x-2">
                    <input type="hidden" name="warna_id[]" value="{{ $warna->id }}">
                    <input type="text" name="warna[]" placeholder="Nama Warna"
                           class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-base focus:ring-red-500 focus:border-red-500"
                           value="{{ old('warna.'.$loop->index, $warna->warna_mobil) }}">
                    <div class="flex items-center space-x-2">
                        <label class="flex-1 cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-red-500">
                            <span>Gambar</span>
                            <input type="file" name="gambar_warna[]" class="sr-only">
                        </label>
                        @if($warna->gambar_warna)
                        <div class="flex items-center">
                            <img src="{{ asset('storage/'.$warna->gambar_warna) }}" class="h-8 w-8 object-cover rounded">
                            <label class="ml-1 inline-flex items-center">
                                <input type="checkbox" name="hapus_warna[]" value="{{ $warna->id }}" class="h-3 w-3 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                                <span class="ml-1 text-xs text-gray-600">Hapus</span>
                            </label>
                        </div>
                        @endif
                        <button type="button" onclick="removeWarna(this)" class="p-2 text-red-600 hover:text-red-800">
                            <i class="lni lni-trash-3 text-base"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
            <button type="button" onclick="addWarna()" class="mt-2 inline-flex items-center px-3 py-1.5 border border-transparent text-base font-medium rounded shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-1 focus:ring-red-500">
                <i class="lni lni-plus mr-1 text-base"></i> Tambah Warna
            </button>
        </div>

        <!-- Tombol Aksi -->
        <div class="pt-4 flex flex-col space-y-3 sm:flex-row sm:space-y-0 sm:space-x-3 sm:justify-end">
            <a href="{{ route('admin.mobil.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-red-500">
                Kembali
            </a>
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-1 focus:ring-red-500">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Update file labels
    document.getElementById('gambar_mobil').addEventListener('change', function(e) {
        document.getElementById('gambar_mobil_label').textContent = e.target.files[0] ? e.target.files[0].name : 'Belum dipilih';
    });

    document.getElementById('banner_mobil').addEventListener('change', function(e) {
        document.getElementById('banner_mobil_label').textContent = e.target.files[0] ? e.target.files[0].name : 'Belum dipilih';
    });

    // Fungsi untuk menambah fitur
    function addFitur() {
        const container = document.getElementById('fitur-container');
        const div = document.createElement('div');
        div.className = 'flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:space-x-2';
        div.innerHTML = `
            <input type="text" name="fitur[]" placeholder="Nama Fitur"
                   class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-base focus:ring-red-500 focus:border-red-500">
            <div class="flex items-center space-x-2">
                <label class="flex-1 cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-red-500">
                    <span>Gambar</span>
                    <input type="file" name="gambar_fitur[]" class="sr-only">
                </label>
                <button type="button" onclick="removeFitur(this)" class="p-2 text-red-600 hover:text-red-800">
                    <i class="lni lni-trash-3 text-base"></i>
                </button>
            </div>
        `;
        container.appendChild(div);
    }

    // Fungsi untuk menghapus fitur
    function removeFitur(button) {
        const row = button.closest('.flex.flex-col');
        const fiturIdInput = row.querySelector('input[name="fitur_id[]"]');
        if (fiturIdInput) {
            // Data lama, tambahkan input hidden hapus_fitur[]
            const id = fiturIdInput.value;
            const hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'hapus_fitur[]';
            hidden.value = id;
            row.parentNode.insertBefore(hidden, row);
        }
        row.remove();
    }

    // Fungsi untuk menambah warna
    function addWarna() {
        const container = document.getElementById('warna-container');
        const div = document.createElement('div');
        div.className = 'flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:space-x-2';
        div.innerHTML = `
            <input type="text" name="warna[]" placeholder="Nama Warna"
                   class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-base focus:ring-red-500 focus:border-red-500">
            <div class="flex items-center space-x-2">
                <label class="flex-1 cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-red-500">
                    <span>Gambar</span>
                    <input type="file" name="gambar_warna[]" class="sr-only">
                </label>
                <button type="button" onclick="removeWarna(this)" class="p-2 text-red-600 hover:text-red-800">
                    <i class="lni lni-trash-3 text-base"></i>
                </button>
            </div>
        `;
        container.appendChild(div);
    }

    // Fungsi untuk menghapus warna
    function removeWarna(button) {
        const row = button.closest('.flex.flex-col');
        const warnaIdInput = row.querySelector('input[name="warna_id[]"]');
        if (warnaIdInput) {
            // Data lama, tambahkan input hidden hapus_warna[]
            const id = warnaIdInput.value;
            const hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'hapus_warna[]';
            hidden.value = id;
            row.parentNode.insertBefore(hidden, row);
        }
        row.remove();
    }

    function hapusGambarMobil() {
        let input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'hapus_gambar';
        input.value = '1';
        document.getElementById('form-edit-mobil').appendChild(input);
        document.getElementById('preview-gambar-mobil').remove();
    }
    function hapusBannerMobil() {
        let input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'hapus_banner';
        input.value = '1';
        document.getElementById('form-edit-mobil').appendChild(input);
        document.getElementById('preview-banner-mobil').remove();
    }
</script>
@endpush
@endsection
