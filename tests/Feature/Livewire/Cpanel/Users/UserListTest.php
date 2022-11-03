<?php

namespace Tests\Feature\Livewire\Cpanel\Users;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserListTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function need_to_be_logged_in()
    {
        $this->get(route('cpanel.users.index'))->assertRedirect('/login');
    }

    /** @test */
    public function user_need_permission_to_render_the_screen()
    {
        $userWithoutPermission = User::factory()->create();
        $userWithPermission = User::factory()->abilities(['user:viewAny'])->create();

        $this->actingAs($userWithoutPermission)
            ->get(route('cpanel.users.index'))
            ->assertForbidden();

        $this->actingAs($userWithPermission)
            ->get(route('cpanel.users.index'))
            ->assertSuccessful();
    }
}
