@extends('layouts.master-admin')
@section('title', 'Detail Jadwal Final')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('jadwal-sidang') }}" class="btn btn-light" style="height: 40px;">
                <i class="fa-solid fa-arrow-left-long icon"></i> Kembali
            </a>
        </div>
    </div>
    <div class="menu-header" style="height: auto; padding: 20px 20px 5px 20px">
        <table class="table table-bordered" style="font-size: 15px">
            <tr>
                <td class="col-3">
                    <label for="periode">Periode</label>
                    <h5><b>P{{ $grup->periode_ke }}Y{{ $grup->yudisium_ke }}</b></h4>
                </td>
                <td class="col-3">
                    <label for="jenjang">Jenjang</label>
                    <h5><b>{{ $grup->program_studi->jenjang }}</b></h5>
                </td>
                <td class="col-3">
                    <label for="jurusan">Program Studi</label>
                    <h5><b>{{ $grup->program_studi->nama_prodi }}</b></h5>
                </td>
                <td class="col-3">
                    <label for="tahun_akademik">Tahun Akademik</label>
                    <h5><b>{{ $grup->tahun_akademik - 1 }}/{{ $grup->tahun_akademik }}</b></h5>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="ruangan">Ruangan</label>
                    <h5><b>@if ($grup->ruangan_id != null)
                            {{ $grup->ruangan->nama_ruangan}}, L{{ $grup->ruangan->lantai }}R{{$grup->ruangan->ruangan
                            }}
                            @else
                            -
                            @endif</b></h5>
                </td>
                <td>
                    <label for="tanggal_sidang">Tangal Sidang</label>
                    <h5><b>@if ($grup->tanggal_sidang != null)
                            {{ date('j F Y', strtotime($grup->tanggal_sidang))}}
                            @else
                            -
                            @endif</b></h5>
                </td>
                <td>
                    <label for="revisi">Batas Revisi</label>
                    <h5><b>@if ($grup->batas_revisi != null)
                            {{ date('j F Y', strtotime($grup->batas_revisi))}}
                            @else
                            -
                            @endif</b></h5>
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
            </tr>
            @endforeach
        </table>
        <div style="text-align:center; margin: 20px auto">
            @if ($grup->status_jadwal == 'published')
            <p class="btn btn-success">Sudah di-publish!</p>
            <div class="col-12" style="display: flex; justify-content:center">
                <a href="{{ route('jadwalPDF', $grup->id) }}" class="btn btn-success">Download Jadwal</a>
            </div>
            @else
            <form action="{{ route('publish-jadwal', $row->grup_id) }}" method="post">
                @csrf
                @method('put')
                <button type="submit" class="btn btn-success">Publish</i>
                </button>
            </form>
            @endif
        </div>
        {{ $daftar->links() }}
    </div>
</div>
@endsection