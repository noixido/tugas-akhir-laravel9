@extends('layouts.master-admin')
@section('title', 'Edit Data Admin')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('data-admin') }}" class="btn btn-light" style="height: 40px;">
                <i class="fa-solid fa-arrow-left-long icon"></i> Kembali
            </a>
        </div>
    </div>
    <div class="row" style="height: 580px">
        <form action="{{ route('proses-edit-admin', $data->id) }}" class="row" style="margin: 0%" method="POST">
            @csrf
            @method('put')
            <div class="col-md-6">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                    value="{{ old('nama', $data->nama) }}">
                @error('nama')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                    name="username" value="{{ old('username', $data->username) }}">
                @error('username')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" placeholder="Biarkan kosong jika tidak ingin merubah password">
                @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="role" class="form-label">Role</label>
                <input type="text" class="form-control @error('role') is-invalid @enderror" id="role" name="role"
                    value="Admin" disabled>
                @error('role')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-12" style="margin-top: 50px">
                <button type="submit" class="btn btn-primary">Perbarui</button>
            </div>
        </form>
    </div>
</div>
@endsection