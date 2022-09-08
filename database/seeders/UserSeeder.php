<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nip' => '124365',
            'name' => 'Muhammad Jaya Saputra',
            'email' => 'jaya@gmail.com',
            'password' => Hash::make('jaya12'),
            'tgl_lahir' => '22 02 01',
            'jk' => 'Laki-Laki',
            'nohp' => '08882345',
            'alamat' => 'banjarmasin',
            'jabatan_id' => '1',
            'verifikasi' => '1',
        ]);
    }
}
