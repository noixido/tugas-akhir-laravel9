@extends('layouts.master-mahasiswa')
@section('title', 'Edit Tugas Akhir')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('tugas-akhir') }}" class="btn btn-light" style="height: 40px;">
                <i class="fa-solid fa-arrow-left-long icon"></i> Kembali
            </a>
        </div>
    </div>
    <div class="row" style="height: 580px">
        <form action="{{ route('proses-edit-tugas-akhir', Auth::user()->username) }}" class="row" style="margin: 0%"
            method="POST">
            @csrf
            @method('put')
            <table class="table table-bordered" style="width: 1155px">
                <tr>
                    <th scope="col" class="col-6">Dosen Pembimbing</th>
                    <td><select id="dosen" class="form-select form-control @error('dosen') is-invalid @enderror"
                            name="dosen">
                            <option value="" selected disabled>=== Pilih Dosen ===</option>
                            @foreach ($dosen as $row)
                            @if (old('dosen', $data->dosen_id ?? '') == $row->id)
                            <option value="{{ $row->id }}" selected>{{ $row->nama_dosen }}</option>
                            @else
                            <option value="{{ $row->id }}">{{ $row->nama_dosen }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('dosen')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th><label for="judul" class="form-label">Judul Tugas Akhir</label></th>
                    <td><textarea name="judul" id="judul" cols="30" rows="10"
                            class="form-control @error('judul') is-invalid @enderror">
                                    {{ old('judul', $data->judul_tugas_akhir ?? '') }}
                                    </textarea>
                        @error('judul')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center   ">
                        <div class="col-12" style="text-align:center">
                            <button type="submit" class="btn btn-warning">Perbarui Data</button>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
@endsection