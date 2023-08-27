@extends('layouts.master-dosen')
@section('title', 'Halaman Data Bimbingan Mahasiswa')
@section('content')
<div class="container">
    <div class="row">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="col-2">NIM</th>
                    <th scope="col" class="col-2">Nama Mahasiswa</th>
                    <th scope="col" class="col-3">Judul Tugas Akhir</th>
                    <th scope="col" class="col-1">aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bimbingan as $row)
                <tr>
                    <td>{{ $row->nim }}</td>
                    <td>{{ $row->nama_mahasiswa }}</td>
                    <td>{{ $row->judul_tugas_akhir }}</td>
                    <td style="text-align: center">
                        <a href="/dosen/bimbingan/{{ $row->mahasiswa_id }}" class="btn btn-primary"><i
                                class="fa-solid fa-eye icon"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection