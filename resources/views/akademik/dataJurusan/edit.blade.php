@extends('layouts.master-admin')
@section('title', 'Edit Data Jurusan')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('data-jurusan') }}" class="btn btn-light" style="height: 40px;">
                <i class="fa-solid fa-arrow-left-long icon"></i> Kembali
            </a>
        </div>
    </div>
    <div class="row" style="height: 580px">
        <form action="{{ route('proses-edit-jurusan', $data->id) }}" class="row" style="margin: 0%" method="POST">
            @csrf
            @method('put')
            <div class="col-md-6">
                <label for="kode_prodi" class="form-label">Kode Jurusan</label>
                <input type="text" class="form-control @error('kode_prodi') is-invalid @enderror" id="kode_prodi"
                    name="kode_prodi" value="{{ old('kode_prodi', $data->kode_prodi) }}">
                @error('kode_prodi')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="jenjang" class="form-label">Jenjang</label>
                <select id="jenjang" class="form-select form-control @error('jenjang') is-invalid @enderror"
                    name="jenjang">
                    <option value="" selected disabled>=== Pilih ===</option>
                    <option value="D3" {{ $data->jenjang == "D3" ? 'selected' : ''}}>D3</option>
                    <option value="D4" {{ $data->jenjang == "D4" ? 'selected' : ''}}>D4</option>
                </select>
                @error('jenjang')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="nama_prodi" class="form-label">Nama Jurusan</label>
                <input type="text" class="form-control @error('nama_prodi') is-invalid @enderror" id="nama_prodi"
                    name="nama_prodi" value="{{ old('nama_prodi', $data->nama_prodi) }}">
                @error('nama_prodi')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="konsentrasi" class="form-label">Konsentrasi Jurusan</label>
                <input type="text" class="form-control @error('konsentrasi') is-invalid @enderror" id="konsentrasi"
                    name="konsentrasi" value="{{ old('konsentrasi', $data->konsentrasi) }}">
                @error('konsentrasi')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-12" style="margin-top: 50px">
                <button type="submit" class="btn btn-warning">Perbarui</button>
            </div>
        </form>
    </div>
</div>
@endsection