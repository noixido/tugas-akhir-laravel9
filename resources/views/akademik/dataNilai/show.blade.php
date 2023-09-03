@extends('layouts.master-admin')
@section('title', 'Halaman Data Rincian Nilai Sidang Mahasiswa')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('data-nilai') }}" class="btn btn-light" style="height: 40px;">
                <i class="fa-solid fa-arrow-left-long icon"></i> Kembali
            </a>
        </div>
    </div>
    <div class="row" style="height: 100%">
        <table class="table table-bordered">
            <tr>
                <th scope="col" class="col-6">Nama Lengkap</th>
                <td scope="col" class="col-6">{{ $nilai->daftar_sidang->mahasiswa->nama_mahasiswa }}</td>
            </tr>
            <tr>
                <th>Nomor Induk Mahasiswa</th>
                <td>{{ $nilai->daftar_sidang->mahasiswa->nim }}</td>
            </tr>
            <tr>
                <th>Program Studi</th>
                <td>{{ $nilai->daftar_sidang->mahasiswa->program_studi->jenjang }} {{
                    $nilai->daftar_sidang->mahasiswa->program_studi->nama_prodi }}</td>
            </tr>
            <tr>
                <th>Konsentrasi</th>
                <td>{{ $nilai->daftar_sidang->mahasiswa->program_studi->konsentrasi ?? '-'}}</td>
            </tr>
            <tr>
                <th>Tanggal Daftar Sidang</th>
                <td>{{ date('j F Y, H:i', strtotime($nilai->daftar_sidang->created_at)) }}</td>
            </tr>
            <tr>
                <th>Tanggal Sidang</th>
                <td>{{ date('j F Y', strtotime($nilai->daftar_sidang->grup->tanggal_sidang))}}</td>
            </tr>
            <tr>
                <th>Dosen Pembimbing</th>
                <td>{{ $nilai->daftar_sidang->tugas_akhir->dosen->nama_dosen }}</td>
            </tr>
            <tr>
                <th>Judul Tugas Akhir</th>
                <td>{{ $nilai->daftar_sidang->tugas_akhir->judul_tugas_akhir }}</td>
            </tr>
            <tr>
                <th>Penguji Sidang 1</th>
                <td>{{ $nilai->daftar_sidang->penguji1->nama_dosen }}</td>
            </tr>
            <tr>
                <th>Penguji Sidang 2</th>
                <td>{{ $nilai->daftar_sidang->penguji2->nama_dosen }}</td>
            </tr>
            <tr>
                <th>Nilai Pembimbing</th>
                <td>{{ $nilai->nilai_pembimbing }}</td>
            </tr>
            <tr>
                <th>Nilai Penguji Sidang 1</th>
                <td>{{ $nilai->nilai_penguji_1 }}</td>
            </tr>
            <tr>
                <th>Nilai Penguji Sidang 2</th>
                <td>{{ $nilai->nilai_penguji_2 }}</td>
            </tr>
            <tr>
                <th>Nilai Total</th>
                <td>{{ number_format((($nilai->nilai_pembimbing * 2) + $nilai->nilai_penguji_1 +
                    $nilai->nilai_penguji_2) / 4,
                    2) }}</td>
            </tr>
            <tr>
                <th>Nilai Huruf</th>
                <td>
                    @php
                    $nilai_sidang = number_format((($nilai->nilai_pembimbing * 2) + $nilai->nilai_penguji_1 +
                    $nilai->nilai_penguji_2) / 4,
                    2);
                    $nilai_huruf = '';
                    @endphp
                    @if ($nilai_sidang >= 85 && $nilai_sidang <= 100) {{ $nilai_huruf="A" }} @elseif ($nilai_sidang>= 80
                        && $nilai_sidang <= 84.99) {{ $nilai_huruf="AB" }} @elseif ($nilai_sidang>= 75 && $nilai_sidang
                            <= 79.99) {{ $nilai_huruf="B" }} @elseif ($nilai_sidang>= 70 && $nilai_sidang <= 74.99) {{
                                    $nilai_huruf="BC" }} @elseif ($nilai_sidang>= 60 && $nilai_sidang <= 69.99) {{
                                        $nilai_huruf="C" }} @elseif ($nilai_sidang>= 55 && $nilai_sidang <= 59.99) {{
                                            $nilai_huruf="CD" }} @elseif ($nilai_sidang>=
                                            0 && $nilai_sidang <= 54.99){{ $nilai_huruf="D" }} @endif </td>
            </tr>
        </table>
    </div>
</div>
@endsection