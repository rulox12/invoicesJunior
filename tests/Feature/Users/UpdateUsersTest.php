<?php

namespace Tests\Feature\Users;

use App\Entities\Role;
use App\Entities\Seller;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateUsersTest extends TestCase
{
    use RefreshDatabase;

    private function newUser()
    {
        return [
            'name' => substr($this->faker->firstName, 0, 20),
            'surname' => substr($this->faker->lastName, 0, 20),
            'type_document' => substr($this->faker->lastName, 0, 2),
            'document' => $this->faker->numberBetween($min = 100000, $max = 9000000),
            'email' => $this->faker->email,
            'password' => $this->faker->password,
            'role_id' => factory(Role::class)->create()->id,
            'state' => $this->faker->boolean
        ];
    }

    /** @test * */
    public function unauthenticated_user_cannot_update_a_user()
    {
        $userDefault = factory(User::class)->create();

        $response = $this
            ->patch(
                route('users.update', $userDefault),
                [
                    'name' => 'New user name',
                    'slug' => 'new_user_name',
                ]
            );

        $response->assertStatus(302);
    }

    /** @test * */
    public function admin_users_can_update_a_user()
    {
        $userDefault = $this->defaultUser();
        $name = "new name";
        $surname = "new surname";
        $type_document = "CC";
        $document = "11212121";
        $email = "newemail@example.com";
        $role_id = factory(Role::class)->create()->id;
        $password = "new password";

        $data =[
            'name' => $name,
            'surname' => $surname,
            'type_document' => $type_document,
            'document' => $document,
            'password' => $password,
            'email' => $email,
            'role_id' => $role_id
        ];


        $response = $this->actingAs($userDefault)
            ->patch(route('users.update', $userDefault), $data)
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $userUpdate = User::latest()->first();

        $this->assertEquals($userUpdate->name, $name);
        $this->assertEquals($userUpdate->surname, $surname);
        $this->assertEquals($userUpdate->type_document, $type_document);
        $this->assertEquals($userUpdate->document, $document);
        $this->assertEquals($userUpdate->email, $email);
        $this->assertEquals($userUpdate->password, $password);
        $this->assertEquals($userUpdate->role_id, $role_id);
    }

    /** @test * */
    public function admin_users_can_update_state_a_user_active()
    {
        $user = factory(User::class)->create(['state' => true]);

        $defaultUser = $this->defaultUser();

        $response = $this->actingAs($defaultUser)
            ->get(route('users.delete', $user))
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $userUpdate = User::latest()->first();

        $this->assertEquals($userUpdate->state, false);
    }

    /** @test * */
    public function admin_users_can_update_state_a_user_inactive()
    {
        $user = factory(User::class)->create(['state' => false]);

        $defaultUser = $this->defaultUser();

        $response = $this->actingAs($defaultUser)
            ->get(route('users.delete', $user))
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $userUpdate = User::latest()->first();

        $this->assertEquals($userUpdate->state, true);
    }
}
