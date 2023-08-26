@extends('layouts.master-mahasiswa')
@section('title', 'Tugas Akhir')
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
        <form action="{{ route('proses-tambah-bimbingan') }}" method="POST" class="row" style="margin: 0%">
            @csrf
            <table class="table table-bordered" style="width: 1155px">
                <tr>
                    <th class="col-3">Tanggal Bimbingan</th>
                    <td class="col-3">
                        <div class="col-md-12">
                            <input type="date" class="form-control datepicker @error('tanggal') is-invalid @enderror"
                                id="tanggal" name="tanggal" value="{{ old('tanggal') }}">
                            @error('tanggal')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="col-3">Deskripsi Bimbingan</th>
                    <td class="col-3">
                        <div class="col-md-12">
                            <textarea name="isi" id="isi" cols="30" rows="10"
                                class="form-control @error('isi') is-invalid @enderror" id="isi" name="isi">
                                {{ old('isi') }}
                            </textarea>
                            @error('isi')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center   ">
                        <button type="submit" class="btn btn-primary">Tambah
                            Bimbingan
                            Data</button>
                        {{-- <a href="#" class="btn btn-warning">Perbarui
                            Data</a> --}}
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
@endsection