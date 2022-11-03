<?php

namespace Tests\Feature\Livewire\Cpanel\Users;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\Cpanel\Users\RestoreUser;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RestoreUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function need_ability_to_restore_user()
    {
        $user = User::factory()->abilities(['user:viewAny'])->create();
        $otherUser = User::factory()->create();

        Livewire::actingAs($user)
            ->test(RestoreUser::class)
            ->call('showModal', $otherUser->id)
            ->assertForbidden();
    }

    /** @test */
    public function can_restore_user()
    {
        $user = User::factory()->abilities(['user:viewAny', 'user:restore'])->create();
        $otherUser = User::factory()->trashed()->create();

        Livewire::actingAs($user)
            ->test(RestoreUser::class)
            ->call('showModal', $otherUser->id)
            ->call('restore')
            ->assertOk();

        $this->assertFalse($otherUser->fresh()->trashed());
    }
}
