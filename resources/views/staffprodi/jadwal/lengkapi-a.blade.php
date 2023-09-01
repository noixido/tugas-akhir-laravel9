@extends('layouts.master-staffprodi')
@section('title', 'Lengkapi Jadwal')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('detail-jadwal', $grup->id) }}" class="btn btn-light" style="height: 40px;">
                <i class="fa-solid fa-arrow-left-long icon"></i> Kembali
            </a>
        </div>
    </div>
    <div class="row" style="height: 580px">
        <form action="{{ route('proses-lengkapi-a', $grup->id) }}" class="row" style="margin: 0%" method="POST">
            @csrf
            @method('put')
            <div class="col-md-6">
                <label for="ruangan" class="form-label">Ruangan</label>
                <select id="ruangan" class="form-select form-control @error('ruangan') is-invalid @enderror"
                    name="ruangan">
                    <option value="" selected disabled>=== Pilih ===</option>
                    @foreach ($ruangan as $row)
                    @if (old('ruangan', $grup->ruangan_id) == $row->id)
                    <option value="{{ $row->id }}" selected>{{ $row->nama_ruangan }}, L{{ $row->lantai }}R{{
                        $row->ruangan }}</option>
                    @else
                    <option value="{{ $row->id }}">{{ $row->nama_ruangan }}, L{{ $row->lantai }}R{{ $row->ruangan }}
                    </option>
                    @endif
                    @endforeach
                </select>
                @error('ruangan')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="tanggal_sidang" class="form-label">Tanggal Sidang</label>
                <input type="date" class="form-control @error('tanggal_sidang') is-invalid @enderror"
                    id="tanggal_sidang" name="tanggal_sidang"
                    value="{{ old('tanggal_sidang', $grup->tanggal_sidang) }}">
                @error('tanggal_sidang')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="revisi" class="form-label">Batas Revisi</label>
                <input type="date" class="form-control @error('revisi') is-invalid @enderror" id="revisi" name="revisi"
                    value="{{ old('revisi', $grup->batas_revisi) }}">
                @error('tanggal_sidang')
                <span class="revisi-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-12" style="margin-top: 50px">
                <button type="submit" class="btn btn-primary">+ Tambah</button>
            </div>
        </form>
    </div>
</div>
@endsection