@extends('admin.layouts.main')
@section('title', 'Daftar Tipe Mobil')
@section('content')
  <h2>Daftar Tipe Mobil</h2>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>Nama Mobil</th>
        <th>Nama Tipe</th>
        <th>Jenis Mobil</th>
        <th>Harga Mobil</th>
      </tr>
    </thead>
    <tbody>
      @foreach($mobils as $mobil)
        @foreach($mobil->tipeMobil as $tipe)
          <tr>
            <td>{{ $mobil->nama_mobil }}</td>
            <td>{{ $tipe->nama_tipe }}</td>
            <td>{{ $mobil->jenis_mobil }}</td>
            <td>Rp {{ number_format($tipe->harga_mobil, 0, ',', '.') }}</td>
          </tr>
        @endforeach
      @endforeach
    </tbody>
  </table>

  <!-- Menampilkan pagination -->
  {{ $mobils->links() }}
@endsection
