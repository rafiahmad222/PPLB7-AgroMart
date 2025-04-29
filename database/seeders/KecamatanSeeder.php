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
                'Arjasa', 'Asembagus', 'Banyuglugur', 'Banyuputih', 'Besuki',
                'Bungatan', 'Jangkar', 'Jatibanteng', 'Kapongan', 'Kendit',
                'Mangaran', 'Mlandingan', 'Panarukan','Panji', 'Situbondo',
                'Sumbermalang', 'Suboh',
            ],
            'Bondowoso' => [
                'Binakal', 'Bondowoso', 'Botolinggo','Cermee', 'Curahdami', 'Grujugan',
                'Jambesari', 'Klabang','Maesan', 'Pakem', 'Prajekan', 'Pujer', 'Sempol',
                'Sukosari','Sumberwringin', 'Taman Krocok', 'Tamanan', 'Tapen', 'Tegalampel',
                'Tenggarang', 'Tlogosari', 'Wonosari', 'Wringin', 'Wonosari',
            ],
            'Jember' => [
                'Ajung', 'Arjasa', 'Ambulu', 'Bangsalsari', 'Balung', 'Gumukmas',
                'Jelbuk', 'Jenggawah', 'Jombang', 'Kalisat', 'Kaliwates', 'Kencong',
                'Ledokombo', 'Mayang', 'Mumbulsari', 'Panti', 'Pakusari', 'Patrang',
                'Puger', 'Rambipuji', 'Semboro', 'Silo', 'Sukorambi', 'Sukowono', 'Sumberbaru',
                'Sumberjambe', 'Sumbersari', 'Tanggul', 'Tempurejo', 'Umbulsari', 'Wuluhan',
            ],
            'Banyuwangi' => [
                'Pesanggaran','Siliragung','Bangorejo','Purwoharjo','Tegaldlimo',
                'Muncar','Cluring','Gambiran','Tegalsari','Glenmore','Kalibaru',
                'Srono','Rogojampi','Kabat','Singojuruh','Sempu','Songgon','Glagah',
                'Licin','Banyuwangi','Giri','Kalipuro','Wongsorejo','Blimbingsari',
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
