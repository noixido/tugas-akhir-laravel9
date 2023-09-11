@extends('layouts.master-dosen')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    <div class="menu-header">
        <div style="margin: 0 auto; text-align:center;">
            <h3><b>Selamat Datang di Dashboard Dosen</b></h3>
        </div>
    </div>
</div>
@foreach ($grup as $item)
<div class="container">
    <div class="row" style="height: 100%; margin-bottom: 20px">
        <div style="margin: 0 auto; text-align:center;">
            {{-- <p style="font-size: 12px;">dipublish pada - {{ $item->updated_at }}</p> --}}
            <h3><b>Jadwal Sidang Tugas Akhir</b></h3>
            <br>
            <h5>Periode {{ $item->periode_ke }}</h5>
            <h5>Tahun Akademik 2022/2023</h5>
        </div>
        <table class="table table-bordered" style="margin-top: 10px;">
            <tr style="font-size: 16px">
                <th scope="col" class="col-1">Tanggal Sidang</th>
                <th scope="col" class="col-1">Ruangan</th>
                <th scope="col" class="col-1">Jenjang</th>
                <th scope="col" class="col-1">Program Studi</th>
                <th scope="col" class="col-1">Konsentrasi</th>
                <th scope="col" class="col-1">Batas Revisi</th>
            </tr>
            <tr style="font-size: 14px">
                <td>{{ date('j F Y', strtotime($item->tanggal_sidang)) }}</td>
                <td>{{ $item->ruangan->nama_ruangan }}, L{{ $item->ruangan->lantai }}R{{ $item->ruangan->ruangan }}</td>
                <td>{{ $item->program_studi->jenjang }}</td>
                <td>{{ $item->program_studi->nama_prodi }}</td>
                <td>{{ $item->program_studi->konsentrasi ?? '-'}}</td>
                <td>{{ date('j F Y', strtotime($item->batas_revisi)) }}</td>
            </tr>
        </table>
        <table class="table table-bordered">
            <tr style="font-size: 16px">
                <th scope="col" class="col-1">NO</th>
                <th scope="col" class="col-1">WAKTU</th>
                <th scope="col" class="col-2">MAHASISWA</th>
                <th scope="col" class="col-1">NIM</th>
                <th scope="col" class="col-3">JUDUL TUGAS AKHIR</th>
                <th scope="col" class="col-2">MODERATOR</th>
                <th scope="col" class="col-2">PENGUJI</th>
            </tr>
            @php
            $no = 1;
            @endphp
            @foreach ($daftar as $row)
            @if($row->grup_id == $item->id)
            <tr style="font-size: 14px">
                <td>{{ $no++ }}</td>
                <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $row->jam_mulai_sidang)->format('H:i') }} - {{
                    \Carbon\Carbon::createFromFormat('H:i:s', $row->jam_selesai_sidang)->format('H:i') }}</td>
                <td>{{ $row->mahasiswa->nama_mahasiswa }}</td>
                <td>{{ $row->mahasiswa->nim }}</td>
                <td>{{ $row->tugas_akhir->judul_tugas_akhir }}</td>
                <td>{{ $row->tugas_akhir->dosen->nama_dosen }}</td>
                <td>
                    1. {{ $row->penguji1->nama_dosen }} <br>
                    2. {{ $row->penguji2->nama_dosen }}
                </td>
            </tr>
            @endif
            @endforeach
        </table>
        <div class="col-12" style="display: flex; justify-content:center">
            <a href="{{ route('jadwalPDF', $item->id) }}" class="btn btn-success">Download Jadwal</a>
        </div>
        <p style="font-size: 12px; color: red">*dipublish pada {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
            $item->updated_at)->format('j F Y, H:i') }}</p>
    </div>
</div>
@endforeach
@endsection