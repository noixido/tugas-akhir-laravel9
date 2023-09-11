<table class="table table-bordered">
    <tr style="text-align: center">
        <th rowspan="2" scope="col" class="col-1">No</th>
        <th rowspan="2" scope="col" class="col-1">NIM</th>
        <th rowspan="2" scope="col" class="col-2">Nama Mahasiswa</th>
        <th colspan="5">Nilai</th>
        @if (isset($export))

        @else
        <th rowspan="2" scope="col" class="col-1">Aksi</th>
        @endif
    </tr>
    <tr>
        <th scope="col" class="col-1">Pembimbing</th>
        <th scope="col" class="col-1">Penguji 1</th>
        <th scope="col" class="col-1">Penguji 2</th>
        <th scope="col" class="col-1">Total</th>
        <th scope="col" class="col-1">Huruf</th>
    </tr>
    @foreach ($nilai as $index => $row)
    <tr>
        @if (isset($export))
        <td>{{ $index + 1 }}</td>
        @else
        <td>{{ $nilai->firstItem() + $index }}</td>
        @endif
        <td>{{ $row->daftar_sidang->tugas_akhir->mahasiswa->nim }}</td>
        <td>{{ $row->daftar_sidang->tugas_akhir->mahasiswa->nama_mahasiswa }}</td>
        <td>{{ $row->nilai_pembimbing ?? '-'}}</td>
        <td>{{ $row->nilai_penguji_1 ?? '-'}}</td>
        <td>{{ $row->nilai_penguji_2 ?? '-'}}</td>
        <td>{{ number_format((($row->nilai_pembimbing * 2) + $row->nilai_penguji_1 + $row->nilai_penguji_2) / 4,
            2) }}</td>
        <td>
            @php
            $nilai_sidang = number_format((($row->nilai_pembimbing * 2) + $row->nilai_penguji_1 +
            $row->nilai_penguji_2) / 4,
            2);
            $nilai_huruf = '';
            @endphp
            @if ($nilai_sidang >= 85 && $nilai_sidang <= 100) {{ $nilai_huruf="A" }} @elseif ($nilai_sidang>= 80
                && $nilai_sidang <= 84.99) {{ $nilai_huruf="AB" }} @elseif ($nilai_sidang>= 75 && $nilai_sidang
                    <= 79.99) {{ $nilai_huruf="B" }} @elseif ($nilai_sidang>= 70 && $nilai_sidang <= 74.99) {{
                            $nilai_huruf="BC" }} @elseif ($nilai_sidang>= 60 && $nilai_sidang <= 69.99) {{
                                $nilai_huruf="C" }} @elseif ($nilai_sidang>= 55 && $nilai_sidang <= 59.99) {{
                                    $nilai_huruf="CD" }} @elseif ($nilai_sidang>= 0 && $nilai_sidang <= 54.99){{
                                        $nilai_huruf="D" }} @endif </td>
                                        @if (isset($export))

                                        @else
        <td>
            <div class="kumpulan-tombol" style="display: flex; justify-content: center">
                <a href="{{ route('detail-data-nilai', $row->id) }}" class="btn btn-primary"><i
                        class="fa-solid fa-eye icon"></i></a>
            </div>
        </td>
        @endif
    </tr>
    @endforeach
</table>