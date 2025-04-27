<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID Kabupaten dulu
        $kabupatens = DB::table('kabupaten_kota')->pluck('id_kabupaten_kota', 'nama_kabupaten_kota');

        // Isi data kecamatan
        $data = [
            'Situbondo' => [
                'Panarukan', 'Mangaran', 'Kapongan', 'Panji', 'Situbondo Kota'
            ],
            'Bondowoso' => [
                'Tamanan', 'Curahdami', 'Bondowoso Kota', 'Maesan', 'Pujer'
            ],
            'Jember' => [
                'Kaliwates', 'Sumbersari', 'Patrang', 'Rambipuji', 'Pakusari'
            ],
            'Banyuwangi' => [
                'Banyuwangi Kota', 'Giri', 'Glagah', 'Rogojampi', 'Genteng'
            ],
        ];

        foreach ($data as $nama_kabupaten => $kecamatans) {
            foreach ($kecamatans as $kecamatan) {
                DB::table('kecamatan')->insert([
                    'id_kabupaten_kota' => $kabupatens[$nama_kabupaten],
                    'nama_kecamatan' => $kecamatan,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
