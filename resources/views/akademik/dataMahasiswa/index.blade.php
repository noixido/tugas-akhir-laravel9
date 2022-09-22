@extends('layouts.master-admin')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="#" class="btn btn-primary">Tambah Data</a>
        </div>
        <div class="input-group col-md-4 goes-right">
            <form action="{{ route('data-mahasiswa') }}" method="GET" style="display: flex;">
                @csrf
                <input type="text" name="search" class="form-control" placeholder="cari mahasiswa..."
                    aria-label="Search" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
            </form>
        </div>
    </div>
    <div class="row">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Nim</th>
                    <th scope="col">Angkatan</th>
                    <th scope="col">Program Studi</th>
                    <th scope="col" class="col-1">aksi</th>
                </tr>
            </thead>
            <tbody>
                @if (count($data) > 0)
                @foreach ($data as $index => $row)
                <tr>
                    <td>{{ $index + $data -> firstItem() }}</td>
                    <td>{{ $row->nama }}</td>
                    <td>{{ $row->nim }}</td>
                    <td>{{ $row->angkatan }}</td>
                    <td>{{ $row->nama_prodi }}</td>
                    <td>
                        <div class="kumpulan-tombol">
                            <a href="" class="btn btn-primary">lihat</a>
                            <a href="" class="btn btn-warning">edit</a>
                            <a href="" class="btn btn-danger">hapus</a>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td>Tidak Ada Data!</td>
                </tr>
                @endif
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
</div>
@endsection