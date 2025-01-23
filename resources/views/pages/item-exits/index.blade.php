@extends('layouts.main')

@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                title: "Success",
                text: "{{ session('success') }}",
                icon: "success"
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                title: "Error",
                text: "{{ session('error') }}",
                icon: "error"
            });
        </script>
    @endif

    <div class="overview">
        <div class="title">
            <i class="uil uil-grids"></i>
            <span class="text">Item Exits</span>
        </div>
        <div class="add-category-container">
            <a href="/item-exits/create" class="btn-add-category">Add Item Exit</a>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Reference Number</th>
                        <th>Item</th>
                        <th>Client</th>
                        <th>Project</th>
                        <th>Quantity</th>
                        <th>Exit Date</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itemExits as $exit)
                        <tr>
                            <td>{{ ($itemExits->currentPage() - 1) * $itemExits->perPage() + $loop->index + 1 }}</td>
                            <td>{{ $exit->reference_number }}</td>
                            <td>{{ $exit->item->name }}</td>
                            <td>{{ $exit->client->name }}</td>
                            <td>{{ $exit->project->name }}</td>
                            <td>{{ $exit->quantity }}</td>
                            <td>{{ \Carbon\Carbon::parse($exit->exit_date)->format('d M Y') }}</td>
                            <td>{{ $exit->description ?? '-' }}</td>
                            <td>
                                <div>
                                    <a href="/item-exits/edit/{{ $exit->id }}" class="btn-edit">Edit</a>
                                    <button type="button" class="btn-delete"
                                        onclick="openDeleteModal({{ $exit->id }}, '{{ $exit->reference_number }}','/item-exits/delete/{{ $exit->id }}')">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="deleteModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                    <button class="btn-close" onclick="closeDeleteModal()">&times;</button>
                </div>
                <div class="modal-body">
                    Are you sure to delete <strong id="deleteItemName"></strong> ?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn-cancel" onclick="closeDeleteModal()">Cancel</button>
                        <button type="submit" class="btn-delete">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
