<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => "daniel",
            'surname' => "camilo",
            'email' => 'user@gmail.com',
            'type_document' => 'CC',
            'document' => '1036343123',
            'password' => bcrypt('user123'),
            'state' => true,
        ]);

        $role = Role::create([
            'name' => 'SuperAdmin',
            'description' => 'Rol que cuenta con todos los permisos'
        ]);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
