@extends('layouts.master-staffprodi')
@section('title', 'Lengkapi Jadwal')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('detail-jadwal', $daftar->grup_id) }}" class="btn btn-light" style="height: 40px;">
                <i class="fa-solid fa-arrow-left-long icon"></i> Kembali
            </a>
        </div>
    </div>
    <div class="row" style="height: auto">
        <form action="{{ route('proses-lengkapi-jadwal-b', $daftar->id) }}" class="row" style="margin-bottom: 20px"
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
            <div class="col-md-6">
                <label for="dosen1" class="form-label">Dosen Penguji 1</label>
                <select id="dosen1" class="form-select form-control @error('dosen1') is-invalid @enderror"
                    name="dosen1">
                    <option value="" selected disabled>=== Pilih ===</option>
                    @foreach ($dosen as $row)
                    @if (old('dosen1', $daftar->penguji_1) == $row->id)
                    <option value="{{ $row->id }}" selected>{{ $row->nama_dosen }}</option>
                    @else
                    <option value="{{ $row->id }}">{{ $row->nama_dosen }}</option>
                    @endif
                    @endforeach
                </select>
                @error('dosen1')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="dosen2" class="form-label">Dosen Penguji 2</label>
                <select id="dosen2" class="form-select form-control @error('dosen2') is-invalid @enderror"
                    name="dosen2">
                    <option value="" selected disabled>=== Pilih ===</option>
                    @foreach ($dosen as $row)
                    @if (old('dosen2', $daftar->penguji_2) == $row->id)
                    <option value="{{ $row->id }}" selected>{{ $row->nama_dosen }}</option>
                    @else
                    <option value="{{ $row->id }}">{{ $row->nama_dosen }}</option>
                    @endif
                    @endforeach
                </select>
                @error('dosen1')
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