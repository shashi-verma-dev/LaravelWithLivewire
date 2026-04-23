<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class UserEdit extends Component
{
    use WithFileUploads;

    public $user_id;
    public $name, $email, $mobile_number;
    public $profile_picture, $docs_pdf;



    #[On('editUser')]
    public function editUser($id)
    {
        $user = User::find($id);

        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->profile_picture = $user->profile_picture;
        $this->docs_pdf = $user->docs_pdf;
        $this->mobile_number = $user->mobile_number;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->user_id)],
            'mobile_number' => ['required', 'numeric', Rule::unique('users', 'mobile_number')->ignore($this->user_id)],
            'profile_picture' => 'nullable|image|max:2048',
            'docs_pdf' => 'nullable|mimes:pdf|max:2048',
        ]);

        $user = User::find($this->user_id);

        $this->profile_picture = ($this->profile_picture) ? $this->profile_picture->store('profile_pictures', 'public') :
            $user->profile_picture;
        $this->docs_pdf = ($this->docs_pdf) ? $this->docs_pdf->store('docs_pdfs', 'public') :
            $user->docs_pdf;
        // dd($this->profile_picture ,  $this->docs_pdf, $this->name);

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'mobile_number' => $this->mobile_number,
            'profile_picture' => $this->profile_picture,
            'docs_pdf' => $this->docs_pdf,
        ]);

        $this->dispatch('refreshList')->to(UserList::class);
        $this->reset();
        session()->flash('success', 'User updated successfully.');
    }

    public function closeEditForm() {
        $this->reset();
    }

    public function getProfilePictureUrl()
    {
        if ($this->profile_picture instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
            return $this->profile_picture->temporaryUrl();
        }

        if ($this->profile_picture) {
            return Storage::url($this->profile_picture);
        }

        return null;
    }

    public function render()
    {
        return view('livewire.user-edit');
    }
}
