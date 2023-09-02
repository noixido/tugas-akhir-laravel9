@extends('layouts.master-admin')
@section('title', 'Halaman Finalisasi Jadwal')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-4 goes-right" style="margin-left:773px">

        </div>
    </div>
    <div class="row" style="height: 100% ">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="col-1">No</th>
                    <th scope="col" class="col-1">Tanggal Sidang</th>
                    <th scope="col" class="col-1">Periode</th>
                    <th scope="col" class="col-1">Jenjang</th>
                    <th scope="col" class="col-1">Program Studi</th>
                    <th scope="col" class="col-1">Tahun Akademik</th>
                    <th scope="col" class="col-1">aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grup as $index => $row)
                <tr>
                    <td>{{ $grup->firstItem() + $index }}</td>
                    <td>{{ $row->tanggal_sidang }}</td>
                    <td>P{{ $row->periode_ke }}Y{{ $row->yudisium_ke }}</td>
                    <td>{{ $row->program_studi->jenjang }}</td>
                    <td>{{ $row->program_studi->nama_prodi }}</td>
                    <td>{{ $row->tahun_akademik-1 }}/{{ $row->tahun_akademik }}</td>
                    <td>
                        <div class="kumpulan-tombol" style="display: flex; justify-content:center">
                            <a href="{{ route('detail-jadwal-sidang', $row->id) }}" class="btn btn-primary"><i
                                    class="fa-solid fa-eye icon"></i></a>
                            @if ($row->status_jadwal == 'published')
                            <form action="{{ route('publish-jadwal', $row->id) }}" method="post">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-success" hidden>Publish</i>
                                </button>
                            </form>
                            @else
                            <form action="{{ route('publish-jadwal', $row->id) }}" method="post">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-success">Publish</i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $grup->links() }}
        {{-- {!! $data->appends(\Request::except('page'))->render() !!} --}}
    </div>
</div>
@endsection