<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
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

        $data = User::create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'role' => 'akademik'
        ]);
        Admin::create([
            'user_id' => $data->id,
            'nama_admin' => 'Super Admin'
        ]);
        ProgramStudi::create([
            'kode_prodi' => '1234',
            'jenjang' => 'D4',
            'nama_prodi' => 'Teknik Dummy',
            'konsentrasi' => 'Dummy Dummy'
        ]);
    }
}
