@extends('layouts.master-mahasiswa')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    <div class="row" style="height: 100%">
        <div style="margin: 0 auto; text-align:center">
            <h3><b>Jadwal Sidang Tugas Akhir</b></h3>
            <br>
            <h5>Periode 1</h5>
            <h5>Tahun Akademik 2022/2023</h5>
        </div>
        <table class="table table-bordered" style="margin-top: 10px">
            <tr>
                <td>Jenjang</td>
                <td>Program Studi</td>
                <td>Konsentrasi</td>
                <td>Ruangan</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>
</div>
@endsection

{{-- <ul>
    @foreach ($grup as $item)
    <li>{{ $item->tanggal_sidang }}</li>
    <ul>
        @foreach ($daftar as $row)

        @if($row->grup_id == $item->id)

        <li>{{ $row->alamat }}</li>

        @endif

        @endforeach
    </ul>
    @endforeach
</ul> --}}