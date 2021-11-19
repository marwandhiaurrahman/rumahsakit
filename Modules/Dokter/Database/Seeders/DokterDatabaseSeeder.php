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
            "name" => "Dr. Marwan Umum",
            "tempat_lahir" => "Cirebon",
            "tanggal_lahir" => "1998-11-17",
            "gender" => "Laki-laki",
            "province_id" => "32",
            "city_id" => "3209",
            "district_id" => "320901",
            "village_id" => "3209012017",
            "phone" => "+6289529909036",
            "email" => "umum@gmail.com",
            "username" => "umum",
            "agama" => "Islam",
            "status_kawin" => "Belum Kawin",
            "pekerjaan" => "Dokter Umum",
            "kewarganegaraan" => "Indonesia",
            'password' => bcrypt('qweqwe'),
        ]);
        $user->assignRole('Dokter');
        Dokter::create([
            'user_id' => $user->id,
            'kode' => 'D202111001',
            'status' => 1,
            'spesialis' => 'Dokter Umum'
        ]);

        $user = User::create([
            "nik" => "3209020905980998",
            "name" => "Dr. Rahman Dalam",
            "tempat_lahir" => "Cirebon",
            "tanggal_lahir" => "1998-11-17",
            "gender" => "Laki-laki",
            "province_id" => "32",
            "city_id" => "3209",
            "district_id" => "320901",
            "village_id" => "3209012017",
            "phone" => "+6289529909036",
            "email" => "dalam@gmail.com",
            "username" => "dalam",
            "agama" => "Islam",
            "status_kawin" => "Belum Kawin",
            "pekerjaan" => "Dokter Penyakit Dalam",
            "kewarganegaraan" => "Indonesia",
            'password' => bcrypt('qweqwe'),
        ]);
        $user->assignRole('Dokter');
        Dokter::create([
            'user_id' => $user->id,
            'kode' => 'D202111002',
            'status' => 1,
            'spesialis' => 'Dokter Penyakit Dalam'
        ]);

        $user = User::create([
            "nik" => "3209020905980997",
            "name" => "Dr. Dhiaur Anak",
            "tempat_lahir" => "Cirebon",
            "tanggal_lahir" => "1998-11-17",
            "gender" => "Laki-laki",
            "province_id" => "32",
            "city_id" => "3209",
            "district_id" => "320901",
            "village_id" => "3209012017",
            "phone" => "+6289529909036",
            "email" => "anak@gmail.com",
            "username" => "anak",
            "agama" => "Islam",
            "status_kawin" => "Belum Kawin",
            "pekerjaan" => "Dokter Anak",
            "kewarganegaraan" => "Indonesia",
            'password' => bcrypt('qweqwe'),
        ]);
        $user->assignRole('Dokter');
        Dokter::create([
            'user_id' => $user->id,
            'kode' => 'D202111003',
            'status' => 1,
            'spesialis' => 'Dokter Anak'
        ]);

        $user = User::create([
            "nik" => "3209020905980996",
            "name" => "Dr. Hasya Mata",
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
            "pekerjaan" => "Dokter Mata",
            "kewarganegaraan" => "Indonesia",
            'password' => bcrypt('qweqwe'),
        ]);
        $user->assignRole('Dokter');
        Dokter::create([
            'user_id' => $user->id,
            'kode' => 'D202111004',
            'status' => 1,
            'spesialis' => 'Dokter Mata'
        ]);
        $user = User::create([
            "nik" => "3209020905980912",
            "name" => "Dr. Kirana Gigi",
            "tempat_lahir" => "Cirebon",
            "tanggal_lahir" => "1998-11-17",
            "gender" => "Laki-laki",
            "province_id" => "32",
            "city_id" => "3209",
            "district_id" => "320901",
            "village_id" => "3209012017",
            "phone" => "+6289529909036",
            "email" => "gigi@gmail.com",
            "username" => "gigi",
            "agama" => "Islam",
            "status_kawin" => "Belum Kawin",
            "pekerjaan" => "Dokter Gigi",
            "kewarganegaraan" => "Indonesia",
            'password' => bcrypt('qweqwe'),
        ]);
        $user->assignRole('Dokter');
        Dokter::create([
            'user_id' => $user->id,
            'kode' => 'D202111005',
            'status' => 1,
            'spesialis' => 'Dokter Gigi'
        ]);
    }
}
