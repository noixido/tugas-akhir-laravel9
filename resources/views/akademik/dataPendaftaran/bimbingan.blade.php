@extends('layouts.master-admin')
@section('title', 'Halaman Bimbingan Mahasiswa')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('lihat-pendaftaran', $daftar->mahasiswa_id) }}" class="btn btn-light"
                style="height: 40px;">
                <i class="fa-solid fa-arrow-left-long icon"></i> Kembali
            </a>
        </div>
    </div>
    <div class="menu-header" style="height: 230px; padding: 20px">
        <table class="table table-bordered" style="font-size: 15px">
            <tr>
                <td>
                    <label for="nama">Nama Mahasiswa</label>
                    <h5><b>{{ $ta->nama_mahasiswa }}</b></h4>
                </td>
                <td>
                    <label for="nim">Nomor Induk Mahasiswa</label>
                    <h5><b>{{ $ta->nim }}</b></h5>
                </td>
                <td>
                    <label for="dosen">Dosen Pembimbing</label>
                    <h5><b>{{ $ta->nama_dosen }}</b></h5>
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
    <div class="row" style="height: 100%">
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
                @foreach ($data as $index => $row)
                <tr>
                    <td>{{ $data->firstItem() + $index }}</td>
                    <td>{{ $row->tanggal_bimbingan }}</td>
                    <td style="white-space: pre-wrap">{{ $row->isi_bimbingan }}</td>
                    <td>{{ $row->status_bimbingan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
</div>
@endsection