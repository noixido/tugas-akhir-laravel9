@extends('layouts.master-mahasiswa')
@section('title', 'Halaman Data Rincian Bimbingan')
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
        <table class="table table-bordered">
            <tr>
                <th scope="col" class="col-6">Nama Mahasiswa</th>
                <td>{{ $data->nama_mahasiswa }}</td>
            </tr>
            <tr>
                <th>Nomor Induk Mahasiswa</th>
                <td>{{ $data->nim }}</td>
            </tr>
            <tr>
                <th>Tanggal Bimbingan</th>
                <td>{{ $data->tanggal_bimbingan }}</td>
            </tr>
            <tr>
                <th>Tanggal Bimbingan</th>
                <td>{{ $data->tanggal_bimbingan }}</td>
            </tr>
            <tr>
                <th>Deskripsi Bimbingan</th>
                <td>
                    <p style="white-space: pre-wrap;">{{ $data->isi_bimbingan }}</p>
                </td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    {{ $data->status_bimbingan }}
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center   ">
                    <a href="#" class="btn btn-warning">Perbarui
                        Data</a>
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection