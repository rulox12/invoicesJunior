<?php

namespace Tests\Feature\Users;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutEvents;
use Tests\TestCase;

class ShowUsersTest extends TestCase
{
    use RefreshDatabase;
    use WithoutEvents;

    /** @test **/
    public function a_logged_in_user_can_see_a_user()
    {
        $userDefault = $this->defaultUser();

        $user = factory(User::class)->create();

        $response = $this->actingAs($userDefault)
            ->get(
                route('users.show', $user)
            )
            ->assertSuccessful();

        $userResponse = $response->original->getData()['user'];
        $this->assertEquals($userResponse->name, $user->name);
        $this->assertEquals($userResponse->slug, $user->slug);
        $this->assertEquals($userResponse->locale, $user->locale);
        $this->assertEquals($userResponse->country, $user->country);
    }

    /** @test **/
    public function a_unregister_user_can_not_see_a_user()
    {
        $user = factory(User::class)->create();

        $response = $this
            ->get(
                route('users.show', $user)
            )
            ->assertStatus(302);

        $userResponse = $response->original;

        $this->assertTrue(is_null($userResponse));
    }
}
