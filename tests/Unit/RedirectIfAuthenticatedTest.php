<?php


namespace Tests\Unit;

use App\Http\Middleware\RedirectIfAuthenticated;
use App\User;
use Illuminate\Http\Request;
use Tests\TestCase;

class RedirectIfAuthenticatedTest extends TestCase
{
    /** @test */
    public function non_admins_are_redirected()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $request = Request::create('/', 'GET');

        $middleware = new RedirectIfAuthenticated();

        $response = $middleware->handle($request, function () {
        });

        $this->assertEquals($response->getStatusCode(), 302);
    }
}
