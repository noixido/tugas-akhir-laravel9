@extends('layouts.master-admin')
@section('title', 'Halaman Data Mahasiswa')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <div>
                <a href="{{ route('tambah-mahasiswa') }}" class="btn btn-primary"><i class="fa-solid fa-plus icon"></i>
                    Tambah
                    Data</a>
            </div>
            <div>
                <form action="{{ route('import-data-mahasiswa') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div style=" position: relative; overflow: hidden; margin-left: 10px" class="btn btn-success">
                        <input type="file" name="import" id="import" onchange="form.submit()"
                            style="cursor: pointer; position: absolute; font-size: 50px; opacity: 0; right: 0; top: 0;"><i
                            class="fa-solid fa-file-import"></i> Import
                    </div>
                </form>
            </div>
            <div style="margin-left: 10px">
                <a href="{{ route('download-import-data-mahasiswa') }}" class="btn btn-warning"><i
                        class="fa-solid fa-download"></i> Template Import</a>
            </div>
        </div>
        <div class="input-group col-md-4 goes-right">
            <form action="{{ route('data-mahasiswa') }}" method="GET" style="display: flex;">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="search" value="{{ old('search') }}" class="form-control"
                        placeholder="cari mahasiswa..." aria-label="Search" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="row" style="height: auto">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="col-1">No</th>
                    <th scope="col" class="col-1">@sortablelink('nim', 'Nomor Induk Mahasiswa')</th>
                    <th scope="col" class="col-2">@sortablelink('nama_mahasiswa', 'Nama')</th>
                    <th scope="col" class="col-1">@sortablelink('angkatan', 'Angkatan')</th>
                    <th scope="col" class="col-1">@sortablelink('program_studi.jenjang', 'Jenjang')</th>
                    <th scope="col" class="col-2">@sortablelink('program_studi.nama_prodi', 'Program Studi')</th>
                    <th scope="col" class="col-1">aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $row)
                <tr>
                    <td>{{ $data->firstItem() + $index }}</td>
                    <td>{{ $row->nim }}</td>
                    <td>{{ $row->nama_mahasiswa }}</td>
                    <td>{{ $row->angkatan ?? '-'}}</td>
                    <td>{{ $row->program_studi->jenjang ?? '-' }}</td>
                    <td>{{ $row->program_studi->nama_prodi ?? '-' }}</td>
                    <td>
                        <div class="kumpulan-tombol">
                            <a href="/akademik/lihat-mahasiswa/{{ $row->user_id }}" class="btn btn-primary"><i
                                    class="fa-solid fa-eye icon"></i></a>
                            <a href="/akademik/edit-mahasiswa/{{ $row->user_id }}/edit" class="btn btn-warning"><i
                                    class="fa-solid fa-pencil icon"></i></a>
                            <form action="/akademik/hapus-mahasiswa/{{ $row->user_id }}" method="post">
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
        {{-- {{ $data->links() }} --}}
        {!! $data->appends(\Request::except('page'))->render() !!}
    </div>
</div>
@endsection