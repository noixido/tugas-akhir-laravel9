@extends('layouts.master-admin')
@section('title', 'Edit Data Ruangan')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('data-ruangan') }}" class="btn btn-light" style="height: 40px;">
                <i class="fa-solid fa-arrow-left-long icon"></i> Kembali
            </a>
        </div>
    </div>
    <div class="row" style="height: 580px">
        <form action="{{ route('proses-edit-ruangan', $data->id) }}" class="row" style="margin: 0%" method="POST">
            @csrf
            @method('put')
            <div class="col-md-6">
                <label for="lantai" class="form-label">Lantai</label>
                <input type="number" class="form-control @error('lantai') is-invalid @enderror" id="lantai"
                    name="lantai" value="{{ old('lantai', $data->lantai) }}">
                @error('lantai')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="ruangan" class="form-label">Nomor Ruangan</label>
                <input type="number" class="form-control @error('ruangan') is-invalid @enderror" id="ruangan"
                    name="ruangan" value="{{ old('ruangan', $data->ruangan) }}">
                @error('ruangan')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
                <input type="text" class="form-control @error('nama_ruangan') is-invalid @enderror" id="nama_ruangan"
                    name="nama_ruangan" value="{{ old('nama_ruangan', $data->nama_ruangan) }}">
                @error('nama_ruangan')
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