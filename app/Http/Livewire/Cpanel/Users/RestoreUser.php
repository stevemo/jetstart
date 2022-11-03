<?php

namespace App\Http\Livewire\Cpanel\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RestoreUser extends Component
{
    use AuthorizesRequests;

    public $show = false;

    public $userId;

    protected $listeners = ['user:restore' => 'showModal'];

    public function showModal($userId)
    {
        $this->authorize('restore', User::withTrashed()->findOrFail($userId));
        $this->userId = $userId;
        $this->show = true;
    }

    public function restore()
    {
        $user = User::withTrashed()->findOrFail($this->userId);
        $this->authorize('restore', $user);

        $user->restore();
        $this->show = false;
        $this->emit('user:restored', 'User restored!');
    }
}
