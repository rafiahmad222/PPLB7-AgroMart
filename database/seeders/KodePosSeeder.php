<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KodePosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kode_pos')->insert([
            // Contoh untuk Situbondo
            ['kode_pos' => '68351', 'id_kecamatan' => 1],
            ['kode_pos' => '68352', 'id_kecamatan' => 2],

            // Contoh untuk Bondowoso
            ['kode_pos' => '68251', 'id_kecamatan' => 3],
            ['kode_pos' => '68252', 'id_kecamatan' => 4],

            // Contoh untuk Jember
            ['kode_pos' => '68121', 'id_kecamatan' => 5],
            ['kode_pos' => '68122', 'id_kecamatan' => 6],

            // Contoh untuk Banyuwangi
            ['kode_pos' => '68411', 'id_kecamatan' => 7],
            ['kode_pos' => '68412', 'id_kecamatan' => 8],
        ]);
    }
}
