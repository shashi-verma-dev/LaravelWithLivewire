<?php

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

new class extends Component {
    public string $name = '';
    public string $email = '';
    public string $mobile_number = '';
    public string $address = '';

    public function save()
    {
        try {
            $this->validate(
                [
                    'name' => 'required|max:255',
                    'email' => 'required|email|unique:users,email',
                    'mobile_number' => 'required|string|max:10|unique:users,mobile_number',
                    'address' => 'nullable|max:255',
                ],
                [
                    'name.required' => 'Name field is required!',
                    'name.max' => 'Name must not exceed 255 characters!',
                    'email.required' => 'Email is required!',
                    'email.email' => 'Enter a valid email address!',
                    'email.unique' => 'This email is already taken!',
                    'mobile_number.required' => 'Mobile Number is required!',
                    'mobile_number.unique' => 'This Mobile Number is already taken!',
                ],
            );

            $userData = new User();
            $userData->name = $this->name;
            $userData->email = $this->email;
            $userData->mobile_number = $this->mobile_number;
            $userData->address = $this->address;
            $userData->password = Hash::make('12345678');
            $userData->save();

            session()->flash('success', 'successfully inserted !!');
            $this->reset(['name', 'email', 'mobile_number', 'address']);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }
};
?>

<div>
    <center>
        @if (session()->has('success'))
            <div style="color: green;  padding: 8px; margin-bottom: 10px;">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div style="color: red;  padding: 8px; margin-bottom: 10px;">
                {{ session('error') }}
            </div>
        @endif
        <div style="text-align: left;">
            <form wire:submit.prevent="save" style="max-width: 400px; margin: auto;">

                <!-- Name -->
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Name</label>
                    <input type="text" wire:model="name" style="width: 100%; border: 1px solid black; padding: 8px;">
                    @error('name')
                        <span style="color: red; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Mobile -->
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Mobile Number</label>
                    <input type="number" wire:model="mobile_number"
                        style="width: 100%; border: 1px solid black; padding: 8px;">
                    @error('mobile_number')
                        <span style="color: red; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Email</label>
                    <input type="email" wire:model="email"
                        style="width: 100%; border: 1px solid black; padding: 8px;">
                    @error('email')
                        <span style="color: red; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Address -->
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Address</label>
                    <textarea wire:model="address" rows="3" style="width: 100%; border: 1px solid black; padding: 8px;"></textarea>
                    @error('address')
                        <span style="color: red; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Button -->
                <button type="submit"
                    style="padding: 8px 15px; border: none; background: black; color: white; cursor: pointer;">
                    Save Post
                </button>

            </form>
        </div>
    </center>
</div>
