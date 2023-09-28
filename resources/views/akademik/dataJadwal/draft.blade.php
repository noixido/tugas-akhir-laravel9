@extends('layouts.master-admin')
@section('title', 'Halaman Draft Jadwal')
@section('content')
<div class="container">
    <div class="menu-header" style="height: 100%; padding-bottom: 30px">
        <form action="{{ route('draft-jadwal') }}" class="row" style="margin: 0%; width: 100%">
            <div class="col-md-4">
                <label for="periode" class="form-label">Periode</label>
                <select id="periode" class="form-select form-control" name="periode">
                    <option value="" selected disabled>=== Pilih ===</option>
                    @foreach ($periode as $row)
                    @if (old('periode', \Request::get('periode')) == $row->periode_ke)
                    <option value="{{ $row->periode_ke }}" selected>{{ $row->periode_ke }}</option>
                    @else
                    <option value="{{ $row->periode_ke }}">{{ $row->periode_ke }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="yudisium" class="form-label">Yudisium</label>
                <select id="yudisium" class="form-select form-control" name="yudisium">
                    <option value="" selected disabled>=== Pilih ===</option>
                    @foreach ($yudisium as $row)
                    @if (old('yudisium', \Request::get('yudisium')) == $row->yudisium_ke)
                    <option value="{{ $row->yudisium_ke }}" selected>{{ $row->yudisium_ke }}</option>
                    @else
                    <option value="{{ $row->yudisium_ke }}">{{ $row->yudisium_ke }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="tahun" class="form-label">Tahun Akademik</label>
                <select id="tahun" class="form-select form-control" name="tahun">
                    <option value="" selected disabled>=== Pilih ===</option>
                    @foreach ($tahun as $row)
                    @if (old('tahun', \Request::get('tahun')) == $row->tahun_akademik)
                    <option value="{{ $row->tahun_akademik }}" selected>{{ $row->tahun_akademik - 1 }}/{{
                        $row->tahun_akademik }}</option>
                    @else
                    <option value="{{ $row->tahun_akademik }}">{{ $row->tahun_akademik - 1 }}/{{ $row->tahun_akademik }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="jurusan" class="form-label">Program Studi</label>
                <select id="jurusan" class="form-select form-control" name="jurusan">
                    <option value="" selected disabled>=== Pilih ===</option>
                    @foreach ($prodi as $row)
                    @if (old('jurusan', \Request::get('jurusan')) == $row->program_studi->id)
                    <option value="{{ $row->program_studi->id }}" selected>{{ $row->program_studi->jenjang }} {{
                        $row->program_studi->nama_prodi }}, {{ $row->program_studi->konsentrasi ?? "" }}
                    </option>
                    @else
                    <option value="{{ $row->program_studi->id }}">{{ $row->program_studi->jenjang }} {{
                        $row->program_studi->nama_prodi }}, {{ $row->program_studi->konsentrasi ?? "" }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-12" style="margin-top: 50px; display:flex; justify-content: space-between">
                <div>
                    <a href="{{ route('tambah-draft') }}" class="btn btn-primary"><i class="fa-solid fa-plus icon"></i>
                        Tambah
                        Data</a>
                </div>
                <div>
                    <button type="submit" class="btn btn-light"><i class="fa-solid fa-sliders"></i> Filter</button>
                    <a href="{{ route('draft-jadwal') }}" class="btn btn-danger"><i class="fa-solid fa-xmark"></i>
                        Reset</a>
                </div>
            </div>
        </form>
    </div>
    <div class="row" style="height: auto">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal Draft Dibuat</th>
                    <th scope="col">Periode</th>
                    <th scope="col">Jenjang</th>
                    <th scope="col">Program Studi</th>
                    <th scope="col">Tahun Akademik</th>
                    <th scope="col">aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $row)
                <tr>
                    <td>{{ $data->firstItem() + $index }}</td>
                    <td>{{ $row->created_at }}</td>
                    <td>P{{ $row->periode_ke }}Y{{ $row->yudisium_ke }}</td>
                    <td>{{ $row->program_studi->jenjang }}</td>
                    <td>{{ $row->program_studi->nama_prodi }}</td>
                    <td>{{ $row->tahun_akademik - 1 }}/{{ $row->tahun_akademik }}</td>
                    <td>
                        <div class="kumpulan-tombol" style="display: flex; justify-content:center">
                            {{-- <form action="{{ route('kirim-ke-prodi', $row->id) }}" method="POST">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-success">Kirim ke prodi</button>
                            </form> --}}
                            <a href="{{ route('detail-draft-jadwal', $row->id) }}" class="btn btn-primary"><i
                                    class="fa-solid fa-eye icon"></i></a>
                            <form action="{{ route('hapus-draft', $row->id) }}" method="post">
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