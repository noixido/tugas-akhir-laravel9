@extends('layouts.master-staffprodi')
@section('title', 'Detail Jadwal')
@section('content')
<div class="container">
    @if (session()->has('message'))
    <div class="alert alert-danger" style="display:flex; justify-content: center; margin: 10px auto; width: 1000px">
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('staff-draft-jadwal') }}" class="btn btn-light" style="height: 40px;">
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
                    <h5><b>{{ $data->tahun_akademik - 1 }}/{{ $data->tahun_akademik }}</b></h5>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="ruangan">Ruangan</label>
                    <h5><b>@if ($data->ruangan_id != null)
                            {{ $data->ruangan->nama_ruangan}}, L{{ $data->ruangan->lantai }}R{{$data->ruangan->ruangan
                            }}
                            @else
                            -
                            @endif</b></h5>
                </td>
                <td>
                    <label for="tanggal_sidang">Tangal Sidang</label>
                    <h5><b>@if ($data->tanggal_sidang != null)
                            {{ date('j F Y', strtotime($data->tanggal_sidang))}}
                            @else
                            -
                            @endif</b></h5>
                </td>
                <td>
                    <label for="revisi">Batas Revisi</label>
                    <h5><b>@if ($data->batas_revisi != null)
                            {{ date('j F Y', strtotime($data->batas_revisi))}}
                            @else
                            -
                            @endif</b></h5>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="kumpulan-tombol" style="display: flex; justify-content:center">
                        <a href="{{ route('lengkapi-jadwal-a', $data->id) }}" class="btn btn-primary">Lengkapi</a>
                    </div>
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
                <th scope="col" class="col-2">Dosen Pembimbing</th>
                <th scope="col" class="col-1">Jam</th>
                <th scope="col" class="col-2">Penguji</th>
                <th scope="col" class="col-1">aksi</th>
            </tr>
            @foreach ($daftar as $index => $row)
            <tr>
                <td>{{ $daftar->firstItem() + $index }}</td>
                <td>{{ $row->mahasiswa->nim }}</td>
                <td>{{ $row->mahasiswa->nama_mahasiswa }}</td>
                <td>{{ $row->tugas_akhir->dosen->nama_dosen }}</td>
                <td>
                    @if ($row->jam_mulai_sidang && $row->jam_selesai_sidang != null)
                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $row->jam_mulai_sidang)->format('H:i') }} - {{
                    \Carbon\Carbon::createFromFormat('H:i:s', $row->jam_selesai_sidang)->format('H:i') }}
                    @else
                    -
                    @endif
                </td>
                <td>
                    1. {{ $row->penguji1->nama_dosen ?? '-' }} <br />
                    2. {{ $row->penguji2->nama_dosen ?? '-' }}
                </td>
                <td>
                    <div class="kumpulan-tombol" style="display: flex; justify-content:center">
                        <a href="{{ route('lengkapi-jadwal-b', $row->id) }}" class="btn btn-primary">Lengkapi</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="7">
                    <form action="{{ route('kirim-ke-akademik', $data->id) }}" method="POST"
                        style="display: flex; justify-content:center">
                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-success">Kirim ke akademik</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {{ $daftar->links() }}
    </div>
</div>
@endsection