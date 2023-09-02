@extends('layouts.master-dosen')
@section('title', 'Halaman Penilaian Sidang')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('detail-nilai-sidang', $daftar->grup_id) }}" class="btn btn-light" style="height: 40px;">
                <i class="fa-solid fa-arrow-left-long icon"></i> Kembali
            </a>
        </div>
    </div>
    <div class="menu-header" style="height: auto; padding: 20px 20px 5px 20px">
        <table class="table table-bordered">
            <tr>
                <th scope="col" class="col-6">Nama Mahasiswa</th>
                <td scope="col" class="col-6">{{ $daftar->mahasiswa->nama_mahasiswa }}</td>
            </tr>
            <tr>
                <th>Nomor Induk Mahasiswa</th>
                <td>{{ $daftar->mahasiswa->nim }}</td>
            </tr>
            <tr>
                <th>Program Studi</th>
                <td>{{ $daftar->program_studi->jenjang }} {{ $daftar->program_studi->nama_prodi }}</td>
            </tr>
            <tr>
                <th>Konsentrasi</th>
                <td>{{ $daftar->program_studi->konsentrasi ?? '-' }}</td>
            </tr>
            <tr>
                <th>Dosen Pembimbing</th>
                <td>{{ $daftar->tugas_akhir->dosen->nama_dosen }}</td>
            </tr>
            <tr>
                <th>Judul Tugas Akhir</th>
                <td>{{ $daftar->tugas_akhir->judul_tugas_akhir }}</td>
            </tr>
        </table>
    </div>
    <div class="row" style="height: auto; margin-top: 10px">
        <table class="table table-bordered">
            <tr>
                <td>
                    <label for="nilai_pembimbing">Nilai Pembimbing</label>
                    <h5><b>{{ $nilai->nilai_pembimbing ?? '-' }}</b></h4>
                </td>
                <td>
                    <label for="nilai_penguji_1">Nilai Penguji 1</label>
                    <h5><b>{{ $nilai->nilai_penguji_1 ?? '-' }}</b></h4>
                </td>
                <td>
                    <label for="nilai_penguji_2">Nilai Penguji 2</label>
                    <h5><b>{{ $nilai->nilai_penguji_2 ?? '-' }}</b></h4>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="height: auto; margin-top: 10px; margin-bottom: 20px">
        <form action="{{ route('proses-input-nilai', $daftar->id) }}" method="POST" style="width: 100%">
            @csrf
            @method('put')
            <table class="table table-bordered">
                <tr>
                    <th><label for="nilai_pembimbing">Nilai Pembimbing</label></th>
                    <th><label for="nilai_penguji_1">Nilai Penguji 1</label></th>
                    <th><label for="nilai_penguji_2">Nilai Penguji 2</label></th>
                </tr>
                <tr>
                    <td>
                        @if ($daftar->tugas_akhir->dosen_id != $dosen->id)
                        <input type="number" step="any"
                            class="form-control @error('nilai_pembimbing') is-invalid @enderror" id="nilai_pembimbing"
                            name="nilai_pembimbing"
                            value="{{ old('nilai_pembimbing', $nilai->nilai_pembimbing ?? null) }}" readonly>
                        @error('nilai_pembimbing')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        @else
                        <input type="number" step="any"
                            class="form-control @error('nilai_pembimbing') is-invalid @enderror" id="nilai_pembimbing"
                            name="nilai_pembimbing"
                            value="{{ old('nilai_pembimbing', $nilai->nilai_pembimbing ?? null) }}">
                        @error('nilai_pembimbing')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        @endif
                    </td>
                    <td>
                        @if ($daftar->penguji_1 != $dosen->id)
                        <input type="number" step="any"
                            class="form-control @error('nilai_penguji_1') is-invalid @enderror" id="nilai_penguji_1"
                            name="nilai_penguji_1" value="{{ old('nilai_penguji_1', $nilai->nilai_penguji_1 ?? null) }}"
                            readonly>
                        @error('nilai_penguji_1')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        @else
                        <input type="number" step="any"
                            class="form-control @error('nilai_penguji_1') is-invalid @enderror" id="nilai_penguji_1"
                            name="nilai_penguji_1"
                            value="{{ old('nilai_penguji_1', $nilai->nilai_penguji_1 ?? null) }}">
                        @error('nilai_penguji_1')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        @endif
                    </td>
                    <td>
                        @if ($daftar->penguji_2 != $dosen->id)
                        <input type="number" step="any"
                            class="form-control @error('nilai_penguji_2') is-invalid @enderror" id="nilai_penguji_2"
                            name="nilai_penguji_2" value="{{ old('nilai_penguji_2', $nilai->nilai_penguji_2 ?? null) }}"
                            readonly>
                        @error('nilai_penguji_2')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        @else
                        <input type="number" step="any"
                            class="form-control @error('nilai_penguji_2') is-invalid @enderror" id="nilai_penguji_2"
                            name="nilai_penguji_2"
                            value="{{ old('nilai_penguji_2', $nilai->nilai_penguji_2 ?? null) }}">
                        @error('nilai_penguji_2')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center">
                        <button type="submit" class="btn btn-primary">Tambah Nilai</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
@endsection