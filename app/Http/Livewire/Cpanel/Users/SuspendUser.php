<?php

namespace App\Http\Livewire\Cpanel\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SuspendUser extends Component
{
    use AuthorizesRequests;

    public $user;

    public $show = false;

    protected $listeners = ['user:suspend' => 'delete'];

    public function delete(User $user)
    {
        $this->authorize('delete', $user);

        if ($this->isNotMe($user)) {
            $this->user = $user;
            $this->show = true;
        }
    }

    public function destroy()
    {
        $this->authorize('delete', $this->user);

        if ($this->isNotMe($this->user)) {
            $this->user->delete();

            $this->show = false;
            $this->user = null;
            $this->emit('user:suspended', 'User suspended!');
        }
    }

    protected function isNotMe($user)
    {
        return $user->isNot(auth()->user());
    }
}
