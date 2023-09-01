@extends('layouts.master-admin')
@section('title', 'Halaman Data Ruangan')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('tambah-ruangan') }}" class="btn btn-primary"><i class="fa-solid fa-plus icon"></i>
                Tambah
                Data</a>
        </div>
        <div class="input-group col-md-4 goes-right">
            <form action="{{ route('data-ruangan') }}" method="GET" style="display: flex;">
                @csrf
                <input type="text" name="search" value="{{ old('search') }}" class="form-control"
                    placeholder="cari ruangan..." aria-label="Search" aria-describedby="button-addon2">
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
                    <th scope="col" class="col-1">@sortablelink('nama_ruangan','Nama Ruangan')</th>
                    <th scope="col" class="col-1">@sortablelink('lantai','Lantai')</th>
                    <th scope="col" class="col-1">@sortablelink('ruangan','Ruangan')</th>
                    <th scope="col" class="col-1">aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $index => $row)
                <tr>
                    <td>{{ $data->firstItem() + $index }}</td>
                    <td>{{ $row->nama_ruangan}}</td>
                    <td>{{ $row->lantai}}</td>
                    <td>{{ $row->ruangan}}</td>
                    <td style="text-align: center;">
                        <div style="display: inline-flex; gap:5px">
                            <a href="/akademik/edit-ruangan/{{ $row->id }}/edit" class="btn btn-warning"><i
                                    class="fa-solid fa-pencil icon"></i></a>
                            <form action="/akademik/hapus-ruangan/{{ $row->id }}" method="POST">
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