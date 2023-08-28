@extends('layouts.master-admin')
@section('title', 'Halaman Data Admin')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('tambah-admin') }}" class="btn btn-primary"><i class="fa-solid fa-plus icon"></i>
                Tambah
                Data</a>
        </div>
        <div class="input-group col-md-4 goes-right">
            <form action="{{ route('data-admin') }}" method="GET" style="display: flex;">
                @csrf
                <input type="text" name="search" value="{{ old('search') }}" class="form-control"
                    placeholder="cari admin..." aria-label="Search" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i
                        class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </div>
    <div class="row" style="height: 800px">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">@sortablelink('user.username', 'Username')</th>
                    <th scope="col">@sortablelink('nama_admin', 'Nama')</th>
                    <th scope="col">aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $index => $row)
                <tr>
                    <td>{{ $data->firstItem() + $index }}</td>
                    <td>{{ $row->user->username }}</td>
                    <td>{{ $row->nama_admin }}</td>
                    <td style="text-align: center;">
                        <div style="display: inline-flex; gap:5px">
                            <a href="/akademik/edit-admin/{{ $row->user_id }}/edit" class="btn btn-warning"><i
                                    class="fa-solid fa-pencil icon"></i></a>
                            <form action="/akademik/hapus-admin/{{ $row->user_id }}" method="POST">
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