@extends('layouts.master-admin')
@section('title', 'Halaman Data Rincian Pendaftaran Sidang Tugas Akhir Mahasiswa')
@section('content')
<div class="container">
    <div class="menu-header">
        <div class="input-group col-md-8">
            <a href="{{ route('data-pendaftaran-sidang') }}" class="btn btn-light" style="height: 40px;">
                <i class="fa-solid fa-arrow-left-long icon"></i> Kembali
            </a>
        </div>
    </div>
    <div class="row" style="height: 100%">
        <table class="table table-bordered">
            <tr>
                <th class="col-md-6">Pas Foto</th>
                <td>
                    <a href="{{ asset('storage/'. $data->pas_foto) }}" target="_blank">
                        <img src="{{ asset('storage/'. $data->pas_foto) }}" alt="pas foto mahasiswa"
                            style="max-height: 100%; width: 200px">
                    </a>
                </td>
            </tr>
            <tr>
                <th>Tanggal Daftar</th>
                <td>{{ date('j F Y, H:i', strtotime($create->created_at)) }}</td>
            </tr>
            <tr>
                <th>Nama Lengkap</th>
                <td>{{ $data->nama_mahasiswa }}</td>
            </tr>
            <tr>
                <th>Nomor Induk Mahasiswa</th>
                <td>{{ $data->nim }}</td>
            </tr>
            <tr>
                <th>Jenjang</th>
                <td>{{ $data->jenjang }}</td>
            </tr>
            <tr>
                <th>Program Studi</th>
                <td>{{ $data->nama_prodi }}</td>
            </tr>
            <tr>
                <th>Konsentrasi</th>
                <td>{{ $data->konsentrasi ?? '-' }}</td>
            </tr>
            <tr>
                <th>Kelas</th>
                <td>{{ $data->kelas }}</td>
            </tr>
            <tr>
                <th>Tempat dan Tanggal Lahir</th>
                <td>{{ $data->tempat_lahir }}, {{ date('j F Y', strtotime($data->tanggal_lahir)) }}</td>
            </tr>
            <tr>
                <th>alamat Mahasiswa</th>
                <td style="white-space: pre-wrap">{{ $data->alamat }}</td>
            </tr>
            <tr>
                <th>Nomor Telepon</th>
                <td>{{ $data->telepon }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $data->email }}</td>
            </tr>
            <tr>
                <th>Dosen Pembimbing</th>
                <td>{{ $ta->nama_dosen }}</td>
            </tr>
            <tr>
                <th>Judul Tugas Akhir</th>
                <td>{{ $ta->judul_tugas_akhir }}</td>
            </tr>
            <tr>
                <th>Jumlah Bimbingan yang Terkonfirmasi</th>
                <td>
                    <b>{{ $bimbinganCount }}</b> total bimbingan
                    <a href="{{ route('lihat-bimbingan-mahasiswa', $data->mahasiswa_id) }}"
                        style="margin-left: 70px">lihat di sini ></a>
                </td>
            </tr>
            <tr>
                <th>IPK Saat Ini</th>
                <td>{{ $data->ipk_saat_ini }}</td>
            </tr>
            <tr>
                <th>Scan Pembayaran SPP</th>
                <td>
                    <a href="{{ asset('storage/'. $data->scan_bukti_spp) }}" target="_blank">
                        <img src="{{ asset('storage/'. $data->scan_bukti_spp) }}" alt="spp mahasiswa"
                            style="max-height: 100%; width: 200px">
                    </a>
                </td>
            </tr>
            <tr>
                <th>Scan Ijazah Terakhir</th>
                <td>
                    <a href="{{ asset('storage/'. $data->scan_ijazah_terakhir) }}" target="_blank">
                        <img src="{{ asset('storage/'. $data->scan_ijazah_terakhir) }}" alt="ijazah mahasiswa"
                            style="max-height: 100%; width: 200px">
                    </a>
                </td>
            </tr>
            <tr>
                <th>Scan Akta Kelahiran</th>
                <td>
                    <a href="{{ asset('storage/'. $data->scan_akta_kelahiran) }}" target="_blank">
                        <img src="{{ asset('storage/'. $data->scan_akta_kelahiran) }}" alt="akta kelahiran mahasiswa"
                            style="max-height: 100%; width: 200px">
                    </a>
                </td>
            </tr>
            <tr>
                <th>Scan Kartu Keluarga</th>
                <td>
                    <a href="{{ asset('storage/'. $data->scan_kartu_keluarga) }}" target="_blank">
                        <img src="{{ asset('storage/'. $data->scan_kartu_keluarga) }}" alt="kartu keluarga mahasiswa"
                            style="max-height: 100%; width: 200px">
                    </a>
                </td>
            </tr>
            <tr>
                <th>Scan Sertifikat PEKA</th>
                <td>
                    <a href="{{ asset('storage/'. $data->scan_sertifikat_peka) }}" target="_blank">
                        <img src="{{ asset('storage/'. $data->scan_sertifikat_peka) }}" alt="sertifikat peka mahasiswa"
                            style="max-height: 100%; width: 200px">
                    </a>
                </td>
            </tr>
            <tr>
                <th>Scan Sertifikat TOEFL</th>
                <td>
                    <a href="{{ asset('storage/'. $data->scan_sertifikat_toefl) }}" target="_blank">
                        <img src="{{ asset('storage/'. $data->scan_sertifikat_toefl) }}"
                            alt="sertifikat toefl mahasiswa" style="max-height: 100%; width: 200px">
                    </a>
                </td>
            </tr>
            <tr>
                <th>Scan Sertifikat Ujikom 1</th>
                <td>
                    <a href="{{ asset('storage/'. $data->scan_sertifikat_ujikom_1) }}" target="_blank">
                        <img src="{{ asset('storage/'. $data->scan_sertifikat_ujikom_1) }}" alt="ujikom mahasiswa"
                            style="max-height: 100%; width: 200px">
                    </a>
                </td>
            </tr>
            <tr>
                <th>Scan Sertifikat Ujikom 2</th>
                <td>
                    <a href="{{ asset('storage/'. $data->scan_sertifikat_ujikom_2) }}" target="_blank">
                        <img src="{{ asset('storage/'. $data->scan_sertifikat_ujikom_2) }}" alt="ujikom mahasiswa"
                            style="max-height: 100%; width: 200px">
                    </a>
                </td>
            </tr>
            <tr>
                <th>Scan Sertifikat Ujikom 3</th>
                <td>
                    @if ($data->scan_sertifikat_ujikom_3)
                    <a href="{{ asset('storage/'. $data->scan_sertifikat_ujikom_3) }}" target="_blank">
                        <img src="{{ asset('storage/'. $data->scan_sertifikat_ujikom_3) }}" alt="ujikom mahasiswa"
                            style="max-height: 100%; width: 200px">
                    </a>
                    @else
                    -
                    @endif

                </td>
            </tr>
            <tr>
                <th>Scan Sertifikat Ujikom 4</th>
                <td>
                    @if ($data->scan_sertifikat_ujikom_4)
                    <a href="{{ asset('storage/'. $data->scan_sertifikat_ujikom_4) }}" target="_blank">
                        <img src="{{ asset('storage/'. $data->scan_sertifikat_ujikom_4) }}" alt="ujikom mahasiswa"
                            style="max-height: 100%; width: 200px">
                    </a>
                    @else
                    -
                    @endif
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection