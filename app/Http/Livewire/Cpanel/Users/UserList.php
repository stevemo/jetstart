<?php

namespace App\Http\Livewire\Cpanel\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserList extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    protected $listeners = [
        'user:deleted'  => 'listenerResponse',
        'user:restored' => 'listenerResponse',
    ];

    public function mount()
    {
        $this->authorize('viewAny', User::class);
    }

    public function getUsersProperty()
    {
        return User::withTrashed()->paginate();
    }

    public function listenerResponse($message)
    {
        $this->notify($message);
    }
}
