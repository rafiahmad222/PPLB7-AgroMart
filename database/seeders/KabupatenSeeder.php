<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KabupatenSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kabupaten_kota')->insert([
            ['nama_kabupaten_kota' => 'Situbondo'],
            ['nama_kabupaten_kota' => 'Bondowoso'],
            ['nama_kabupaten_kota' => 'Jember'],
            ['nama_kabupaten_kota' => 'Banyuwangi'],
        ]);
    }
}
