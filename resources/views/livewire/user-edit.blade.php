<div>
    <!-- Flash Message Display -->
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif
    @if ($user_id)
        <h3>Edit User</h3>



        <form wire:submit="update">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <input wire:model="name">

            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <input wire:model="email">

            @error('mobile_number')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <input wire:model="mobile_number">

            @error('profile_picture')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <input type="file" wire:model="profile_picture">

            @if ($this->getProfilePictureUrl())
                <img src="{{ $this->getProfilePictureUrl() }}" height="40" style="margin-bottom:10px;">
            @endif

            @error('docs_pdf')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <input type="file" wire:model="docs_pdf">

            <button type="submit">Update

                <div wire:loading>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <circle cx="12" cy="2" r="0" fill="currentColor">
                            <animate attributeName="r" begin="0" calcMode="spline" dur="1s"
                                keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite"
                                values="0;2;0;0" />
                        </circle>
                        <circle cx="12" cy="2" r="0" fill="currentColor" transform="rotate(45 12 12)">
                            <animate attributeName="r" begin="0.125s" calcMode="spline" dur="1s"
                                keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite"
                                values="0;2;0;0" />
                        </circle>
                        <circle cx="12" cy="2" r="0" fill="currentColor" transform="rotate(90 12 12)">
                            <animate attributeName="r" begin="0.25s" calcMode="spline" dur="1s"
                                keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite"
                                values="0;2;0;0" />
                        </circle>
                        <circle cx="12" cy="2" r="0" fill="currentColor" transform="rotate(135 12 12)">
                            <animate attributeName="r" begin="0.375s" calcMode="spline" dur="1s"
                                keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite"
                                values="0;2;0;0" />
                        </circle>
                        <circle cx="12" cy="2" r="0" fill="currentColor" transform="rotate(180 12 12)">
                            <animate attributeName="r" begin="0.5s" calcMode="spline" dur="1s"
                                keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite"
                                values="0;2;0;0" />
                        </circle>
                        <circle cx="12" cy="2" r="0" fill="currentColor" transform="rotate(225 12 12)">
                            <animate attributeName="r" begin="0.625s" calcMode="spline" dur="1s"
                                keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite"
                                values="0;2;0;0" />
                        </circle>
                        <circle cx="12" cy="2" r="0" fill="currentColor" transform="rotate(270 12 12)">
                            <animate attributeName="r" begin="0.75s" calcMode="spline" dur="1s"
                                keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite"
                                values="0;2;0;0" />
                        </circle>
                        <circle cx="12" cy="2" r="0" fill="currentColor"
                            transform="rotate(315 12 12)">
                            <animate attributeName="r" begin="0.875s" calcMode="spline" dur="1s"
                                keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite"
                                values="0;2;0;0" />
                        </circle>
                    </svg>
                </div>

            </button>

            <br />
            <br />
            <button type="button" class="btn btn-danger" wire:click="closeEditForm">Cancel</button>

        </form>
        <br><br>
    @endif
</div>
