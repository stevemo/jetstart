<?php

namespace Tests\Feature\Livewire\Cpanel\Users;

use App\Http\Livewire\Cpanel\Users\RestoreUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RestoreUserTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(RestoreUser::class);

        $component->assertStatus(200);
    }
}
