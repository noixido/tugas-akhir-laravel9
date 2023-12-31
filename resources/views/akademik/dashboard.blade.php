@extends('layouts.master-admin')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    <div class="menu-header">
        <div style="margin: 0 auto; text-align:center;">
            <h3><b>Selamat Datang di Dashboard Akademik</b></h3>
        </div>
    </div>
    <div class="menu-header" style="padding: 10px; height: 170px">
        <div style="background:#111827; width: 280px; height:auto; border-radius: 5px; margin: 5px auto; padding: 10px">
            <div style="color: #eeeeee">
                Total Pendaftaran Sidang Tahun Ini
            </div>
            <hr color="#eeeeee">
            <div style="color: #eeeeee; display: inline-flex">
                <div>
                    <h1>{{ $daftarCount }} </h1>
                </div>
                <div style="margin-top: 17px; margin-left: 10px">Pendaftaran</div>
            </div>
        </div>
        <div style="background:#111827; width: 280px; height:auto; border-radius: 5px; margin: 5px auto; padding: 10px">
            <div style="color: #eeeeee">
                Jumlah Pendaftaran Minggu ini
            </div>
            <hr color="#eeeeee">
            <div style="color: #eeeeee; display: inline-flex">
                <div>
                    <h1>{{ $weekCount }} </h1>
                </div>
                <div style="margin-top: 17px; margin-left: 5px">pendaftaran</div>
            </div>
        </div>
        <div style="background:#111827; width: 280px; height:auto; border-radius: 5px; margin: 5px auto; padding: 10px">
            <div style="color: #eeeeee">
                Jumlah Mahasiswa Terdaftar
            </div>
            <hr color="#eeeeee">
            <div style="color: #eeeeee; display: inline-flex">
                <div>
                    <h1>{{ $mhsCount }} </h1>
                </div>
                <div style="margin-top: 17px; margin-left: 5px">Mahasiswa</div>
            </div>
        </div>
        <div style="background:#111827; width: 280px; height:auto; border-radius: 5px; margin: 5px auto; padding: 10px">
            <div style="color: #eeeeee">
                Jumlah Jadwal Dirilis Tahun Ini
            </div>
            <hr color="#eeeeee">
            <div style="color: #eeeeee; display: inline-flex">
                <div>
                    <h1>{{ $grupCount }} </h1>
                </div>
                <div style="margin-top: 17px; margin-left: 5px">Jadwal</div>
            </div>
        </div>
    </div>
    @foreach ($grup as $item)
    <div class="container">
        <div class="row" style="height: 100%; margin-bottom: 20px">
            <img class="image-fluid" src="{{ asset('/images/logo-tedc.png') }}" alt="logo poltek tedc"
                style="width: 115px; height: 110px; margin-left: 30px">
            <div style="display: flex; justify-content: center; text-align:center; margin-left: 267.5px;">
                {{-- <p style="font-size: 12px;">dipublish pada - {{ $item->updated_at }}</p> --}}
                <div>
                    <h3><b>Jadwal Sidang Tugas Akhir</b></h3>
                    <br>
                    <h5>Periode {{ $item->periode_ke }}</h5>
                    <h5>Tahun Akademik 2022/2023</h5>
                </div>
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
                    <td>{{ $item->ruangan->nama_ruangan }}, L{{ $item->ruangan->lantai }}R{{ $item->ruangan->ruangan }}
                    </td>
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
    <div style="margin-left: 30px ">{{ $grup->links() }}</div>
</div>
@endsection