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
</div>
@endsection