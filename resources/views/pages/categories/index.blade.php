@extends('layouts.main')

@section('title', 'TCP - Categories')

@section('content')
    {{-- Alert Component --}}
    @include('layouts.alert')

    <div class="overview">
        {{-- Page Header Component --}}
        @include('layouts.header', [
            'icon' => 'uil uil-grids',
            'title' => 'Categories',
            'addButtonText' => 'Add Category',
            'addButtonLink' => '/categories/create',
        ])

        {{-- Search Box --}}
        @include('layouts.search-box', [
            'action' => '/categories',
            'placeholder' => 'Search categories...',
        ])

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
        {{-- Pagination --}}
        @include('layouts.pagination', ['paginator' => $categories])

        {{-- Delete Modal --}}
        @include('layouts.delete-modal')

    </div>
@endsection
