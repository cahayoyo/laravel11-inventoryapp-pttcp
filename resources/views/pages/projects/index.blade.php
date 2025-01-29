@extends('layouts.main')

@section('content')
    {{-- Alert Component --}}
    @include('layouts.alert')

    <div class="overview">
        {{-- Page Header Component --}}
        @include('layouts.header', [
            'icon' => 'uil uil-bag',
            'title' => 'Projects',
            'addButtonText' => 'Add Project',
            'addButtonLink' => '/projects/create',
        ])

        {{-- Search Box --}}
        @include('layouts.search-box', [
            'action' => '/projects',
            'placeholder' => 'Search project...',
        ])

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
                        @if (auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin')
                            <th>Action</th>
                        @endif
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
                                @if (auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin')
                                    <div>
                                        <a href="/projects/edit/{{ $project->id }}" class="btn-edit">Edit</a>
                                        <button type="button" class="btn-delete"
                                            onclick="openDeleteModal({{ $project->id }}, '{{ $project->name }}','/projects/delete/{{ $project->id }}')">Delete</button>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- Pagination --}}
        @include('layouts.pagination', ['paginator' => $projects])

        {{-- Delete Modal --}}
        @include('layouts.delete-modal')

    </div>
@endsection
