<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use App\Livewire\UserEdit;
use Illuminate\Support\Facades\Storage;


class UserList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';

    #[On('refreshList')]
    public function refreshList()
    {
        $this->resetPage();
    }

    #[On('searchResult')]
    public function searchResult($searchquery)
    {
        $this->search = $searchquery;
        $this->resetPage();
    }



    public function edit($id)
    {
        $this->dispatch('editUser', $id)->to(UserEdit::class);
    }

    public function delete($id)
    {
        try {
            User::find($id)?->delete();
            session()->flash('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return $e->getMessage();
        }
    }

    public function resetPageData()
    {
        $this->resetPage();
    }

    public function profileDownload($id)
    {
        $user = User::findOrFail($id);

        $path = $user->profile_picture;

        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'File not found');
        }

        return Storage::disk('public')->download($path);
    }

    public function render()
    {
        $query = User::query();

        if ($this->search) {
            $query->where('email', 'like', '%' . $this->search . '%');
        }

        return view('livewire.user-list', [
            'users' => $query->latest()->paginate(3)
        ]);
    }
}
