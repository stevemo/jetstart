<?php

namespace Tests\Feature\Livewire\Cpanel\Users;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\Cpanel\Users\DeleteUser;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_need_ability_to_delete_user()
    {
        $user = User::factory()->abilities(['user:viewAny'])->create();
        $otherUser = User::factory()->create();

        Livewire::actingAs($user)
            ->test(DeleteUser::class)
            ->call('delete', $otherUser->id)
            ->assertForbidden();
    }

    /** @test */
    public function user_can_not_delete_himself()
    {
        $user = User::factory()->abilities(['user:viewAny', 'user:delete'])->create();

        Livewire::actingAs($user)
            ->test(DeleteUser::class)
            ->call('delete', $user->id)
            ->assertForbidden();

        $this->assertFalse($user->fresh()->trashed());
    }

    /** @test */
    public function admin_can_not_delete_himself()
    {
        $user = User::factory()->admin()->create();

        Livewire::actingAs($user)
            ->test(DeleteUser::class)
            ->call('delete', $user->id);

        $this->assertFalse($user->fresh()->trashed());
    }

    /** @test */
    public function user_can_delete_another_member()
    {
        $user = User::factory()->abilities(['user:viewAny', 'user:delete'])->create();
        $otherUser = User::factory()->create();

        Livewire::actingAs($user)
            ->test(DeleteUser::class)
            ->call('delete', $otherUser->id)
            ->call('destroy');

        $this->assertTrue($otherUser->fresh()->trashed());
    }
}
