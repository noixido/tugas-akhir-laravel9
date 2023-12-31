<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th>Tanggal Daftar</th>
            <th>Nama Mahasiswa</th>
            <th>Nomor Induk Mahasiswa</th>
            <th>Jenjang</th>
            <th>Program Studi</th>
            <th>Konsentrasi</th>
            <th>Kelas</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Alamat Mahasiswa</th>
            <th>Nomor Telepon Mahasiswa</th>
            <th>Email Mahasiswa</th>
            <th>Dosen Pembimbing</th>
            <th>Judul Tugas Akhir</th>
            <th>Bimbingan</th>
            <th>IPK Saat Ini</th>
            <th>Pas Foto</th>
            <th>Scan Pembayaran SPP</th>
            <th>Scan Ijazah Terakhir</th>
            <th>Scan Akta Kelahiran</th>
            <th>Scan Kartu Keluarga</th>
            <th>Scan Sertifikat PEKA</th>
            <th>Scan Sertifikat TOEFL</th>
            <th>Scan Sertifikat UJikom 1</th>
            <th>Scan Sertifikat UJikom 2</th>
            <th>Scan Sertifikat UJikom 3</th>
            <th>Scan Sertifikat UJikom 4</th>
            <th>Scan Sertifikat UJikom 5</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $index => $row)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $row->created_at }}</td>
            <td>{{ $row->mahasiswa->nama_mahasiswa }}</td>
            <td>{{ $row->mahasiswa->nim }}</td>
            <td>{{ $row->program_studi->jenjang }}</td>
            <td>{{ $row->program_studi->nama_prodi }}</td>
            <td>{{ $row->program_studi->konsentrasi ?? '-'}}</td>
            <td>{{ $row->kelas }}</td>
            <td>{{ $row->tempat_lahir }}</td>
            <td>{{ $row->tanggal_lahir }}</td>
            <td>{{ $row->alamat }}</td>
            <td>{{ $row->mahasiswa->telepon }}</td>
            <td>{{ $row->mahasiswa->email }}</td>
            <td>{{ $row->tugas_akhir->dosen->nama_dosen }}</td>
            <td>{{ $row->tugas_akhir->judul_tugas_akhir }}</td>
            <td><a href="{{ url('/') }}/bimbingan/mahasiswa/{{ $row->mahasiswa->nim }}">{{url('/').'/bimbingan/mahasiswa/'.$row->mahasiswa->nim
                    }}</a>
            </td>
            <td>{{ $row->ipk_saat_ini }}</td>
            <td><a href="{{ url('/') }}/storage/{{ $row->pas_foto }}">{{ url('/').'/storage/'.$row->pas_foto }}</a></td>
            <td><a href="{{ url('/') }}/storage/{{ $row->scan_bukti_spp }}">{{ url('/').'/storage/'.$row->scan_bukti_spp
                    }}</a></td>
            <td><a href="{{ url('/') }}/storage/{{ $row->scan_ijazah_terakhir }}">{{url('/').'/storage/'.$row->scan_ijazah_terakhir
                    }}</a></td>
            <td><a href="{{ url('/') }}/storage/{{ $row->scan_akta_kelahiran }}">{{url('/').'/storage/'.$row->scan_akta_kelahiran
                    }}</a></td>
            <td><a href="{{ url('/') }}/storage/{{ $row->scan_kartu_keluarga }}">{{url('/').'/storage/'.$row->scan_kartu_keluarga
                    }}</a></td>
            <td><a href="{{ url('/') }}/storage/{{ $row->scan_sertifikat_peka }}">{{url('/').'/storage/'.$row->scan_sertifikat_peka
                    }}</a></td>
            <td><a href="{{ url('/') }}/storage/{{ $row->scan_sertifikat_toefl }}">{{url('/').'/storage/'.$row->scan_sertifikat_toefl
                    }}</a></td>
            <td><a href="{{ url('/') }}/storage/{{ $row->scan_sertifikat_ujikom_1 }}">{{url('/').'/storage/'.$row->scan_sertifikat_ujikom_1
                    }}</a></td>
            <td><a href="{{ url('/') }}/storage/{{ $row->scan_sertifikat_ujikom_2 }}">{{url('/').'/storage/'.$row->scan_sertifikat_ujikom_2
                    }}</a></td>
            <td>
                @if ($row->scan_sertifikat_ujikom_3 === null)
                -
                @else
                <a href="{{ url('/') }}/storage/{{ $row->scan_sertifikat_ujikom_3 }}">{{url('/').'/storage/'.$row->scan_sertifikat_ujikom_3
                    }}</a>
                @endif
            </td>
            <td>
                @if ($row->scan_sertifikat_ujikom_4 === null)
                -
                @else
                <a href="{{ url('/') }}/storage/{{ $row->scan_sertifikat_ujikom_4 }}">{{url('/').'/storage/'.$row->scan_sertifikat_ujikom_4
                    }}</a>
                @endif
            </td>
            <td>
                @if ($row->scan_sertifikat_ujikom_5 === null)
                -
                @else
                <a href="{{ url('/') }}/storage/{{ $row->scan_sertifikat_ujikom_5 }}">{{url('/').'/storage/'.$row->scan_sertifikat_ujikom_5
                    }}</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>