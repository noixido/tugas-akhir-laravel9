@extends('layouts.master-admin')
@section('title', 'Halaman Data Nilai Sidang')
@section('content')
<div class="container">
    <div class="menu-header" style="height: 100%; padding-bottom: 30px">
        <form action="{{ route('data-nilai') }}" class="row" style="margin: 0%; width: 100%">
            <div class="col-md-4">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ \Request::get('nama') }}">
            </div>
            <div class="col-md-4">
                <label for="nim" class="form-label">Nomor Induk Mahasiswa</label>
                <input type="text" class="form-control" id="nim" name="nim" value="{{ \Request::get('nim') }}">
            </div>
            <div class="col-md-4">
                <label for="jurusan" class="form-label">Program Studi</label>
                <select id="jurusan" class="form-select form-control" name="jurusan">
                    <option value="" selected disabled>=== Pilih ===</option>
                    @foreach ($prodi as $row)
                    @if (old('jurusan', \Request::get('jurusan')) == $row->id)
                    <option value="{{ $row->id }}" selected>{{ $row->jenjang }} {{ $row->nama_prodi }}, {{
                        $row->konsentrasi ??
                        "" }}
                    </option>
                    @else
                    <option value="{{ $row->id }}">{{ $row->jenjang }} {{ $row->nama_prodi }}, {{ $row->konsentrasi ??
                        "" }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-12" style="margin-top: 50px; display:flex; justify-content: space-between">
                <a href="{{ route('export-data-nilai') }}" class="btn btn-warning"><i
                        class="fa-solid fa-file-export"></i> Export</a>
                <div>
                    <button type="submit" class="btn btn-light"><i class="fa-solid fa-sliders"></i> Filter</button>
                    <a href="{{ route('data-nilai') }}" class="btn btn-danger"><i class="fa-solid fa-xmark"></i>
                        Reset</a>
                </div>
            </div>
        </form>
    </div>
    <div class="row" style="height: 100%">
        @include('akademik.dataNilai.nilai-tabel')

        {{-- {{ $data->links() }} --}}
        {{-- {!! $data->appends(\Request::except('page'))->render() !!} --}}
    </div>
</div>
@endsection