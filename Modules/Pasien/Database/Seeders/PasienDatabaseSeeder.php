<?php

namespace Modules\Pasien\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Pasien\Entities\Pasien;

class PasienDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            "nik" => "3209020905980101",
            "name" => "Kahfi Ramadhan",
            "tempat_lahir" => "Kuningan",
            "tanggal_lahir" => "1992-11-17",
            "gender" => "Laki-laki",
            "province_id" => "32",
            "city_id" => "3209",
            "district_id" => "320901",
            "village_id" => "3209012017",
            "phone" => "+6289529909036",
            "email" => "kahfi@gmail.com",
            "username" => "kahfi",
            "agama" => "Islam",
            "status_kawin" => "Belum Kawin",
            "pekerjaan" => "Wiraswasta",
            "kewarganegaraan" => "Indonesia",
            'password' => bcrypt('qweqwe'),
        ]);
        $user->assignRole('Pasien');
        Pasien::create([
            'user_id' => $user->id,
            'kode' => 20211101001,
            'status' => 0
        ]);

        $user = User::create([
            "nik" => "3209020905980112",
            "name" => "Marwan Dhiaur Rahman",
            "tempat_lahir" => "Cirebon",
            "tanggal_lahir" => "1998-11-17",
            "gender" => "Laki-laki",
            "province_id" => "32",
            "city_id" => "3209",
            "district_id" => "320901",
            "village_id" => "3209012012",
            "phone" => "+6289529909035",
            "email" => "marwan@gmail.com",
            "username" => "marwan",
            "agama" => "Islam",
            "status_kawin" => "Belum Kawin",
            "pekerjaan" => "Programmer",
            "kewarganegaraan" => "Indonesia",
            'password' => bcrypt('qweqwe'),
        ]);
        $user->assignRole('Pasien');
        Pasien::create([
            'user_id' => $user->id,
            'kode' => 20211101002,
            'status' => 0
        ]);

        $user = User::create([
            "nik" => "3209020905980113",
            "name" => "Fitriya Nafis",
            "tempat_lahir" => "Cirebon",
            "tanggal_lahir" => "1994-11-17",
            "gender" => "Perempuan",
            "province_id" => "32",
            "city_id" => "3209",
            "district_id" => "320901",
            "village_id" => "3209012014",
            "phone" => "+6289529909034",
            "email" => "nafis@gmail.com",
            "username" => "nafis",
            "agama" => "Islam",
            "status_kawin" => "Kawin",
            "pekerjaan" => "Guru",
            "kewarganegaraan" => "Indonesia",
            'password' => bcrypt('qweqwe'),
        ]);
        $user->assignRole('Pasien');
        Pasien::create([
            'user_id' => $user->id,
            'kode' => 20211101003,
            'status' => 0
        ]);

        $user = User::create([
            "nik" => "3209020905980114",
            "name" => "Evi Novianti",
            "tempat_lahir" => "Cirebon",
            "tanggal_lahir" => "1993-11-17",
            "gender" => "Perempuan",
            "province_id" => "32",
            "city_id" => "3209",
            "district_id" => "320901",
            "village_id" => "3209012013",
            "phone" => "+6289529909036",
            "email" => "evi@gmail.com",
            "username" => "evi",
            "agama" => "Islam",
            "status_kawin" => "Belum Kawin",
            "pekerjaan" => "Mahasiswa",
            "kewarganegaraan" => "Indonesia",
            'password' => bcrypt('qweqwe'),
        ]);
        $user->assignRole('Pasien');
        Pasien::create([
            'user_id' => $user->id,
            'kode' => 20211101004,
            'status' => 0
        ]);

        $user = User::create([
            "nik" => "3209020905980115",
            "name" => "Ilham Panji",
            "tempat_lahir" => "Kuningan",
            "tanggal_lahir" => "1992-11-17",
            "gender" => "Laki-laki",
            "province_id" => "32",
            "city_id" => "3209",
            "district_id" => "320901",
            "village_id" => "3209012017",
            "phone" => "+6289529909036",
            "email" => "ilham@gmail.com",
            "username" => "ilham",
            "agama" => "Islam",
            "status_kawin" => "Belum Kawin",
            "pekerjaan" => "Wiraswasta",
            "kewarganegaraan" => "Indonesia",
            'password' => bcrypt('qweqwe'),
        ]);
        $user->assignRole('Pasien');
        Pasien::create([
            'user_id' => $user->id,
            'kode' => 20211101005,
            'status' => 0
        ]);
    }
}
