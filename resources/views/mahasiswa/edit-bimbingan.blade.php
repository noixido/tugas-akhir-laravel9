@extends('layouts.master-mahasiswa')
@section('title', 'Edit Data Bimbingan')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('bimbingan') }}" class="btn btn-light" style="height: 40px;">
                <i class="fa-solid fa-arrow-left-long icon"></i> Kembali
            </a>
        </div>
    </div>
    <div class="row" style="height: 580px">
        <form action="{{ route('proses-edit-bimbingan', $data->id) }}" class="row" style="margin: 0%" method="POST">
            @csrf
            @method('put')
            <table class="table table-bordered" style="width: 1155px">
                <tr class="col-6">
                    <th scope="col" class="col-6"><label for="isi" class="form-label">Deskripsi Bimbingan</label></th>
                    <td><textarea name="isi" id="isi" cols="30" rows="10"
                            class="form-control @error('password') is-invalid @enderror">
                                    {{ old('isi', $data->isi_bimbingan) }}
                                    </textarea>
                        @error('isi')
                        <span class=" invalid-feedback">{{ $message }}</span>
                        @enderror
                <tr>
                    <td colspan="2" style="text-align: center   ">
                        <div class="col-12" style="text-align:center">
                            <button type="submit" class="btn btn-warning">Perbarui</button>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
@endsection