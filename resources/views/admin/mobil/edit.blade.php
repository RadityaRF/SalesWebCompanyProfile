@extends('admin.layouts.main')
@section('title', 'Edit Mobil')
@section('content')
  <h2>Edit Mobil</h2>

  <!-- Form untuk mengedit data mobil -->
  <form action="{{ route('admin.mobil.update', $mobil->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- Menandakan metode PUT untuk update -->

    <div class="mb-3">
      <label for="nama_mobil" class="form-label">Nama Mobil</label>
      <input type="text" name="nama_mobil" id="nama_mobil" class="form-control" value="{{ old('nama_mobil', $mobil->nama_mobil) }}" required>
    </div>

    <div class="mb-3">
      <label for="jenis_mobil" class="form-label">Jenis Mobil</label>
      <select name="jenis_mobil" id="jenis_mobil" class="form-select" required>
        <option value="City Car & Hatchback" {{ $mobil->jenis_mobil == 'City Car & Hatchback' ? 'selected' : '' }}>City Car & Hatchback</option>
        <option value="MPV" {{ $mobil->jenis_mobil == 'MPV' ? 'selected' : '' }}>MPV</option>
        <option value="Sedan" {{ $mobil->jenis_mobil == 'Sedan' ? 'selected' : '' }}>Sedan</option>
        <option value="Sports" {{ $mobil->jenis_mobil == 'Sports' ? 'selected' : '' }}>Sports</option>
        <option value="SUV" {{ $mobil->jenis_mobil == 'SUV' ? 'selected' : '' }}>SUV</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="gambar_mobil" class="form-label">Gambar Mobil</label>
      <input type="file" name="gambar_mobil" id="gambar_mobil" class="form-control">
      <!-- Menampilkan gambar lama jika ada -->
      @if($mobil->gambar_mobil)
        <div class="mt-2">
          <img src="{{ asset('storage/'.$mobil->gambar_mobil) }}" alt="{{ $mobil->nama_mobil }}" class="img-fluid" style="max-width: 200px;">
        </div>
      @endif
    </div>

    <div class="mb-3">
      <label for="highlight" class="form-label">Highlight</label>
      <input type="text" name="highlight" id="highlight" class="form-control" value="{{ old('highlight', $mobil->highlight) }}">
    </div>

    <div class="mb-3">
      <label for="deskripsi" class="form-label">Deskripsi</label>
      <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5">{{ old('deskripsi', $mobil->deskripsi) }}</textarea>
    </div>

    <div class="mb-3">
      <label for="harga_mulai" class="form-label">Harga Mulai</label>
      <input type="text" name="harga_mulai" id="harga_mulai" class="form-control" value="{{ old('harga_mulai', $mobil->harga_mulai) }}">
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('admin.mobil.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
@endsection
