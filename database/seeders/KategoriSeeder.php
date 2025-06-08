<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategoris')->insert([
            ['nama_kategori' => 'Sayuran Hidroponik'],
            ['nama_kategori' => 'Bunga & Buah'],
            ['nama_kategori' => 'Peralatan Berkebun'],
            ['nama_kategori' => 'Pupuk dan Nutrisi'],
            ['nama_kategori' => 'Bibit Tanaman'],
        ]);
    }
}
