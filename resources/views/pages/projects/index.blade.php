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
            <span class="text">Projects</span>
        </div>
        <div class="add-category-container">
            <a href="/projects/create" class="btn-add-category">Add Project</a>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Project Name</th>
                        <th>Project Value</th>
                        <th>Project Location</th>
                        <th>Project Client</th>
                        <th>IPA Baja</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td>{{ ($projects->currentPage() - 1) * $projects->perPage() + $loop->index + 1 }}</td>
                            <td>{{ $project->name }}</td>
                            <td>Rp {{ number_format($project->project_value, 0, ',', '.') }}</td>
                            <td>{{ $project->location }}</td>
                            <td>{{ $project->client->name }}</td>
                            <td>{{ $project->ipaBaja->name }}</td>
                            <td>
                                <span class="badge {{ $project->status == 'ongoing' ? 'badge-warning' : 'badge-success' }}">
                                    {{ $project->status }}
                                </span>
                            </td>
                            <td>
                                <div>
                                    <a href="/projects/edit/{{ $project->id }}" class="btn-edit">Edit</a>
                                    <button type="button" class="btn-delete"
                                        onclick="openDeleteModal({{ $project->id }}, '{{ $project->name }}','/projects/delete/{{ $project->id }}')">Delete</button>
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
