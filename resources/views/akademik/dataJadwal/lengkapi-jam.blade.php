@extends('layouts.master-admin')
@section('title', 'Lengkapi Jam')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('detail-draft-jadwal', $daftar->grup_id) }}" class="btn btn-light" style="height: 40px;">
                <i class="fa-solid fa-arrow-left-long icon"></i> Kembali
            </a>
        </div>
    </div>
    <div class="row" style="height: auto">
        <form action="{{ route('proses-lengkapi-jam', $daftar->id) }}" class="row" style="margin-bottom: 20px"
            method="POST">
            @csrf
            @method('put')
            <div class="col-md-6">
                <label for="mulai" class="form-label">Mulai Sidang</label>
                <input type="time" class="form-control @error('mulai') is-invalid @enderror" id="mulai" name="mulai"
                    value="{{ old('mulai', $daftar->jam_mulai_sidang) }}">
                @error('mulai')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="selesai" class="form-label">Selesai Sidang</label>
                <input type="time" class="form-control @error('selesai') is-invalid @enderror" id="selesai"
                    name="selesai" value="{{ old('selesai', $daftar->jam_selesai_sidang) }}">
                @error('selesai')
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