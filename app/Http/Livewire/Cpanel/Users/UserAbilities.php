<?php

namespace App\Http\Livewire\Cpanel\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserAbilities extends Component
{
    use AuthorizesRequests;

    public User $user;

    public $state = [];

    public $abilities = [];

    public function mount(User $user)
    {
        $this->authorize('update', $user);
        $this->user = $user;
        $this->abilities = collect(config('abilities', []));
        $this->state = $this->user->abilities;
    }
}
