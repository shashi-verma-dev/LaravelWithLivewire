<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @livewireStyles
</head>

<body>
    <div class="container-fluid mt-4">
        <div class="row">


            <div class="col-4">
                <livewire:user-create />
            </div>

            <!-- User List - Column 2 -->
            <div class="col-8">

                <livewire:user-search />


                <livewire:user-list />
            </div>

            <!-- User List - Column 2 -->
            <div class="col-12">
                <livewire:user-edit />
            </div>

            <div class="col-12">
                <livewire:apex-charts />
            </div>
        </div>
    </div>

    @livewireScripts
</body>

</html>
