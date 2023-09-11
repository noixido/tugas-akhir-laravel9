@extends('layouts.master-dosen')
@section('title', 'Profile Mahasiswa')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('lihat-dosen-bimbingan', $bimbingan->mahasiswa_id) }}" class="btn btn-light"
                style="height: 40px;">
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
                <td>{{ $data->nama_mahasiswa }}</td>
            </tr>
            <tr>
                <th>Nomor Induk Mahasiswa</th>
                <td>{{ $data->nim }}</td>
            </tr>
            <tr>
                <th>Angkatan</th>
                <td>{{ $data->angkatan ?? '-'}}</td>
            </tr>
            <tr>
                <th>Program Studi</th>
                <td>{{ $data->program_studi->jenjang ?? '-'}} {{ $data->program_studi->nama_prodi ?? ''}}</td>
            </tr>
            <tr>
                <th>Konsentrasi</th>
                <td>{{ $data->program_studi->konsentrasi ?? '-' }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $data->email ?? '-'}}</td>
            </tr>
            <tr>
                <th>Telepon</th>
                <td>{{ $data->telepon ?? '-'}}</td>
            </tr>
        </table>
    </div>
</div>
@endsection