@extends('layouts.master-dosen')
@section('title', 'Halaman Data Nilai Sidang Mahasiswa')
@section('content')
<div class="container">
    <div class="menu-header">

    </div>
    <div class="row" style="height: 100%; margin-bottom:20px">
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Tanggal Sidang</th>
                <th>Periode Sidang</th>
                <th>Ruangan Sidang</th>
                <th>Tahun Akademik</th>
                <th>Aksi</th>
            </tr>
            @foreach ($grup as $index => $item)
            <tr>
                <td>{{ $grup->firstItem() + $index }}</td>
                <td>{{ $item->tanggal_sidang }}</td>
                <td>P{{ $item->periode_ke }}Y{{ $item->yudisium_ke }}</td>
                <td>{{ $item->ruangan->nama_ruangan }}, L{{ $item->ruangan->lantai }}R{{ $item->ruangan->ruangan }}</td>
                <td>{{ $item->tahun_akademik - 1 }}/{{ $item->tahun_akademik }}</td>
                <td>
                    <div style="text-align: center">
                        <a href="{{ route('detail-nilai-sidang', $item->id) }}" class="btn btn-primary">Lihat</a>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
        {{ $grup->links() }}
    </div>
</div>
@endsection