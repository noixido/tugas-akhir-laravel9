@extends('layouts.master-admin')
@section('title', 'Tambah Data Mahasiswa')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('data-mahasiswa') }}" class="btn btn-light" style="height: 40px;">
                <i class="fa-solid fa-arrow-left-long icon"></i> Kembali
            </a>
        </div>
    </div>
    <div class="row" style="height: 580px">
        <form action="{{ route('proses-edit-mahasiswa', $data->id) }}" class="row" style="margin: 0%" method="POST">
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
                    name="password" value="{{ old('password') }}"
                    placeholder="Biarkan kosong jika tidak ingin merubah password">
                @error('password')
                <span class=" invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                    value="{{ old('nama', $data->nama_mahasiswa) }}">
                @error('nama')
                <span class=" invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim"
                    value="{{ old('nim', $data->nim) }}">
                @error('nim')
                <span class=" invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="angkatan" class="form-label">Angkatan</label>
                {{-- <input type="number" class="form-control @error('angkatan') is-invalid @enderror" id="angkatan"
                    name="angkatan" value="{{ old('angkatan', $data->angkatan) }}"> --}}
                <select name="angkatan" id="angkatan"
                    class="form-control @error('angkatan') is-invalid @enderror"></select>
                @error('angkatan')
                <span class=" invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="jurusan" class="form-label">Program Studi</label>
                <select id="jurusan" class="form-select form-control @error('jurusan') is-invalid @enderror"
                    name="jurusan">
                    <option value="" selected disabled>=== Pilih ===</option>
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
                <span class=" invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="number" class="form-control @error('telepon') is-invalid @enderror" id="telepon"
                    name="telepon" value="{{ old('telepon', $data->telepon) }}">
                @error('telepon')
                <span class=" invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-12" style="margin-top: 50px">
                <button type="submit" class="btn btn-warning">Perbarui</button>
            </div>
        </form>
    </div>
</div>
<script>
    (() => {
    
    let option = '';
    option = '<option value="" disabled selected>== Pilih Tahun ==</option>'; // first option
    
    let year_start = 1940;
    let year_end = (new Date).getFullYear(); // current year
    let year_selected = option;
    
    for (let i = year_start; i <= year_end; i++) { let selected=(i===year_selected ? ' selected' : '' ); option
        +='<option value="' + i + '"' + selected + '>' + i + '</option>' ; }
        document.getElementById("angkatan").innerHTML=option; })();
</script>
@endsection