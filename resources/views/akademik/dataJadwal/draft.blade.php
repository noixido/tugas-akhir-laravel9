@extends('layouts.master-admin')
@section('title', 'Halaman Draft Jadwal')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('tambah-draft') }}" class="btn btn-primary"><i class="fa-solid fa-plus icon"></i>
                Tambah
                Data</a>
        </div>
    </div>
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
                            <form action="{{ route('kirim-ke-prodi', $row->id) }}" method="POST">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-success">Kirim ke prodi</button>
                            </form>
                            <a href="{{ route('detail-draft-jadwal', $row->id) }}" class="btn btn-primary"><i
                                    class="fa-solid fa-eye icon"></i></a>
                            <form action="{{ route('hapus-draft', $row->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah anda yakin ingin menghapus item ini?')"><i
                                        class="fa-solid fa-trash icon"></i></button>
                            </form>
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