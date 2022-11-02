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

    public $showDeleteModal = false;

    public $userId;

    public function mount()
    {
        $this->authorize('viewAny', User::class);
    }

    public function getUsersProperty()
    {
        return User::withTrashed()->paginate();
    }

    public function delete(User $user)
    {
        $this->authorize('delete', $user);

        $this->userId = $user->id;
        $this->showDeleteModal = true;
    }

    public function destroy()
    {
        $user = User::findOrFail($this->userId);

        $this->authorize('delete', $user);

        $user->delete();

        $this->showDeleteModal = false;
        $this->userId = null;
        $this->notify('User Suspended!');
    }
}
