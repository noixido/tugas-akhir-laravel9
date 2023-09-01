@extends('layouts.master-staffprodi')
@section('title', 'Halaman Draft Jadwal')
@section('content')
<div class="container">
    <div class="row" style="height: auto">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal Draft Dibuat</th>
                    <th scope="col">Periode</th>
                    <th scope="col">Jenjang</th>
                    <th scope="col">Program Studi</th>
                    <th scope="col">Tahun Akademik</th>
                    <th scope="col">aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $row)
                <tr>
                    <td>{{ $data->firstItem() + $index }}</td>
                    <td>{{ $row->created_at }}</td>
                    <td>P{{ $row->periode_ke }}Y{{ $row->yudisium_ke }}</td>
                    <td>{{ $row->program_studi->jenjang }}</td>
                    <td>{{ $row->program_studi->nama_prodi }}</td>
                    <td>{{ $row->tahun_akademik - 1 }}/{{ $row->tahun_akademik }}</td>
                    <td>
                        <div class="kumpulan-tombol" style="display: flex; justify-content:center">
                            <a href="{{ route('detail-jadwal', $row->id) }}" class="btn btn-primary"><i
                                    class="fa-solid fa-eye icon"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
        {{-- {!! $data->appends(\Request::except('page'))->render() !!} --}}
    </div>
</div>
@endsection