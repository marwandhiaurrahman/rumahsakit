<?php

namespace Modules\Dokter\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Dokter\Entities\Dokter;

class DokterDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            "nik" => "3209020905980999",
            "name" => "Dr. Marwan",
            "tempat_lahir" => "Cirebon",
            "tanggal_lahir" => "1998-11-17",
            "gender" => "Laki-laki",
            "province_id" => "32",
            "city_id" => "3209",
            "district_id" => "320901",
            "village_id" => "3209012017",
            "phone" => "+6289529909036",
            "email" => "marwandr@gmail.com",
            "username" => "marwandr",
            "agama" => "Islam",
            "status_kawin" => "Belum Kawin",
            "pekerjaan" => "Penyakit Dalam",
            "kewarganegaraan" => "Indonesia",
            'password' => bcrypt('qweqwe'),
        ]);
        $user->assignRole('Dokter');
        Dokter::create([
            'user_id' => $user->id,
            'kode' => 'D202111001',
            'status' => 1,
            'spesialis' => 'Penyakit Dalam'
        ]);

        $user = User::create([
            "nik" => "3209020905980998",
            "name" => "Dr. Rahman",
            "tempat_lahir" => "Cirebon",
            "tanggal_lahir" => "1998-11-17",
            "gender" => "Laki-laki",
            "province_id" => "32",
            "city_id" => "3209",
            "district_id" => "320901",
            "village_id" => "3209012017",
            "phone" => "+6289529909036",
            "email" => "rahmandr@gmail.com",
            "username" => "rahmandr",
            "agama" => "Islam",
            "status_kawin" => "Belum Kawin",
            "pekerjaan" => "Umum",
            "kewarganegaraan" => "Indonesia",
            'password' => bcrypt('qweqwe'),
        ]);
        $user->assignRole('Dokter');
        Dokter::create([
            'user_id' => $user->id,
            'kode' => 'D202111002',
            'status' => 1,
            'spesialis' => 'Umum'
        ]);

        $user = User::create([
            "nik" => "3209020905980997",
            "name" => "Dr. Dhiaur",
            "tempat_lahir" => "Cirebon",
            "tanggal_lahir" => "1998-11-17",
            "gender" => "Laki-laki",
            "province_id" => "32",
            "city_id" => "3209",
            "district_id" => "320901",
            "village_id" => "3209012017",
            "phone" => "+6289529909036",
            "email" => "dhiaurdr@gmail.com",
            "username" => "dhiaurdr",
            "agama" => "Islam",
            "status_kawin" => "Belum Kawin",
            "pekerjaan" => "Anak",
            "kewarganegaraan" => "Indonesia",
            'password' => bcrypt('qweqwe'),
        ]);
        $user->assignRole('Dokter');
        Dokter::create([
            'user_id' => $user->id,
            'kode' => 'D202111003',
            'status' => 1,
            'spesialis' => 'Anak'
        ]);

        $user = User::create([
            "nik" => "3209020905980996",
            "name" => "Dr. Mata",
            "tempat_lahir" => "Cirebon",
            "tanggal_lahir" => "1998-11-17",
            "gender" => "Laki-laki",
            "province_id" => "32",
            "city_id" => "3209",
            "district_id" => "320901",
            "village_id" => "3209012017",
            "phone" => "+6289529909036",
            "email" => "mata@gmail.com",
            "username" => "mata",
            "agama" => "Islam",
            "status_kawin" => "Belum Kawin",
            "pekerjaan" => "Mata",
            "kewarganegaraan" => "Indonesia",
            'password' => bcrypt('qweqwe'),
        ]);
        $user->assignRole('Dokter');
        Dokter::create([
            'user_id' => $user->id,
            'kode' => 'D202111004',
            'status' => 1,
            'spesialis' => 'Mata'
        ]);
    }
}
