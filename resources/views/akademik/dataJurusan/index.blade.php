@extends('layouts.master-admin')
@section('title', 'Halaman Data Jurusan')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('tambah-jurusan') }}" class="btn btn-primary"><i class="fa-solid fa-plus icon"></i>
                Tambah
                Data</a>
        </div>
        <div class="input-group col-md-4 goes-right">
            <form action="{{ route('data-jurusan') }}" method="GET" style="display: flex;">
                @csrf
                <input type="text" name="search" value="{{ old('search') }}" class="form-control"
                    placeholder="cari jurusan..." aria-label="Search" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i
                        class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </div>
    <div class="row" style="height: 800px">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="col-1">No</th>
                    <th scope="col" class="col-2">@sortablelink('kode_prodi', 'Kode Program Studi')</th>
                    <th scope="col" class="col-1">@sortablelink('jenjang', 'Jenjang')</th>
                    <th scope="col">@sortablelink('nama_prodi', 'Nama Program Studi')</th>
                    <th scope="col">@sortablelink('konsentrasi', 'Konsentrasi')</th>
                    <th scope="col" class="col-1">aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $index => $row)
                <tr>
                    <td>{{ $data->firstItem() + $index }}</td>
                    <td>{{ $row->kode_prodi}}</td>
                    <td>{{ $row->jenjang}}</td>
                    <td>{{ $row->nama_prodi}}</td>
                    <td>{{ $row->konsentrasi ?? '-'}}</td>
                    <td style="text-align: center;">
                        <div style="display: inline-flex; gap:5px">
                            <a href="/akademik/edit-jurusan/{{ $row->id }}/edit" class="btn btn-warning"><i
                                    class="fa-solid fa-pencil icon"></i></a>
                            <form action="/akademik/hapus-jurusan/{{ $row->id }}" method="POST">
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