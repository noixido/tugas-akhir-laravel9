@extends('layouts.master-mahasiswa')
@section('title', 'Profile Dosen')
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
        <table class="table table-bordered">
            <tr>
                <th>Username</th>
                <td>{{ $data->user->username }}</td>
            </tr>
            <tr>
                <th>Nama Lengkap</th>
                <td>{{ $data->nama_dosen }}</td>
            </tr>
            <tr>
                <th>Nomor Induk Dosen</th>
                <td>{{ $data->nidn }}</td>
            </tr>
            <tr>
                <th>Program Studi</th>
                <td>{{ $data->program_studi->jenjang }} {{ $data->program_studi->nama_prodi }}</td>
            </tr>
            <tr>
                <th>Konsentrasi</th>
                <td>{{ $data->program_studi->konsentrasi ?? '-'}}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $data->email }}</td>
            </tr>
            <tr>
                <th>Telepon</th>
                <td>{{ $data->telepon }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td style="style=" white-space: pre-wrap;"">{{ $data->alamat }}</td>
            </tr>
        </table>
    </div>
</div>
@endsection