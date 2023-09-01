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
    <div class="row" style="height: 580px">
        <form action="" class="row" style="margin: 0%" method="POST">
            @csrf
            @method('put')

            {{ $daftar->mahasiswa->nama_mahasiswa }}
            {{-- <div class="col-md-6">
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
            </div> --}}
            <div class="col-12" style="margin-top: 50px">
                <button type="submit" class="btn btn-primary">+ Tambah</button>
            </div>
        </form>
    </div>
</div>
@endsection