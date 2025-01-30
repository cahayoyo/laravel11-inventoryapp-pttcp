@extends('layouts.main')

@section('title', 'TCP - Units')

@section('content')
    {{-- Alert Component --}}
    @include('layouts.alert')

    <div class="overview">
        {{-- Page Header Component --}}
        @include('layouts.header', [
            'icon' => 'uil uil-pathfinder-unite',
            'title' => 'Units',
            'addButtonText' => 'Add Units',
            'addButtonLink' => '/units/create',
        ])

        {{-- Search Box --}}
        @include('layouts.search-box', [
            'action' => '/units',
            'placeholder' => 'Search unit...',
        ])

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Unit Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($units as $unit)
                        <tr>
                            <td>{{ ($units->currentPage() - 1) * $units->perPage() + $loop->index + 1 }}</td>
                            <td>{{ $unit->name }}</td>
                            <td>
                                <div>
                                    <a href="/units/edit/{{ $unit->id }}" class="btn-edit">Edit</a>
                                    <button type="button" class="btn-delete"
                                        onclick="openDeleteModal({{ $unit->id }}, '{{ $unit->name }}','/units/delete/{{ $unit->id }}')">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- Pagination --}}
        @include('layouts.pagination', ['paginator' => $units])

        {{-- Delete Modal --}}
        @include('layouts.delete-modal')

    </div>
@endsection
