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
            <span class="text">Item Entries</span>
        </div>
        <div class="add-category-container">
            <a href="/item-entries/create" class="btn-add-category">Add Item Entry</a>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Reference Number</th>
                        <th>Item</th>
                        <th>Vendor</th>
                        <th>Total Price</th>
                        <th>Payment</th>
                        <th>Quantity</th>
                        <th>Entry Date</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itemEntries as $entry)
                        <tr>
                            <td>{{ ($itemEntries->currentPage() - 1) * $itemEntries->perPage() + $loop->index + 1 }}</td>
                            <td>{{ $entry->reference_number }}</td>
                            <td>{{ $entry->item->name }}</td>
                            <td>{{ $entry->vendor->name }}</td>
                            <td>Rp {{ number_format($entry->total_price, 0, ',', '.') }}</td>
                            <td>{{ $entry->payment }}</td>
                            <td>{{ $entry->quantity }}</td>
                            <td>{{ \Carbon\Carbon::parse($entry->entry_date)->format('d M Y') }}</td>
                            <td>{{ $entry->description ?? '-' }}</td>
                            <td>
                                <div>
                                    <a href="/item-entries/edit/{{ $entry->id }}" class="btn-edit">Edit</a>
                                    <button type="button" class="btn-delete"
                                        onclick="openDeleteModal({{ $entry->id }}, '{{ $entry->reference_number }}','/item-entries/delete/{{ $entry->id }}')">Delete</button>
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
