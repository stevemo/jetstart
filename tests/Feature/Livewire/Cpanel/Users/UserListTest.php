<?php

namespace Tests\Feature\Livewire\Cpanel\User;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\Cpanel\Users\UserList;
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

    /** @test */
    public function user_need_ability_to_delete_user()
    {
        $user = User::factory()->abilities(['user:viewAny'])->create();
        $otherUser = User::factory()->create();

        Livewire::actingAs($user)
            ->test(UserList::class)
            ->call('delete', $otherUser->id)
            ->assertForbidden();
    }

    /** @test */
    public function user_can_not_delete_himself()
    {
        $user = User::factory()->abilities(['user:viewAny', 'user:delete'])->create();

        Livewire::actingAs($user)
            ->test(UserList::class)
            ->call('delete', $user->id)
            ->assertForbidden();

        $this->assertFalse($user->trashed());
    }

    /** @test */
    public function user_can_delete_another_member()
    {
        $user = User::factory()->abilities(['user:viewAny', 'user:delete'])->create();
        $otherUser = User::factory()->create();

        Livewire::actingAs($user)
            ->test(UserList::class)
            ->call('delete', $otherUser->id)
            ->call('destroy');

        $this->assertTrue($otherUser->fresh()->trashed());
    }
}
