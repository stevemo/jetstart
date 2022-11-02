<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_determine_if_the_user_is_an_administrator()
    {
        $admin = User::factory()->admin()->create();
        $user = User::factory()->create();

        $this->assertTrue($admin->isAdmin());
        $this->assertFalse($user->isAdmin());
    }

    /** @test */
    public function it_determine_if_the_user_has_a_given_ability()
    {
        $user = User::factory()->abilities(['view'])->create();

        $this->assertTrue($user->ableTo('view'));
        $this->assertFalse($user->ableTo('edit'));
    }
}
