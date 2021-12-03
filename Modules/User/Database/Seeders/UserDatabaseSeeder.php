<?php

namespace Modules\User\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Pasien\Entities\Pasien;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            "nik" => "3209020906980112",
            "name" => "Admin",
            "tempat_lahir" => "Cirebon",
            "tanggal_lahir" => "1998-11-17",
            "gender" => "Laki-laki",
            "province_id" => "32",
            "city_id" => "3209",
            "district_id" => "320901",
            "village_id" => "3209012012",
            "phone" => "+6289529909035",
            "email" => "admin@gmail.com",
            "username" => "admin",
            "agama" => "Islam",
            "status_kawin" => "Belum Kawin",
            "pekerjaan" => "Programmer",
            "kewarganegaraan" => "Indonesia",
            'password' => bcrypt('qweqwe'),
        ]);
        $user->assignRole('Admin');
    }
}
