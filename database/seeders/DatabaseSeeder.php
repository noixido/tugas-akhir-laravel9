<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $data_admin = User::create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'role' => 'akademik'
        ]);
        Admin::create([
            'user_id' => $data_admin->id,
            'nama_admin' => 'Super Admin'
        ]);
        $prodis = ProgramStudi::create([
            'kode_prodi' => '1234',
            'jenjang' => 'D4',
            'nama_prodi' => 'Teknik Dummy',
            'konsentrasi' => 'Dummy Dummy'
        ]);

        $data_mhs = User::create([
            'username' => 'mahasiswa',
            'password' => bcrypt('mahasiswa'),
            'role' => 'mahasiswa'
        ]);
        Mahasiswa::create([
            'user_id' => $data_mhs->id,
            'nim' => 'D99999999',
            'nama_mahasiswa' => 'Mahasiswa',
            'angkatan' => '2017',
            'jurusan_id' => $prodis->id,
            'email' => 'mahasiswa@mahasiswa.com',
            'telepon' => '099999999999'
        ]);
        $data_dosen = User::create([
            'username' => 'dosendum',
            'password' => bcrypt('dosendum'),
            'role' => 'dosen'
        ]);
        Dosen::create([
            'user_id' => $data_dosen->id,
            'nama_dosen' => 'Dosen Dummy',
            'nidn' => '9999999999',
            'jurusan_id' => $prodis->id,
            'email' => 'dosendum@dosen.com',
            'telepon' => '099999999999',
            'alamat' => 'Komplek Dummy no.00, Kelurahan Dummy, Kecamatan Dummy, Kota Dummy, 99999'
        ]);
    }
}
