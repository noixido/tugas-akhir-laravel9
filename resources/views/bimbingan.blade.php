@extends('layouts.master-blank')
@section('title', 'Halaman Bimbingan Mahasiswa')
@section('content')
<div class="container">
    <div class="menu-header" style="height: 230px; padding: 20px">
        <table class="table table-bordered" style="font-size: 15px">
            <tr>
                <td class="col-4">
                    <label for="nama">Nama Mahasiswa</label>
                    <h5><b>{{ $ta->mahasiswa->nama_mahasiswa }}</b></h4>
                </td>
                <td class="col-4">
                    <label for="nim">Nomor Induk Mahasiswa</label>
                    <h5><b>{{ $ta->mahasiswa->nim }}</b></h5>
                </td>
                <td class="col-4">
                    <label for="nim">Dosen Pembimbing</label>
                    <h5><b>{{ $ta->dosen->nama_dosen }}</b></h5>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <label for="judul">Judul Tugas Akhir</label>
                    <h5><b>{{ $ta->judul_tugas_akhir }}</b></h5>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="height: 100%; margin-bottom: 20px">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="col-1">No</th>
                    <th scope="col" class="col-1">Tanggal Bimbingan</th>
                    <th scope="col" class="col-4">Deskripsi Bimbingan</th>
                    <th scope="col" class="col-1">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bimbingan as $index => $row)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $row->tanggal_bimbingan }}</td>
                    <td style="white-space: pre-wrap">{{ $row->isi_bimbingan }}</td>
                    <td>{{ $row->status_bimbingan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection