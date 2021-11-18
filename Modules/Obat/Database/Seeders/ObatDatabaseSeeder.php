<?php

namespace Modules\Obat\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Obat\Entities\Obat;

class ObatDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Obat::create([
            "kode" => "O12001",
            "name" => "Mazol Slap",
            "stok" => "12",
            "satuan" => "kaplet",
            "harga" => "50000",
            "manfaat" => "Anti jamur",
        ]);
        Obat::create([
            "kode" => "O12002",
            "name" => "Ambroxol Syr",
            "stok" => "9",
            "satuan" => "botol",
            "harga" => "25000",
            "manfaat" => "Obat batuk",
        ]);
        Obat::create([
            "kode" => "O12003",
            "name" => "Capivlex",
            "stok" => "23",
            "satuan" => "kaplet",
            "harga" => "17500",
            "manfaat" => "Suplemen",
        ]);
        Obat::create([
            "kode" => "O12004",
            "name" => "Cipro",
            "stok" => "0",
            "satuan" => "kaplet",
            "harga" => "6500",
            "manfaat" => "Antibiotik",
        ]);
        Obat::create([
            "kode" => "O12005",
            "name" => "Mixagrip",
            "stok" => "4",
            "satuan" => "kaplet",
            "harga" => "2500",
            "manfaat" => "Influenza",
        ]);
    }
}
