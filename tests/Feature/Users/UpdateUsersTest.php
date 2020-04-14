<?php

namespace Tests\Feature\Users;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateUsersTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test * */
    public function unauthenticated_user_cannot_update_a_user()
    {
        $userDefault = $this->createSuperAdminUser();

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
        $userDefault = $this->createSuperAdminUser();

        $name = "new name";
        $surname = "new surname";
        $type_document = "CC";
        $document = "11212121";
        $email = "newemail@example.com";
        $password = "new password";

        $data =[
            'name' => $name,
            'surname' => $surname,
            'type_document' => $type_document,
            'document' => $document,
            'password' => $password,
            'email' => $email,
        ];


        $this->actingAs($userDefault)
            ->patch(route('users.update', $userDefault), $data)
            ->assertRedirect()
            ->assertSessionHasNoErrors();
    }

    /** @test * */
    public function admin_users_can_update_state_a_user_active()
    {
        $user = factory(User::class)->create(['state' => true]);

        $defaultUser = $this->createSuperAdminUser();

        $response = $this->actingAs($defaultUser)
            ->get(route('users.delete', $user))
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $userUpdate = User::latest()->first();

        $this->assertEquals($userUpdate->state, 0);
    }

    /** @test * */
    public function admin_users_can_update_state_a_user_inactive()
    {
        $user = factory(User::class)->create(['state' => false]);

        $defaultUser = $this->createSuperAdminUser();

        $response = $this->actingAs($defaultUser)
            ->get(route('users.delete', $user))
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $userUpdate = User::latest()->first();

        $this->assertEquals($userUpdate->state, 0);
    }
}
