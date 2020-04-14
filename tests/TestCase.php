<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

abstract class TestCase extends BaseTestCase
{
    use WithFaker;
    use CreatesApplication;

    public function API()
    {
        $this->createSuperAdminUserAPI();
        $this->artisan('passport:install');
    }
    /**
     * @var User
     */
    protected $defaulUser;

    public function createPermission()
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
            'payment list',
            'payment generate',
            'payment detail',
            'user delete'
        ];

        foreach ($permissions as $permission) {
            factory(Permission::class)->create(['name' => $permission]);
        }
    }

    public function createRol($user)
    {
        $role = factory(Role::class)->create([
            'name' => 'SuperAdmin',
            'description' => 'Rol que cuenta con todos los permisos'
        ]);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        return $user;
    }

    public function createSuperAdminUser()
    {
        if ($this->defaulUser) {
            return $this->defaulUser;
        }
        $this->createPermission();

        $this->defaulUser = $this->createRol(factory(User::class)->create());

        return $this->defaulUser;
    }

    public function createSuperAdminUserAPI()
    {
        $this->createPermission();

        return $this->createRol(factory(User::class)->create([
            'email' => 'user@gmail.com',
            'password' => bcrypt('user123')
        ]));
    }

    public function headerApi()
    {
        $user = [
            'email' => 'user@gmail.com',
            'password' => 'user123'
        ];

        Auth::attempt($user);
        $token = Auth::user()->createToken('nfce_client')->accessToken;

        return ['Authorization' => "Bearer $token"];
    }
}
