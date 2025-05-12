@extends('admin.layouts.main')
@section('title','Daftar Mobil')
@section('content')
<div class="d-flex justify-content-between mb-3">
  <h2>Daftar Mobil</h2>
  <a href="{{ route('admin.mobil.create') }}" class="btn btn-primary">
    <i class="fas fa-plus"></i> Tambah Mobil
  </a>
</div>

<table id="table-mobil" class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nama</th>
      <th>Jenis</th>
      <th>Harga Mulai</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($mobils as $m)
    <tr>
      <td>{{ $m->id }}</td>
      <td>{{ $m->nama_mobil }}</td>
      <td>{{ $m->jenis_mobil }}</td>
      <td>Rp {{ number_format($m->harga_mulai,0,',','.') }}</td>
      <td>
        <!-- Tombol View: trigger modal -->
        <button
            class="btn btn-sm btn-info"
            data-bs-toggle="modal"
            data-bs-target="#modalDetail{{ $m->id }}">
            <i class="lni lni-eye"></i>
        </button>
        <a href="{{ route('admin.mobil.edit',$m->id) }}" class="btn btn-sm btn-warning">
          <i class="lni lni-pencil-alt"></i>
        </a>
        <form action="{{ route('admin.mobil.destroy',$m->id) }}" method="POST" class="d-inline"
              onsubmit="return confirm('Hapus mobil ini?')">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-danger"><i class="lni lni-trash"></i></button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@foreach($mobils as $m)
<!-- Modal Detail Mobil -->
<div class="modal fade" id="modalDetail{{ $m->id }}" tabindex="-1" role="dialog"
     aria-labelledby="modalDetailLabel{{ $m->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel{{ $m->id }}">
                    {{ $m->nama_mobil }}
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    {{-- Gambar Mobil --}}
                    <div class="col-md-5">
                        <img src="{{ asset('storage/'.$m->gambar_mobil) }}" alt="{{ $m->nama_mobil }}" class="img-fluid rounded">
                    </div>
                    <div class="col-md-7">
                        {{-- Detail --}}
                        <p><strong>Jenis:</strong> {{ $m->jenis_mobil }}</p>
                        <p><strong>Highlight:</strong> {{ $m->highlight }}</p>
                        <p><strong>Deskripsi:</strong></p>
                        <p>{{ $m->deskripsi }}</p>
                        <p><strong>Harga Mulai:</strong>
                            Rp {{ number_format($m->harga_mulai,0,',','.') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach


{{ $mobils->links() }}

<script>
  $(document).ready(function(){
    $('#table-mobil').DataTable({ "paging": false, "info": false });
  });
</script>
@endsection
