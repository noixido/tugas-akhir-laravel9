@extends('layouts.master-dosen')
@section('title', 'Halaman Bimbingan Mahasiswa')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('dosen-bimbingan') }}" class="btn btn-light" style="height: 40px;">
                <i class="fa-solid fa-arrow-left-long icon"></i> Kembali
            </a>
        </div>
    </div>
    <div class="menu-header" style="height: 230px; padding: 20px">
        <table class="table table-bordered" style="font-size: 15px">
            <tr>
                <td class="col-6">
                    <label for="nama">Nama Mahasiswa</label>
                    <h5 style="display: flex; justify-content: space-between"><b>{{ $ta->nama_mahasiswa }}</b> <a
                            href="{{ route('profile-mahasiswa', $ta->mahasiswa_id) }}" style="text-decoration: none"><i
                                class="fa-solid fa-eye"></i></a></h4>
                </td>
                <td>
                    <label for="nim">Nomor Induk Mahasiswa</label>
                    <h5><b>{{ $ta->nim }}</b></h5>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="judul">Judul Tugas Akhir</label>
                    <h5><b>{{ $ta->judul_tugas_akhir }}</b></h5>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="height: 100%">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="col-1">No</th>
                    <th scope="col" class="col-1">Tanggal Bimbingan</th>
                    <th scope="col" class="col-4">Deskripsi Bimbingan</th>
                    <th scope="col" class="col-1">Status</th>
                    <th scope="col" class="col-1">aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bimbingan as $index => $row)
                <tr>
                    <td>{{ $bimbingan->firstItem() + $index }}</td>
                    <td>{{ $row->tanggal_bimbingan }}</td>
                    <td style="white-space: pre-wrap">{{ $row->isi_bimbingan }}</td>
                    <td>{{ $row->status_bimbingan }}</td>
                    <td style="text-align: center; ">
                        <div style="display: inline-flex; gap:5px">
                            <form action="/dosen/diterima/{{ $row->bimbingan_id }}" method="POST">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-success">Terima</button>
                            </form>
                            {{-- <a href="/dosen/diterima/{{ $row->bimbingan_id }}">test</a> --}}
                            <form action="/dosen/ditolak/{{ $row->bimbingan_id }}" method="POST">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-danger">Tolak</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $bimbingan->links() }}
    </div>
</div>
@endsection