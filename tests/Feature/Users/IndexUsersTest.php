<?php

namespace Tests\Feature\Users;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutEvents;
use Tests\TestCase;

class IndexUsersTest extends TestCase
{
    use RefreshDatabase;
    use WithoutEvents;

    /** @test **/
    public function users_can_list_users()
    {
        $user = $this->createSuperAdminUser();

        $userA = factory(User::class)->create();
        $userB = factory(User::class)->create();
        $userC = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('users.index'))
            ->assertSuccessful();

        $users = $response->original->getData()['users'];

        $this->assertTrue($users->contains($userA));
        $this->assertTrue($users->contains($userB));
        $this->assertTrue($users->contains($userC));
    }

    /** @test **/
    public function a_user_who_is_not_registered_cannot_users()
    {
        factory(User::class, 3)->create();

        $response = $this
            ->get(route('users.index'))
            ->assertStatus(302);
        $this->assertTrue(is_null($response->original));
    }

    /** @test * */
    public function a_user_register_can_filter_user_for_name()
    {
        $defaultUser = $this->createSuperAdminUser();

        $name = "Unique_name";

        $user = factory(User::class)->create(['name' => $name]);
        factory(User::class, 3)->create();


        $response = $this->actingAs($defaultUser)
            ->get('/users?type=name&value='.$name);


        $users = $response->original->getData()['users'];
        $this->assertEquals($name, $users[0]->name);
        $this->assertEquals(1, sizeof($users));
    }

    /** @test * */
    public function a_user_register_can_filter_user_for_state()
    {
        $defaultUser = $this->createSuperAdminUser();

        $state = true;

        factory(User::class)->create(['state' => $state]);


        $response = $this->actingAs($defaultUser)
            ->get('/users?type=state&value='.'true');


        $users = $response->original->getData()['users'];
        $this->assertEquals($state, $users[0]->state);
    }
}
