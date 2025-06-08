<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder kabupaten dan kecamatan
        $this->call([
            KabupatenSeeder::class,
            KecamatanSeeder::class,
            KodePosSeeder::class,
            KategoriSeeder::class,
        ]);
    }
}
