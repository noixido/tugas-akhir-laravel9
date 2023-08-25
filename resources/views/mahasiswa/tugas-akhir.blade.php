@extends('layouts.master-mahasiswa')
@section('title', 'Perbarui Tugas Akhir')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('bimbingan') }}" class="btn btn-light" style="height: 40px;">
                <i class="fa-solid fa-arrow-left-long icon"></i> Kembali
            </a>
        </div>
    </div>
    <div class="row" style="height: 580px">
        {{-- <form action="{{ route('proses-edit-jurusan', $data->id) }}" class="row" style="margin: 0%" method="POST">
            --}}
            <form action="#" class="row" style="margin: 0%" method="POST">
                @csrf
                {{-- @method('put') --}}
                <div class="col-md-6">
                    <label for="judul" class="form-label">judul</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                        name="kode_prodi" value="{{ old('judul', $data->judul_tugas_akhir) }}">
                    @error('kode_prodi')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </form>
    </div>
</div>
@endsection