@extends('layouts.master-mahasiswa')
@section('title', 'Halaman Data Berita Acara Bimbingan')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('tambah-bimbingan') }}" class="btn btn-primary"><i class="fa-solid fa-plus icon"></i>
                TambahData
            </a>
        </div>
        <div class="input-group col-md-4 goes-right" style="margin-top: 10px; margin-left: 70px">
            <div class="input-group mb-3">
                <h5>bimbingan diterima : {{ $dataCount }}</h5>
            </div>
        </div>
    </div>
    <div class="row" style="height: 100%">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="col-1">No</th>
                    <th scope="col" class="col-1">Tanggal</th>
                    <th scope="col" class="col-4">Deskripsi Bimbingan</th>
                    <th scope="col" class="col-1">Status</th>
                    <th scope="col" class="col-1">aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $row)
                <tr>
                    <td>{{ $data->firstItem() + $index }}</td>
                    <td>{{ $row->tanggal_bimbingan }}</td>
                    <td style="white-space: pre-wrap">{{ $row->isi_bimbingan }}</td>
                    <td>
                        <div style="display: flex; justify-content:center">
                            @if ($row->status_bimbingan == 'diterima')
                            <span class="alert alert-success">{{ $row->status_bimbingan }}</span>
                            @elseif($row->status_bimbingan == 'ditolak')
                            <span class="alert alert-danger">{{ $row->status_bimbingan }}</span>
                            @else
                            {{ $row->status_bimbingan }}
                            @endif
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <div style="display: inline-flex; gap:5px">
                            {{-- <a href="/mahasiswa/lihat-bimbingan/{{ $row->id}}" class="btn btn-primary"><i
                                    class="fa-solid fa-eye icon"></i></a> --}}
                            @if ($row->status_bimbingan == 'diterima' || $row->status_bimbingan == 'ditolak')
                            <a href="/mahasiswa/edit-bimbingan/{{ $row->id }}/edit" class="btn btn-warning" hidden><i
                                    class="fa-solid fa-pencil icon"></i></a>
                            <form action="/mahasiswa/hapus-bimbingan/{{ $row->id }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah anda yakin ingin menghapus item ini?')" hidden><i
                                        class="fa-solid fa-trash icon"></i></button>
                            </form>
                            @else
                            <a href="/mahasiswa/edit-bimbingan/{{ $row->id }}/edit" class="btn btn-warning"><i
                                    class="fa-solid fa-pencil icon"></i></a>
                            <form action="/mahasiswa/hapus-bimbingan/{{ $row->id }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah anda yakin ingin menghapus item ini?')"><i
                                        class="fa-solid fa-trash icon"></i></button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
</div>
@endsection