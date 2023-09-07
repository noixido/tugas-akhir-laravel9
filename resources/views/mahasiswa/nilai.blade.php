@extends('layouts.master-mahasiswa')
@section('title', 'Halaman Detail Nilai Mahasiswa')
@section('content')
<div class="container">
    <div class="menu-header" style="height: 100%; padding-bottom: 10px">
        <table class="table table-bordered" style="font-size: 15px">
            <tr>
                <td>
                    <label for="nama">Nama Mahasiswa</label>
                    <h5><b>{{ $daftar->tugas_akhir->mahasiswa->nama_mahasiswa }}</b></h4>
                </td>
                <td>
                    <label for="nim">Nomor Induk Mahasiswa</label>
                    <h5><b>{{ $daftar->tugas_akhir->mahasiswa->nim }}</b></h5>
                </td>
                <td>
                    <label for="dosen">Dosen Pembimbing</label>
                    <h5><b>{{ $daftar->tugas_akhir->dosen->nama_dosen }}</b></h5>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <label for="tanggal_sidang">Judul Tugas Akhir</label>
                    <h5><b>{{ $daftar->tugas_akhir->judul_tugas_akhir }}</b></h5>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="tanggal_sidang">Tanggal Sidang</label>
                    <h5>
                        <b>
                            @if ($daftar->grup === null)
                            -
                            @else
                            {{ date('j F Y', strtotime($daftar->grup->tanggal_sidang)) }}
                            @endif
                        </b>
                    </h5>
                </td>
                <td>
                    <label for="penguji1">Dosen Penguji 1</label>
                    <h5><b>{{ $daftar->penguji1->nama_dosen ?? '-' }}</b></h5>
                </td>
                <td>
                    <label for="penguji2">Dosen Penguji 2</label>
                    <h5><b>{{ $daftar->penguji2->nama_dosen ?? '-' }}</b></h5>
                </td>
            </tr>
        </table>
    </div>
    <div class="menu-header" style="height: 100%; padding-bottom: 10px">
        <table class="table table-bordered">
            <tr>
                <td class="col-1">
                    <label for="penguji2">Nilai Pembimbing</label>
                    <h5><b>{{ $nilai->nilai_pembimbing ?? '-' }}</b></h5>
                </td>
                <td class="col-1">
                    <label for="penguji2">Nilai Penguji 1</label>
                    <h5><b>{{ $nilai->nilai_penguji_1 ?? '-' }}</b></h5>
                </td>
                <td class="col-1">
                    <label for="penguji2">Nilai Penguji 2</label>
                    <h5><b>{{ $nilai->nilai_penguji_1 ?? '-' }}</b></h5>
                </td>
                <td class="col-1">
                    <label for="total">Nilai Total</label>
                    <h5>
                        <b>
                            {{ $nilai_sidang }}
                        </b>
                    </h5>
                </td>
                <td class="col-1">
                    <label for="huruf">Nilai Huruf</label>
                    <h5>
                        <b>{{ $nilai_huruf }}</b>
                    </h5>
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection