@extends('layouts.master-dosen')
@section('title', 'Edit Dosen Profile')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('dosen_profile', Auth::user()->username) }}" class="btn btn-light" style="height: 40px;">
                <i class="fa-solid fa-arrow-left-long icon"></i> Kembali
            </a>
        </div>
    </div>
    <div class="row">
        <form action="{{ route('proses_edit_dosen_profil', Auth::user()->id) }}" class="row" style="margin: 0%"
            method="POST">
            @csrf
            @method('put')
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
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                    value="{{ old('nama', $data->nama_dosen) }}">
                @error('nama')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="nidn" class="form-label">Nomor Induk Dosen</label>
                <input type="text" class="form-control @error('nidn') is-invalid @enderror" id="nidn" name="nidn"
                    value="{{ old('nidn', $data->nidn) }}">
                @error('nidn')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="jurusan" class="form-label">Program Studi</label>
                <select id="jurusan" class="form-select form-control @error('jurusan') is-invalid @enderror"
                    name="jurusan">

                    @foreach ($prodis as $row)
                    @if ( old('jurusan', $data->jurusan_id) == $row->id)
                    <option value="{{ $row->id }}" selected>{{ $row->jenjang }} {{ $row->nama_prodi }}, {{
                        $row->konsentrasi ??
                        "" }}</option>
                    @else
                    <option value="{{ $row->id }}">{{ $row->jenjang }} {{ $row->nama_prodi }}, {{ $row->konsentrasi ??
                        "" }}</option>
                    @endif
                    @endforeach

                </select>
                @error('jurusan')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                    value="{{ old('email', $data->email) }}">
                @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="number" class="form-control @error('telepon') is-invalid @enderror" id="telepon"
                    name="telepon" value="{{ old('telepon', $data->telepon) }}">
                @error('telepon')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea style="height: 40px" name="alamat" id="alamat" cols="30" rows="10"
                    class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $data->alamat) }}</textarea>
                @error('alamat')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-12" style="margin-top: 50px; text-align:center">
                <button type="submit" class="btn btn-warning">Perbarui</button>
            </div>
        </form>
    </div>
</div>
@endsection