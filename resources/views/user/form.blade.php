@extends('layout.main')

@section('content')
<div class="container-fluid px-4">
    <div class="mt-4">
        <h3>Form Tambah Data</h3>
        @if(!empty($user))
        <form action="{{route('user_edit')}}" method="post" class="mb-3">
            @else
            <form method="post" action="{{route('user_tambah')}}" class="mb-3">
                @endif
                {{ csrf_field() }}
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Admin</label>
                    @if(!empty($user))
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Admin" value="{{ $user->name }}">
                    @else
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Admin">
                    @endif
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    @if(!empty($user))
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ $user->email }}">
                    @else
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                    @endif
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>

                <input type="hidden" name="id" value="<?php if (!empty($user)) echo $user->id ?>">
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
    </div>
</div>
@endsection