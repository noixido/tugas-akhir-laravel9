@extends('layouts.master-admin')
@section('title', 'Tambah Data Mahasiswa')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('draft-jadwal') }}" class="btn btn-light" style="height: 40px;">
                <i class="fa-solid fa-arrow-left-long icon"></i> Kembali
            </a>
        </div>
    </div>
    <div class="row" style="height: auto">
        <form action="{{ route('proses-tambah-draft') }}" class="row" style="margin: 0%" method="POST">
            @csrf
            <div class="col-md-6">
                <label for="periode" class="form-label">Periode Ke</label>
                <input type="number" class="form-control @error('periode') is-invalid @enderror" id="periode"
                    name="periode" value="{{ old('periode') }}">
                @error('periode')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="yudisium" class="form-label">Yudisium Ke</label>
                <input type="number" class="form-control @error('yudisium') is-invalid @enderror" id="yudisium"
                    name="yudisium" value="{{ old('yudisium') }}">
                @error('yudisium')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="jurusan" class="form-label">Program Studi</label>
                <select id="jurusan" class="form-select form-control @error('jurusan') is-invalid @enderror"
                    name="jurusan" onchange="jurusanKeubah(this)">
                    <option value="" selected disabled>=== Pilih ===</option>
                    @foreach ($prodi as $row)
                    @if (old('jurusan') == $row->id)
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
                @error('jurusan')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="tahun" class="form-label">Tahun Akademik</label>
                <input type="text" class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun"
                    value="{{ old('tahun') }}">
                @error('tahun')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-12" style="margin-top: 15px">
                <label for="mahasiswa_daftar" class="form-label">Daftar Mahasiswa Pendaftaran Sidang Tugas Akhir</label>
                <table class="table table-bordered" id="tabel-pendaftaran">
                    <tr>
                        <th scope="col" class="col-1"><input type="checkbox" name="cbParent"></th>
                        <th scope="col" class="col-2">NIM</th>
                        <th scope="col" class="col-2">Nama Mahasiswa</th>
                        <th scope="col" class="col-2">Tanggal Daftar</th>
                        <th scope="col" class="col-1">Jenjang</th>
                        <th scope="col" class="col-2">Program Studi</th>
                    </tr>
                    @foreach ($data as $row)
                    <tr data-jurusan="{{ $row->program_studi->id }}">
                        <td><input type="checkbox" name="daftarSidang[]" value="{{ $row->id }}"></td>
                        <td>{{ $row->mahasiswa->nim }}</td>
                        <td>{{ $row->mahasiswa->nama_mahasiswa }}</td>
                        <td>{{ $row->created_at }}</td>
                        <td>{{ $row->program_studi->jenjang }}</td>
                        <td>{{ $row->program_studi->nama_prodi }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-12" style="margin-bottom: 20px">
                <button type="submit" class="btn btn-primary">+ Tambah</button>
            </div>
        </form>
    </div>
</div>

<script>
    function jurusanKeubah(event) {
    const jurusanId = event.value;
    const tabel = document.getElementById('tabel-pendaftaran');
    const iterator = tabel.querySelectorAll('tr').entries();
    iterator.next();
    let entry = iterator.next();
    while (!entry.done) {
        const element = entry.value[1];
        entry = iterator.next();
        if (element.getAttribute('data-jurusan') == jurusanId) {
            element.classList.remove('d-none');
            continue;
        };
        if (element.querySelector('input')) element.querySelector('input').checked = false;
        element.classList.add('d-none');

    }
}
</script>
@endsection