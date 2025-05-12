@extends('admin.layouts.main')
@section('title', 'Tambah Mobil')
@section('content')
  <h2>Tambah Mobil</h2>

  <form action="{{ route('admin.mobil.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="nama_mobil" class="form-label">Nama Mobil</label>
      <input type="text" name="nama_mobil" id="nama_mobil" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="jenis_mobil" class="form-label">Jenis Mobil</label>
      <select name="jenis_mobil" id="jenis_mobil" class="form-select" required>
        <option value="City Car & Hatchback">City Car & Hatchback</option>
        <option value="MPV">MPV</option>
        <option value="Sedan">Sedan</option>
        <option value="Sports">Sports</option>
        <option value="SUV">SUV</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="gambar_mobil" class="form-label">Gambar Mobil</label>
      <input type="file" name="gambar_mobil" id="gambar_mobil" class="form-control">
    </div>

    <div class="mb-3">
      <label for="highlight" class="form-label">Highlight</label>
      <input type="text" name="highlight" id="highlight" class="form-control">
    </div>

    <div class="mb-3">
      <label for="deskripsi" class="form-label">Deskripsi</label>
      <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5"></textarea>
    </div>

    <div class="mb-3">
      <label for="harga_mulai" class="form-label">Harga Mulai</label>
      <input type="text" name="harga_mulai" id="harga_mulai" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('admin.mobil.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
@endsection
