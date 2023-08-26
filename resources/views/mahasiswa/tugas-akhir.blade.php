@extends('layouts.master-mahasiswa')
@section('title', 'Tugas Akhir')
@section('content')
<div class="container">
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
                <th>Dosen Pembimbing</th>
                <td>{{ $data->nama_dosen ?? '-'}}</td>
            </tr>
            <tr>
                <th>Judul Tugas Akhir</th>
                <td>{{ $data->judul_tugas_akhir ?? '-'}}</td>
            </tr>
            <tr>
                <th>Program Studi</th>
                <td>{{ $mhs->jenjang ?? '-'}} {{ $mhs->nama_prodi ?? '-'}}</td>
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