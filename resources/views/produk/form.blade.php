@extends('layout.main')

@section('content')
<div class="container-fluid px-4">
    <div class="mt-4">
        <h3>Form Tambah Data</h3>
        @if(!empty($produk))
        <form action="{{route('produk_edit')}}" method="post" class="mb-3" enctype="multipart/form-data">
            @else
            <form method="post" action="{{route('produk_tambah')}}" class="mb-3" enctype="multipart/form-data">
                @endif
                {{ csrf_field() }}
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Produk</label>
                    @if(!empty($produk))
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Produk" value="{{ $produk->nama_produk }}">
                    @else
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Produk">
                    @endif
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga Produk</label>
                    @if(!empty($produk))
                    <input type="number" name="harga" class="form-control" id="harga" min="1" placeholder="Harga Produk" value="{{ $produk->harga }}">
                    @else
                    <input type="number" name="harga" class="form-control" id="harga" min="1" placeholder="Harga Produk">
                    @endif
                </div>
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok Produk</label>
                    @if(!empty($produk))
                    <input type="number" name="stok" class="form-control" id="stok" min="1" placeholder="Stok Produk" value="{{ $produk->stok }}">
                    @else
                    <input type="number" name="stok" class="form-control" id="stok" min="1" placeholder="Stok Produk">
                    @endif
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status Produk</label>
                    <select class="form-select" name="status" id="status">
                        <option selected value="" disabled>Pilih Status Produk</option>
                        @if(!empty($produk))
                        <option selected value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                        @else
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                        @endif
                    </select>
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Produk</label>
                    @if(!empty($produk))
                    <input type="file" name="foto" class="form-control" id="foto" placeholder="Foto Produk" value="{{ $produk->foto }}" accept="image/*">
                    @else
                    <input type="file" name="foto" class="form-control" id="foto" placeholder="Foto Produk" accept="image/*">
                    @endif
                </div>
                <div class="mb-3">
                    @if(!empty($produk))
                    <img src="{{ asset('images/foto_produk/'.$produk->foto) }}" style="height:100px ; width: 100px;" id="hasilfoto">
                    @else
                    <img src="" style="height:100px ; width: 100px;" id="hasilfoto">
                    @endif
                </div>

                <input type="hidden" name="id" value="<?php if (!empty($produk)) echo $produk->id ?>">
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
    </div>
</div>
@endsection

@section('js')
<script>
    document.getElementById("foto").addEventListener("change", myFunction);

    function myFunction() {
        preview = document.getElementById('hasilfoto');
        const [file] = document.getElementById("foto").files
        preview.src = URL.createObjectURL(file)
    }
</script>
@endsection