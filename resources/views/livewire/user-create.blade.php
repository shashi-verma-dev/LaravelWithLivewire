<div class="form-container">
    <style>
        /* Basic Form Container */
        .form-container {
            width: 100%;
            padding: 20px;
            border-radius: 8px;
        }

        /* Heading Style */
        h3 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-family: Arial, sans-serif;
        }

        /* Input Field Styles */
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: #4CAF50;
        }

        /* File Input Specific Styles */
        input[type="file"] {
            padding: 8px;
            /* background-color: white; */
        }

        /* Button Styles */
        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        button:active {
            transform: scale(0.98);
        }

        /* Placeholder Styles */
        input::placeholder {
            color: #999;
            font-style: italic;
        }
    </style>

    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <h3>Create User</h3>

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


    <form wire:submit="save">
        <input type="text" wire:model="name" placeholder="Enter name">
        <input wire:model="email" placeholder="Email">
        <input wire:model="mobile_number" placeholder="Mobile">

        <input type="file" wire:model="profile_picture">
        @if ($profile_picture)
            <img src="{{ $profile_picture->temporaryUrl() }}" alt="" height="40" style="margin-bottom:10px;">
        @endif

        <input type="file" wire:model="docs_pdf">

        {{-- 
        <div wire:ignore>
            <div id="quillEditor" style="height: 200px;"></div>
        </div>

        <input type="hidden" wire:model="content" id="quillContent">
        <br> --}}

        <button type="submit">Save
        </button>
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
                <circle cx="12" cy="2" r="0" fill="currentColor" transform="rotate(315 12 12)">
                    <animate attributeName="r" begin="0.875s" calcMode="spline" dur="1s"
                        keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite"
                        values="0;2;0;0" />
                </circle>
            </svg>
        </div>
    </form>

    {{-- <script>
        document.addEventListener('livewire:init', function() {

            const quill = new Quill('#quillEditor', {
                theme: 'snow'
            });

            quill.root.innerHTML = @this.get('content') || '';

            quill.on('text-change', function() {
                @this.set('content', quill.root.innerHTML);
            });

        });
    </script> --}}
</div>
