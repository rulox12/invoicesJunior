<?php

namespace Tests\Feature\Users;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutEvents;
use Tests\TestCase;

class EditUsersTest extends TestCase
{
    use RefreshDatabase;
    use WithoutEvents;

    /** @test * */
    public function users_can_edit_users()
    {
        $userDefult = $this->defaultUser();

        $user = factory(User::class)->create();

        $response = $this->actingAs($userDefult)
            ->get(route('users.edit', $user))
            ->assertSuccessful();

        $getDataUser = $response->original->getData()['user'];

        $this->assertEquals($user->id, $getDataUser->id);
        $this->assertEquals($user->name, $getDataUser->name);
        $this->assertEquals($user->surname, $getDataUser->surname);
        $this->assertEquals($user->email, $getDataUser->email);
        $this->assertEquals($user->state, $getDataUser->state);
    }

    /** @test * */
    public function users_unregister_can_not_edit_users()
    {
        $user = factory(User::class)->create();

        $this
            ->get(route('users.edit', $user))
            ->assertStatus(302);
    }
}
