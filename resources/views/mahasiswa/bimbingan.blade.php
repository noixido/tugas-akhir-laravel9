@extends('layouts.master-mahasiswa')
@section('title', 'Halaman Berita Acara Bimbingan')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('tambah-bimbingan') }}" class="btn btn-primary"><i class="fa-solid fa-plus icon"></i>
                Tambah
                Data</a>
        </div>
        <div class="input-group col-md-4 goes-right">
            <form action="" method="GET" style="display: flex;">
                @csrf
                <input type="text" name="search" value="{{ old('search') }}" class="form-control"
                    placeholder="cari detail bimbingan..." aria-label="Search" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i
                        class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </div>
    <div class="menu-header" style="display: flex; justify-content: space-between; height: 150px;">
        <div class="col-sm-4" style="margin-right: -100px">
            <label for="dosen" class="form-label">Dosen Pembimbing</label>
            <h5>Castaka Agus S</h5>
        </div>
        <div class="col-sm-4">
            <label for="tugas-akhir" class="form-label">Judul Tugas Akhir</label>
            <p style="font-size: 20px; width: 500px">{{ $data->judul_tugas_akhir }}</p>
        </div>
        <div class="col-sm-3" style="margin-left: 280px; margin-top: 30px">
            <a href="#" class="btn btn-warning">Perbarui Tugas
                Akhir</a>
        </div>
    </div>
    {{-- <div class="row" style="height: 800px">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="col-1">No</th>
                    <th scope="col" class="col-1">Tanggal Bimbingan</th>
                    <th scope="col" class="col-2">Deskripsi Bimbingan</th>
                    <th scope="col" class="col-1">Status</th>
                    <th scope="col" class="col-1">aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach($data as $index => $row)
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
                @endforeach --}}
                {{--
            </tbody>
        </table> --}}
        {{-- {{ $data->links() }} --}}
        {{--
    </div> --}}
</div>
@endsection