@extends('layouts.master-dosen')
@section('title', 'Halaman Penilaian Sidang')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('nilai-sidang') }}" class="btn btn-light" style="height: 40px;">
                <i class="fa-solid fa-arrow-left-long icon"></i> Kembali
            </a>
        </div>
    </div>
    <div class="menu-header" style="height: auto; padding: 20px 20px 5px 20px">
        <table class="table table-bordered" style="font-size: 15px">
            <tr>
                <td class="col-3">
                    <label for="jenjang">Tanggal Sidang</label>
                    <h5><b>{{ $grup->tanggal_sidang }}</b></h5>
                </td>
                <td class="col-3">
                    <label for="periode">Periode</label>
                    <h5><b>P{{ $grup->periode_ke }}Y{{ $grup->yudisium_ke }}</b></h4>
                </td>
                <td class="col-3">
                    <label for="periode">Ruangan</label>
                    <h5><b>{{ $grup->ruangan->nama_ruangan }}, L{{ $grup->ruangan->lantai }}R{{ $grup->ruangan->ruangan
                            }}</b></h4>
                </td>
                <td class="col-3">
                    <label for="tahun_akademik">Tahun Akademik</label>
                    <h5><b>{{ $grup->tahun_akademik - 1 }}/{{ $grup->tahun_akademik }}</b></h5>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="height: auto">
        <table class="table table-bordered">
            <tr>
                <th scope="col" class="col-1">No</th>
                <th scope="col" class="col-1">NIM</th>
                <th scope="col" class="col-1">Nama Mahasiswa</th>
                <th scope="col" class="col-2">Judul Tugas Akhir</th>
                <th scope="col" class="col-1">Moderator</th>
                <th scope="col" class="col-1">Penguji</th>
                <th scope="col" class="col-1">Aksi</th>
            </tr>
            @foreach ($daftar as $index => $row)
            <tr>
                <td>{{ $daftar->firstItem() + $index }}</td>
                <td>{{ $row->mahasiswa->nim }}</td>
                <td>{{ $row->mahasiswa->nama_mahasiswa }}</td>
                <td>{{ $row->tugas_akhir->judul_tugas_akhir }}</td>
                <td>{{ $row->tugas_akhir->dosen->nama_dosen }}</td>
                <td>1. {{ $row->penguji1->nama_dosen }} <br>2. {{ $row->penguji2->nama_dosen }}</td>
                <td>
                    <div style="text-align: center">
                        <a href="{{ route('input-nilai', $row->id) }}" class="btn btn-primary">Lengkapi Nilai</a>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
        {{ $daftar->links() }}
    </div>
</div>
@endsection