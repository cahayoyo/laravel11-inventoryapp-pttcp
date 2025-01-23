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
            <span class="text">Categories</span>
        </div>
        <div class="add-category-container">
            <a href="/categories/create" class="btn-add-category">Add Category</a>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->index + 1 }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <div>
                                    <a href="/categories/edit/{{ $category->id }}" class="btn-edit">Edit</a>
                                    <button type="button" class="btn-delete"
                                        onclick="openDeleteModal({{ $category->id }}, '{{ $category->name }}','/categories/delete/{{ $category->id }}')">Delete</button>
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
