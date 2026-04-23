<div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit="search">
        <div class="row">
            <div class="col-10">
                <input type="text"
                       class="form-control"
                       wire:model.live.debounce.250ms="searchquery"
                       placeholder="Search Here..">
            </div>

            <div class="col-2">
                <button type="submit" class="btn btn-success w-100">
                    Search
                </button>
            </div>
        </div>
    </form>
</div>
