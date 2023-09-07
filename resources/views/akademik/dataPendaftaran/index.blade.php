@extends('layouts.master-admin')
@section('title', 'Halaman Data Pendaftaran Sidang Tugas Akhir')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('export-data-pendaftaran-sidang') }}" class="btn btn-warning"><i
                    class="fa-solid fa-file-export"></i> Export</a>
        </div>
        <div class="input-group col-md-4 goes-right">
            <form action="{{ route('data-pendaftaran-sidang') }}" method="GET" style="display: flex;">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="search" value="{{ old('search') }}" class="form-control"
                        placeholder="cari pendaftaran..." aria-label="Search" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="row" style="height: 100%">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">@sortablelink('created_at', 'Tanggal Daftar')</th>
                    <th scope="col">@sortablelink('mahasiswa.nim', 'NIM')</th>
                    <th scope="col">@sortablelink('mahasiswa.nama_mahasiswa', 'Nama Mahasiswa')</th>
                    <th scope="col">@sortablelink('program_studi.jenjang', 'Jenjang')</th>
                    <th scope="col">@sortablelink('program_studi.nama_prodi', 'Program Studi')</th>
                    <th scope="col" class="col-1">aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $row)
                <tr>
                    <td>{{ $data->firstItem() + $index }}</td>
                    <td>{{ $row->created_at }}</td>
                    <td>{{ $row->mahasiswa->nim }}</td>
                    <td>{{ $row->mahasiswa->nama_mahasiswa }}</td>
                    <td>{{ $row->program_studi->jenjang }}</td>
                    <td>{{ $row->program_studi->nama_prodi }}</td>
                    <td>
                        <div class="kumpulan-tombol">
                            <a href="/akademik/lihat-pendaftaran/{{ $row->mahasiswa_id }}" class="btn btn-primary"><i
                                    class="fa-solid fa-eye icon"></i></a>
                            <form action="/akademik/hapus-pendaftaran/{{ $row->mahasiswa_id }}" method="post">
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