@extends('layouts.master-admin')
@section('title', 'Detail Draft Jadwal')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('draft-jadwal') }}" class="btn btn-light" style="height: 40px;">
                <i class="fa-solid fa-arrow-left-long icon"></i> Kembali
            </a>
        </div>
    </div>
    <div class="menu-header" style="height: auto; padding: 20px 20px 5px 20px">
        <table class="table table-bordered" style="font-size: 15px">
            <tr>
                <td class="col-3">
                    <label for="periode">Periode</label>
                    <h5><b>P{{ $data->periode_ke }}Y{{ $data->yudisium_ke }}</b></h4>
                </td>
                <td class="col-3">
                    <label for="jenjang">Jenjang</label>
                    <h5><b>{{ $data->program_studi->jenjang }}</b></h5>
                </td>
                <td class="col-3">
                    <label for="jurusan">Program Studi</label>
                    <h5><b>{{ $data->program_studi->nama_prodi }}</b></h5>
                </td>
                <td class="col-3">
                    <label for="tahun_akademik">Tahun Akademik</label>
                    <h5><b>{{ $data->tahun_akademik }}</b></h5>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="height: auto">
        <table class="table table-bordered">
            <tr>
                <th scope="col" class="col-1">No</th>
                <th scope="col" class="col-1">NIM</th>
                <th scope="col" class="col-2">Nama Mahasiswa</th>
                <th scope="col" class="col-1">Dosen Pembimbing</th>
                <th scope="col" class="col-3">Judul Tugas Akhir</th>
                <th scope="col" class="col-1">Tanggal Daftar</th>
            </tr>
            @foreach ($daftar as $index => $row)
            <tr>
                <td>{{ $daftar->firstItem() + $index }}</td>
                <td>{{ $row->mahasiswa->nim }}</td>
                <td>{{ $row->mahasiswa->nama_mahasiswa }}</td>
                <td>{{ $row->tugas_akhir->dosen->nama_dosen }}</td>
                <td>{{ $row->tugas_akhir->judul_tugas_akhir }}</td>
                <td>{{ $row->created_at }}</td>
            </tr>
            @endforeach
        </table>
        {{ $daftar->links() }}
    </div>
</div>
@endsection