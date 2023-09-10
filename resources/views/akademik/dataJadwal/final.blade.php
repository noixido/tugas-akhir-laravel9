@extends('layouts.master-admin')
@section('title', 'Halaman Finalisasi Jadwal')
@section('content')
<div class="container">
    <div class="menu-header" style="height: 100%; padding-bottom: 30px">
        <form action="{{ route('jadwal-sidang') }}" class="row" style="margin: 0%; width: 100%">
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
                    @if (old('jurusan', \Request::get('jurusan')) == $row->id)
                    <option value="{{ $row->id }}" selected>{{ $row->jenjang }} {{ $row->nama_prodi }}, {{
                        $row->konsentrasi ??
                        "" }}
                    </option>
                    @else
                    <option value="{{ $row->id }}">{{ $row->jenjang }} {{ $row->nama_prodi }}, {{ $row->konsentrasi
                        ??
                        "" }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="tanggal" class="form-label">Tanggal Sidang</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', \Request::get('tanggal')) }}"
                    class="form-select form-control">
            </div>
            <div class="col-12" style="margin-top: 50px; display:flex; justify-content: flex-end">
                <div>
                    <button type="submit" class="btn btn-light"><i class="fa-solid fa-sliders"></i> Filter</button>
                    <a href="{{ route('jadwal-sidang') }}" class="btn btn-danger"><i class="fa-solid fa-xmark"></i>
                        Reset</a>
                </div>
            </div>
        </form>
    </div>
    <div class="row" style="height: 100% ">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="col-1">No</th>
                    <th scope="col" class="col-1">Tanggal Sidang</th>
                    <th scope="col" class="col-1">Periode</th>
                    <th scope="col" class="col-1">Jenjang</th>
                    <th scope="col" class="col-1">Program Studi</th>
                    <th scope="col" class="col-1">Tahun Akademik</th>
                    <th scope="col" class="col-1">aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grup as $index => $row)
                <tr>
                    <td>{{ $grup->firstItem() + $index }}</td>
                    <td>{{ $row->tanggal_sidang }}</td>
                    <td>P{{ $row->periode_ke }}Y{{ $row->yudisium_ke }}</td>
                    <td>{{ $row->program_studi->jenjang }}</td>
                    <td>{{ $row->program_studi->nama_prodi }}</td>
                    <td>{{ $row->tahun_akademik-1 }}/{{ $row->tahun_akademik }}</td>
                    <td>
                        <div class="kumpulan-tombol" style="display: flex; justify-content:center">
                            <a href="{{ route('detail-jadwal-sidang', $row->id) }}" class="btn btn-primary"><i
                                    class="fa-solid fa-eye icon"></i></a>
                            @if ($row->status_jadwal == 'published')
                            <form action="{{ route('publish-jadwal', $row->id) }}" method="post">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-success" hidden>Publish</i>
                                </button>
                            </form>
                            @else
                            <form action="{{ route('publish-jadwal', $row->id) }}" method="post">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-success">Publish</i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $grup->links() }}
        {{-- {!! $data->appends(\Request::except('page'))->render() !!} --}}
    </div>
</div>
@endsection