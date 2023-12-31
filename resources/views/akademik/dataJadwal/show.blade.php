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
                    <h5><b>{{ $data->tahun_akademik - 1 }}/{{ $data->tahun_akademik }}</b></h5>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="sidang">Tanggal Sidang</label>
                    <h5><b>{{ date('j F Y', strtotime($data->tanggal_sidang))}}</b></h5>
                </td>
                <td>
                    <label for="revisi">Batas Revisi</label>
                    <h5><b>{{ date('j F Y', strtotime($data->batas_revisi))}}</b></h5>
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

                <th scope="col" class="col-1">Jam Sidang</th>
                <th scope="col" class="col-1">Aksi</th>

            </tr>
            @foreach ($daftar as $index => $row)
            <tr>
                <td>{{ $daftar->firstItem() + $index }}</td>
                <td>{{ $row->mahasiswa->nim }}</td>
                <td>{{ $row->mahasiswa->nama_mahasiswa }}</td>
                <td>{{ $row->tugas_akhir->dosen->nama_dosen }}</td>
                <td>{{ $row->tugas_akhir->judul_tugas_akhir }}</td>

                <td>
                    @if ($row->jam_mulai_sidang && $row->jam_selesai_sidang != null)
                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $row->jam_mulai_sidang)->format('H:i') }} - {{
                    \Carbon\Carbon::createFromFormat('H:i:s', $row->jam_selesai_sidang)->format('H:i') }}
                    @else
                    -
                    @endif
                </td>
                <td>
                    <div class="kumpulan-tombol" style="display: flex; justify-content:center">
                        <a href="{{ route('lengkapi-jam', $row->id) }}" class="btn btn-primary">Lengkapi</a>
                    </div>
                </td>

            </tr>
            @endforeach
            <tr>
                <td colspan="7">
                    <div style="display: flex; justify-content:center">
                        <form action="{{ route('kirim-ke-prodi', $row->grup_id) }}" method="POST">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-success">Kirim ke prodi</button>
                        </form>
                    </div>
                </td>
            </tr>

        </table>
        {{ $daftar->links() }}
    </div>
</div>
@endsection