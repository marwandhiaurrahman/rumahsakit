<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Laravolt\Indonesia\Seeds\DatabaseSeeder as SeedsDatabaseSeeder;
use Modules\Dokter\Database\Seeders\DokterDatabaseSeeder;
use Modules\Obat\Database\Seeders\ObatDatabaseSeeder;
use Modules\Pasien\Database\Seeders\PasienDatabaseSeeder;
use Modules\Poliklinik\Database\Seeders\PoliklinikDatabaseSeeder;
use Modules\Role\Database\Seeders\RoleDatabaseSeeder;
use Modules\User\Database\Seeders\UserDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            SeedsDatabaseSeeder::class,
            RoleDatabaseSeeder::class,
            UserDatabaseSeeder::class,
            // PasienDatabaseSeeder::class,
            // DokterDatabaseSeeder::class,
            // ObatDatabaseSeeder::class,
            // PoliklinikDatabaseSeeder::class,
        ]);
    }
}
