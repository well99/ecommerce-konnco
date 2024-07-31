@extends('layout.main')

@section('content')
<div class="container-fluid px-4">
    <div class=" mb-4 mt-2">
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <h4>Data Transaksi</h4>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Nama Customer</th>
                        <th>Alamat</th>
                        <th>Jumlah</th>
                        <th>Total Bayar</th>
                        <th>Status Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $t)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $t->produk->nama_produk }}</td>
                        <td>{{ $t->nama_customer }}</td>
                        <td>{{ $t->alamat }}</td>
                        <td>{{ $t->jumlah }}</td>
                        <td>{{ $t->total_pembayaran }}</td>
                        <td>{{ $t->status_pembayaran }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection