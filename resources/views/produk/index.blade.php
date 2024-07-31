@extends('layout.main')

@section('content')
<div class="container-fluid px-4">
    <div class=" mb-4 mt-2">
        <a href="/produk/tambah" class="btn btn-primary">Tambah</a>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <h4>Data Produk</h4>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produk as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->nama_produk }}</td>
                        <td>{{ $p->harga }}</td>
                        <td>{{ $p->stok }}</td>
                        <td>{{ $p->status_produk }}</td>
                        <td>
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('produk_destroy', $p->id) }}" method="get">
                                <a href="/produk/edit/{{$p->id}}" class="btn btn-warning">Edit</a>
                                @if($p->status_produk == 'nonaktif')
                                <a href="/produk/aktif/{{$p->id}}" class="btn btn-info">Aktifkan</a>
                                @else
                                <a href="/produk/nonaktif/{{$p->id}}" class="btn btn-secondary">Nonaktifkan</a>
                                @endif
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection