@extends('layouts.master-mahasiswa')
@section('title', 'Tugas Akhir')
@section('content')
<div class="container">
    @if (session()->has('message'))
    <div class="alert alert-danger" style="width: 1283px; text-align:center">
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="/mahasiswa" class="btn btn-light" style="height: 40px;">
                <i class="fa-solid fa-arrow-left-long icon"></i> Kembali
            </a>
        </div>
    </div>
    <div class="row" style="height: 580px">
        <table class="table table-bordered">
            <tr>
                <th scope="col" class="col-6">Nama Mahasiswa</th>
                <td>{{ $mhs->nama_mahasiswa ?? '-'}}</td>
            </tr>
            <tr>
                <th>Program Studi</th>
                <td>{{ $mhs->program_studi->jenjang ?? '-'}} {{ $mhs->program_studi->nama_prodi ?? ''}}</td>
            </tr>
            <tr>
                <th>Dosen Pembimbing</th>
                <td style="display: flex; justify-content: space-between">{{ $data->nama_dosen ?? '-'}} <a
                        href="{{ route('profile-pembimbing', $dosen->id) }}" style="text-decoration: none"><i
                            class="fa-solid fa-eye"></i> Profil Dosen</a></td>
            </tr>
            <tr>
                <th>Judul Tugas Akhir</th>
                <td>{{ $data->judul_tugas_akhir ?? '-'}}</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center   ">
                    <a href="{{ route('edit-tugas-akhir', Auth::user()->username) }}" class="btn btn-warning">Perbarui
                        Data</a>
                    {{-- <a href="#" class="btn btn-warning">Perbarui
                        Data</a> --}}
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection