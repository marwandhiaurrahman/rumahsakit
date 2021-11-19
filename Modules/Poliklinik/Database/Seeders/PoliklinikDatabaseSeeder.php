<?php

namespace Modules\Poliklinik\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Poliklinik\Entities\Poliklinik;

class PoliklinikDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Poliklinik::create([
            'kode' => 'UM',
            'name' => 'Umum',
            'status' => '1',
            'dokter_id' => '1'
        ]);
        Poliklinik::create([
            'kode' => 'PD',
            'name' => 'Penyakit Dalam',
            'status' => '1',
            'dokter_id' => '2'
        ]);
        Poliklinik::create([
            'kode' => 'AN',
            'name' => 'Anak & Kandungan',
            'status' => '1',
            'dokter_id' => '3'
        ]);
        Poliklinik::create([
            'kode' => 'GM',
            'name' => 'Gigi & Mulut',
            'status' => '1',
            'dokter_id' => '4'
        ]);
        Poliklinik::create([
            'kode' => 'MT',
            'name' => 'Mata',
            'status' => '1',
            'dokter_id' => '5'
        ]);
    }
}
