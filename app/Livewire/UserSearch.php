<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class UserSearch extends Component
{

    public $searchquery;

    public function search()
    {
        $this->dispatch('searchResult', searchquery: $this->searchquery)->to(UserList::class);
    }

    public function render()
    {
        return view('livewire.user-search');
    }
}
