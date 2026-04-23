<div>

    <style>
        div {
            padding: 0px;
        }

        /* Table Container */
        .table-container {
            overflow-x: auto;
            margin: 20px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        /* Fixed Table Structure */
        .fixed-table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            font-size: 14px;
            min-width: 600px;
        }

        /* Table Header */
        .fixed-table thead tr {
            background-color: #f2f2f2;
            border-bottom: 2px solid #ddd;
        }

        .fixed-table th {
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            color: #333;
        }

        /* Table Body */
        .fixed-table tbody tr {
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s;
        }

        .fixed-table tbody tr:hover {
            background-color: #f5f5f5;
        }

        .fixed-table td {
            padding: 12px 15px;
            color: #555;
        }

        /* Column Widths */
        .col-name {
            width: 25%;
        }

        .col-email {
            width: 30%;
        }

        .col-mobile {
            width: 25%;
        }

        .col-action {
            width: 20%;
        }

        /* Button Styles */
        .edit-btn,
        .delete-btn {
            padding: 5px 12px;
            margin: 0 5px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.3s;
        }

        .edit-btn {
            background-color: #4CAF50;
            color: white;
        }

        .edit-btn:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        .delete-btn {
            background-color: #f44336;
            color: white;
        }

        .delete-btn:hover {
            background-color: #da190b;
            transform: scale(1.05);
        }

        /* No Records Row */
        .no-records {
            text-align: center;
            padding: 40px !important;
            color: #999;
            font-style: italic;
        }

        /* Pagination Container */
        .pagination-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        /* Responsive Design */
        @media (max-width: 768px) {

            .fixed-table th,
            .fixed-table td {
                padding: 8px 10px;
                font-size: 12px;
            }

            .edit-btn,
            .delete-btn {
                padding: 4px 8px;
                font-size: 11px;
            }
        }

        /* Zebra striping for better readability */
        .fixed-table tbody tr:nth-child(even) {
            background-color: #fafafa;
        }

        .fixed-table tbody tr:nth-child(even):hover {
            background-color: #f5f5f5;
        }
    </style>

    <h3>User List </h3>
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

    <div class="table-container">
        <table class="fixed-table">
            <thead>
                <tr>
                    <th class="col-id">#</th>
                    <th class="col-name">Name</th>
                    <th class="col-email">Email</th>
                    <th class="col-mobile">Mobile</th>
                    <th class="col-profile">Profile</th>
                    <th class="col-action">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $key => $user)
                    <tr>
                        <td class="col-id">{{ ++$key }}</td>
                        <td class="col-name">{{ $user->name }}</td>
                        <td class="col-email">{{ $user->email }}</td>
                        <td class="col-mobile">{{ $user->mobile_number }}</td>
                        <td class="col-profile"> <a href="#"
                                wire:click.prevent="profileDownload({{ $user->id }})">
                                <img src="{{ Storage::url($user->profile_picture) }}" height="60">
                            </a> </td>
                        <td class="col-action">
                            <button class="edit-btn" wire:click="edit({{ $user->id }})">Edit</button>
                            <button class="delete-btn" wire:click="delete({{ $user->id }})">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="no-records">NO RECORDS !!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($users->count())
        <div class="row align-items-center">

            <!-- Pagination -->
            <div class="col-10">
                {{ $users->links() }}
            </div>

            <!-- Reset Button -->
            <div class="col-2 text-end">
                <button class="btn btn-danger" wire:click="resetPageData">
                    Reset
                </button>
            </div>

        </div>
    @endif
</div>
