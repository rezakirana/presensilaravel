<?php

use Illuminate\Database\Seeder;
use App\Model\Dokter;
use App\Model\Pasien;
use App\Model\Poli;

class DokterPasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $poli = Poli::create([
            'kode' => 'U',
            'nama' => 'Poli Umum',
        ]);

        $dokter = Dokter::create([
            'user_id' => 2,
            'nama_dokter' => 'Dr. Resa',
            'jk' => 'laki-laki',
            'pendidikan_terakhir' => 'S2',
            'poli_id' => '1',
        ]);

        $pasien = Pasien::create([
            'user_id' => 3,
            'nama' => 'Yudi',
            'alamat' => 'Kepuh Wedomartani',
            'nik' => '3404040403043034304',
            'jk' => 'laki-laki',
            'ttl' => '2000-01-01',
        ]);
    }
}
