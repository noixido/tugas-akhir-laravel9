@extends('layouts.master-staffprodi')
@section('title', 'Profile')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="/staffprodi" class="btn btn-light" style="height: 40px;">
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
                <td>{{ $data->nama_staffprodi }}</td>
            </tr>
            <tr>
                <th>Program Studi</th>
                <td>{{ $data->jenjang }} {{ $data->nama_prodi }}</td>
            </tr>
            <tr>
                <th>Konsentrasi</th>
                <td>{{ $data->konsentrasi ?? '-' }}</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center   ">
                    <a href="/staffprodi/edit-profile/{{ Auth::user()->username }}/edit"
                        class="btn btn-warning">Perbarui
                        Data</a>
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection