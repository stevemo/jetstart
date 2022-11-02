<?php

namespace App\Http\Livewire\Cpanel\Users;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RestoreUser extends Component
{
    use AuthorizesRequests;

    public $show = false;

    protected $listeners = ['user:restore' => 'restore'];

    public function restore($userId)
    {
        $this->show = true;
    }
}
