<?php

namespace Modules\Role\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'admin-role',
            'pengawas-role',
            'dokter-role',
            'pasien-role',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        $role = Role::create(['name' => 'Admin']);
        $permissions = Permission::find(1);
        $role->syncPermissions($permissions);

        $role = Role::create(['name' => 'Pasien']);
        $permissions = Permission::find(4);
        $role->syncPermissions($permissions);

        $role = Role::create(['name' => 'Dokter']);
        $permissions = Permission::find(3);
        $role->syncPermissions($permissions);

        $role = Role::create(['name' => 'Pengawas']);
        $permissions = Permission::find(2);
        $role->syncPermissions($permissions);
    }
}
