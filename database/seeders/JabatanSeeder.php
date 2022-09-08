<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jabatans')->insert([
            'nama' => 'Kepala PDE'
        ]);
        DB::table('jabatans')->insert([
            'nama' => 'Kepala Ruangan'
        ]);
        DB::table('jabatans')->insert([
            'nama' => 'Teknisi'
        ]);
        DB::table('jabatans')->insert([
            'nama' => 'Direktur'
        ]);
        DB::table('jabatans')->insert([
            'nama' => 'Karyawan'
        ]);
    }
}
