@extends('layouts.master-admin')
@section('title', 'Halaman Data Pendaftaran Sidang Tugas Akhir')
@section('content')
<div class="container">
    <div class="menu-header" style="height: 100%; padding-bottom: 30px">
        <form action="{{ route('data-pendaftaran-sidang') }}" class="row" style="margin: 0%; width: 100%">
            <div class="col-md-3">
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
            <div class="col-md-3">
                <label for="angkatan" class="form-label">Tahun Angkatan Mahasiswa</label>
                <select name="angkatan" id="angkatan"
                    class="form-control @error('angkatan') is-invalid @enderror"></select>
                @error('angkatan')
                <span class=" invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-3">
                <label for="dari" class="form-label">Tanggal Daftar (dari)</label>
                <input type="date" class="form-control" id="dari" name="dari" value="{{ \Request::get('dari') }}">
            </div>
            <div class="col-md-3">
                <label for="sampai" class="form-label">Tanggal Daftar (sampai)</label>
                <input type="date" class="form-control" id="sampai" name="sampai" value="{{ \Request::get('sampai') }}">
            </div>
            <div class="col-12" style="margin-top: 50px; display:flex; justify-content: space-between">
                <button type="submit" formaction="{{ route('export-data-pendaftaran-sidang') }}"
                    class="btn btn-warning"><i class="fa-solid fa-file-export"></i> Export</button>
                <div>
                    <button type="submit" class="btn btn-light"><i class="fa-solid fa-sliders"></i> Filter</button>
                    <a href="{{ route('data-pendaftaran-sidang') }}" class="btn btn-danger"><i
                            class="fa-solid fa-xmark"></i>
                        Reset</a>
                </div>
            </div>
        </form>
        {{-- <div class="input-group col-md-8">
            <a href="{{ route('export-data-pendaftaran-sidang') }}" class="btn btn-warning"><i
                    class="fa-solid fa-file-export"></i> Export</a>
        </div> --}}
    </div>
    <div class="row" style="height: auto">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">@sortablelink('created_at', 'Tanggal Daftar')</th>
                    <th scope="col">@sortablelink('mahasiswa.nim', 'NIM')</th>
                    <th scope="col">@sortablelink('mahasiswa.nama_mahasiswa', 'Nama Mahasiswa')</th>
                    <th scope="col">@sortablelink('program_studi.jenjang', 'Jenjang')</th>
                    <th scope="col">@sortablelink('program_studi.nama_prodi', 'Program Studi')</th>
                    <th scope="col">@sortablelink('status_pendaftaran', 'Status')</th>
                    <th scope="col" class="col-1">aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $row)
                <tr>
                    <td>{{ $data->firstItem() + $index }}</td>
                    <td>{{ $row->created_at }}</td>
                    <td>{{ $row->mahasiswa->nim }}</td>
                    <td>{{ $row->mahasiswa->nama_mahasiswa }}</td>
                    <td>{{ $row->program_studi->jenjang }}</td>
                    <td>{{ $row->program_studi->nama_prodi }}</td>
                    <td>{{ $row->status_pendaftaran }}</td>
                    <td>
                        <div class="kumpulan-tombol">
                            <a href="/akademik/lihat-pendaftaran/{{ $row->mahasiswa_id }}" class="btn btn-primary"><i
                                    class="fa-solid fa-eye icon"></i></a>
                            <form action="/akademik/hapus-pendaftaran/{{ $row->mahasiswa_id }}" method="post">
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
<script>
    (() => {
    let option = '<option value="" disabled selected>== Pilih Tahun ==</option>'; // first option
    let year_start = 1940;
    let year_end = (new Date).getFullYear(); // current year
    let year_selected = parseInt("{{ \Request::get('angkatan') }}");
    
    for (let i = year_start; i <= year_end; i++) { let selected=(i===year_selected ? ' selected' : '' ); option
        +='<option value="' + i + '"' + selected + '>' + i + '</option>' ; }
        document.getElementById("angkatan").innerHTML=option; })();
</script>
@endsection