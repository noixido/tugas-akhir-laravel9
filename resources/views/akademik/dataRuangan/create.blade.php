@extends('layouts.master-admin')
@section('title', 'Tambah Data Ruangan')
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
        <form action="{{ route('proses-tambah-ruangan') }}" class="row" style="margin: 0%" method="POST">
            @csrf
            <div class="col-md-6">
                <label for="lantai" class="form-label">Lantai</label>
                <input type="number" class="form-control @error('latnai') is-invalid @enderror" id="lantai"
                    name="lantai" value="{{ old('lantai') }}">
                @error('lantai')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="ruangan" class="form-label">Nomor Ruangan</label>
                <input type="number" class="form-control @error('ruangan') is-invalid @enderror" id="ruangan"
                    name="ruangan" value="{{ old('ruangan') }}">
                @error('ruangan')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-12" style="margin-top: 50px">
                <button type="submit" class="btn btn-primary">+ Tambah</button>
            </div>
        </form>
    </div>
</div>
@endsection