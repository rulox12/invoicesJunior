<?php

namespace Tests\Feature\Users;

use App\Entities\Role;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreUsersTest extends TestCase
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

    /** @test **/
    public function save_a_user_with_a_logged_in_user()
    {
        $this->actingAs($this->defaultUser())
            ->post(
                route('users.store'),
                $this->newUser()
            )
            ->assertRedirect()
            ->assertSessionHasNoErrors()
            ->assertStatus(302);
    }

    /** @test **/
    public function save_a_user_with_a_unregister_user()
    {
        $this
            ->post(
                route('users.store'),
                $this->newUser()
            )
            ->assertRedirect()
            ->assertSessionHasNoErrors()
            ->assertStatus(302);
    }

    /** @test **/
    public function save_an_user_without_data()
    {
        $data = [];

        $this->actingAs($this->defaultUser())
            ->post(
                route('users.store'),
                $data
            )
            ->assertSessionHasErrors()
            ->assertStatus(302);
    }

    /** @test * */
    public function saves_user_who_was_created_that_user()
    {
        $userCreate = factory(User::class)->create();

        $this
            ->actingAs($userCreate)
            ->post(
                route('users.store'),
                $this->newUser()
            )
            ->assertSessionHasNoErrors()
            ->assertStatus(302);
    }
}
