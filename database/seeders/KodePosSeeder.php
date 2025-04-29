<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KodePosSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua kecamatan untuk dapat id
        $kecamatans = DB::table('kecamatan')->pluck('id_kecamatan', 'nama_kecamatan');

        // Data kecamatan => kode pos
        $data = [
            // Situbondo
            'Arjasa' => '68371',
            'Asembagus' => '68373',
            'Banyuglugur' => '68359',
            'Banyuputih' => '68374',
            'Besuki' => '68356',
            'Bungatan' => '68358',
            'Jangkar' => '68372',
            'Jatibanteng' => '68382',
            'Kapongan' => '68361',
            'Kendit' => '68352',
            'Mangaran' => '68359',
            'Mlandingan' => '68355',
            'Panarukan' => '68353',
            'Panji' => '68321',
            'Situbondo' => '68311',
            'Sumbermalang' => '68383',
            'Suboh' => '68381',

            // Bondowoso
            'Binakal' => '68251',
            'Bondowoso' => '68211',
            'Botolinggo' => '68284',
            'Cermee' => '68261',
            'Curahdami' => '68250',
            'Grujugan' => '68261',
            'Jambesari' => '68271',
            'Klabang' => '68272',
            'Maesan' => '68262',
            'Pakem' => '68263',
            'Prajekan' => '68273',
            'Pujer' => '68274',
            'Sempol' => '68275',
            'Sukosari' => '68276',
            'Sumberwringin' => '68277',
            'Taman Krocok' => '68278',
            'Tamanan' => '68279',
            'Tapen' => '68280',
            'Tegalampel' => '68281',
            'Tenggarang' => '68282',
            'Tlogosari' => '68283',
            'Wonosari' => '68285',
            'Wringin' => '68286',

            // Jember
            'Ajung' => '68175',
            'Ambulu' => '68156',
            'Arjasa' => '68191',
            'Balung' => '68152',
            'Bangsalsari' => '68154',
            'Gumukmas' => '68165',
            'Jelbuk' => '68181',
            'Jenggawah' => '68171',
            'Jombang' => '68168',
            'Kalisat' => '68191',
            'Kaliwates' => '68131',
            'Kencong' => '68167',
            'Ledokombo' => '68183',
            'Mayang' => '68182',
            'Mumbulsari' => '68172',
            'Panti' => '68184',
            'Pakusari' => '68185',
            'Patrang' => '68111',
            'Puger' => '68164',
            'Rambipuji' => '68151',
            'Semboro' => '68157',
            'Silo' => '68161',
            'Sukorambi' => '68112',
            'Sukowono' => '68162',
            'Sumberbaru' => '68163',
            'Sumberjambe' => '68166',
            'Sumbersari' => '68121',
            'Tanggul' => '68152',
            'Tempurejo' => '68153',
            'Umbulsari' => '68173',
            'Wuluhan' => '68174',

            // Banyuwangi
            'Pesanggaran' => '68488',
            'Siliragung' => '68489',
            'Bangorejo' => '68487',
            'Purwoharjo' => '68483',
            'Tegaldlimo' => '68484',
            'Muncar' => '68485',
            'Cluring' => '68482',
            'Gambiran' => '68486',
            'Tegalsari' => '68481',
            'Glenmore' => '68466',
            'Kalibaru' => '68467',
            'Srono' => '68480',
            'Rogojampi' => '68462',
            'Kabat' => '68461',
            'Singojuruh' => '68464',
            'Sempu' => '68468',
            'Songgon' => '68469',
            'Glagah' => '68431',
            'Licin' => '68454',
            'Banyuwangi' => '68411',
            'Giri' => '68422',
            'Kalipuro' => '68421',
            'Wongsorejo' => '68455',
            'Blimbingsari' => '68460',
        ];

        foreach ($data as $nama_kecamatan => $kode_pos) {
            if (isset($kecamatans[$nama_kecamatan])) {
                DB::table('kode_pos')->insert([
                    'id_kecamatan' => $kecamatans[$nama_kecamatan],
                    'kode_pos' => $kode_pos,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
