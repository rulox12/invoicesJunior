<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role list',
            'role create',
            'role edit',
            'customer list',
            'customer create',
            'customer edit',
            'seller list',
            'seller create',
            'seller edit',
            'invoice list',
            'invoice create',
            'invoice edit',
            'import',
            'export',
            'user list',
            'user create',
            'user edit',
            'user delete',
            'payment list',
            'payment generate',
            'payment detail'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
