@extends('layouts.main')

@section('content')
    {{-- sweetalert popup success --}}
    @if (session('success'))
        <script>
            Swal.fire({
                title: "Success",
                text: "{{ session('success') }}",
                icon: "success"
            });
        </script>
    @endif
    {{-- sweetalert popup error --}}
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
            <span class="text">Items</span>
        </div>
        <div class="add-category-container">
            <a href="/items/create" class="btn-add-category">Add Item</a>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Item Name</th>
                        <th>Item Unit</th>
                        <th>Item Category</th>
                        <th>Item Code</th>
                        <th>Item Price</th>
                        <th>Item Stock</th>
                        <th>Item Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ ($items->currentPage() - 1) * $items->perPage() + $loop->index + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->unit->name }}</td>
                            <td>{{ $item->category->name }}</td>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->stock }}</td>
                            <td><img src="{{ asset('storage/images/' . $item->image) }}" alt="{{ $item->name }}"
                                    style="max-height: 100px; width: auto; object-fit: contain;"></td>
                            <td>
                                <div>
                                    <a href="/items/edit/{{ $item->id }}" class="btn-edit">Edit</a>
                                    <button type="button" class="btn-delete"
                                        onclick="openDeleteModal({{ $item->id }}, '{{ $item->name }}','/items/delete/{{ $item->id }}')">Delete</button>
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
