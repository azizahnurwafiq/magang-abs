<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserSearch extends Component
{
    public $kataKunci;

    public function render()
    {
        if ($this->kataKunci != null) {
            $users = User::where('username', 'like', '%' . $this->kataKunci . '%')
                ->orWhere('role', 'like', '%' . $this->kataKunci . '%')
                ->paginate(5);
        } else {
            $users = User::paginate(5);
        }

        return view('livewire.user-search', compact('users'));
    }
}
