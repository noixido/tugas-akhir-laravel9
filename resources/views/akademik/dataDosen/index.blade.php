@extends('layouts.master-admin')
@section('title', 'Halaman Data Dosen')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('tambah-dosen') }}" class="btn btn-primary"><i class="fa-solid fa-plus icon"></i>
                Tambah
                Data</a>
        </div>
        <div class="input-group col-md-4 goes-right">
            <form action="{{ route('data-dosen') }}" method="GET" style="display: flex;">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="search" value="{{ old('search') }}" class="form-control"
                        placeholder="cari dosen..." aria-label="Search" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="col-1">No</th>
                    <th scope="col" class="col-2">Nomor Induk Dosen</th>
                    <th scope="col" class="col-2">Nama</th>
                    <th scope="col" class="col-1">jenjang</th>
                    <th scope="col" class="col-2">Program Studi</th>
                    <th scope="col" class="col-2">aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $row)
                <tr>
                    <td>{{ $data->firstItem() + $index }}</td>
                    <td>{{ $row->nidn }}</td>
                    <td>{{ $row->nama_dosen }}</td>
                    <td>{{ $row->jenjang }}</td>
                    <td>{{ $row->nama_prodi }}</td>
                    <td>
                        <div class="kumpulan-tombol">
                            <a href="/akademik/lihat-dosen/{{ $row->user_id }}" class="btn btn-primary"><i
                                    class="fa-solid fa-eye icon"></i></a>
                            <a href="/akademik/edit-dosen/{{ $row->user_id }}/edit" class="btn btn-warning"><i
                                    class="fa-solid fa-pencil icon"></i></a>
                            <form action="/akademik/hapus-dosen/{{ $row->user_id }}" method="post">
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