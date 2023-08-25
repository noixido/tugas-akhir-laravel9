@extends('layouts.master-admin')
@section('title', 'Halaman Data Rincian Mahasiswa')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('data-mahasiswa') }}" class="btn btn-light" style="height: 40px;">
                <i class="fa-solid fa-arrow-left-long icon"></i> Kembali
            </a>
        </div>
    </div>
    <div class="row" style="height: 580px">
        <table class="table table-bordered">
            <tr>
                <th>Username</th>
                <td>{{ $data->username }}</td>
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
                <td>{{ $data->angkatan }}</td>
            </tr>
            <tr>
                <th>Program Studi</th>
                <td>{{ $data->jenjang }} {{ $data->nama_prodi }}</td>
            </tr>
            <tr>
                <th>Konsentrasi Program Studi</th>
                <td>{{ $data->konsentrasi ?? '-' }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $data->email }}</td>
            </tr>
            <tr>
                <th>Nomor Telepon</th>
                <td>{{ $data->telepon }}</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center   ">
                    <a href="/akademik/edit-mahasiswa/{{ $data->user_id }}/edit" class="btn btn-warning">Perbarui
                        Data</a>
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection