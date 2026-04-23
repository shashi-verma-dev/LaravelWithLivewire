<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
// use Illuminate\Container\Attributes\Log;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class UserCreate extends Component
{

    use WithFileUploads;
    public $name, $email, $mobile_number, $profile_picture, $docs_pdf;

    public function save()
    {
        try {
            $this->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'mobile_number' => 'required|numeric|unique:users',
                'profile_picture' => 'nullable|image|max:2048',
                'docs_pdf' => 'nullable|mimes:pdf|max:2048',
            ]);

            $imagePath = $this->profile_picture?->store('profile_pictures', 'public');
            $pdfPath = $this->docs_pdf?->store('docs_pdfs', 'public');

            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'mobile_number' => $this->mobile_number,
                'profile_picture' => ($imagePath)?$imagePath:null,
                'docs_pdf' => ($pdfPath)?$pdfPath:null,
                'password' => Hash::make('12345678'),
            ]);

            $this->reset();
            session()->flash('success', "User Created Successfully");
            // 🔥 Notify list to refresh
            $this->dispatch('refreshList')->to(UserList::class);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            Log::info($e->getMessage());
            return $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.user-create');
    }
}
