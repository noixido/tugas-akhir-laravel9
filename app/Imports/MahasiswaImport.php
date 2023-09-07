<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use App\Models\User;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class MahasiswaImport implements OnEachRow, WithHeadingRow
{
    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();

        if ($rowIndex == 0) {
            return;
        }
        $user = User::firstOrCreate([
            'username' => $row['nim'],
            'password' => bcrypt($row['nim']),
            'role' => 'mahasiswa'
        ]);
        $mhs = Mahasiswa::firstOrCreate([
            'user_id' => $user->id,
            'nim' => $row['nim'],
            'nama_mahasiswa' => $row['nama'],
        ]);
    }
}
