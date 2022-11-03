<?php

namespace Tests\Feature\Livewire\Cpanel\Users;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\Cpanel\Users\UserAbilities;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserAbilitiesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_component_can_render_with_proper_ability()
    {
        $userWithAbility = User::factory()->abilities(['user:update'])->create();
        $userWithout = User::factory()->create();

        $this->get(route('cpanel.users.abilities', $userWithout))
            ->assertRedirect('/login');

        $this->actingAs($userWithout)
            ->get(route('cpanel.users.abilities', $userWithout))
            ->assertForbidden();

        $this->actingAs($userWithAbility)
            ->get(route('cpanel.users.abilities', $userWithout))
            ->assertOk();
    }

    /** @test */
    public function user_abilities_are_available()
    {
        config()->set('abilities', [':ability-config:']);
        $user = User::factory()->abilities(['view', 'create'])->create();
        $this->actingAs($loginUser = User::factory()->abilities(['user:update'])->create());

        $component = Livewire::test(UserAbilities::class, ['user' => $user]);

        $this->assertEquals(collect(['view', 'create']), $component->state);
        $this->assertTrue($user->is($component->user));
        $this->assertEquals([':ability-config:'], $component->abilities);
    }
}
