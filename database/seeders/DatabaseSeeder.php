<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        DB::table('users')->insert([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'no_telp' => '082285409077',
            'password' => Hash::make('admin'),
            'roles' => 'Admin',
            'alamat' => 'padang',
        ]);

        DB::table('users')->insert([
            'username' => 'pelapor',
            'email' => 'pelapor@gmail.com',
            'no_telp' => '082285409090',
            'password' => Hash::make('pelapor'),
            'roles' => 'Pelapor',
            'alamat' => 'jatim',
        ]);
    }
}
