@extends('layouts.main')

@section('title', 'TCP - Items')

@section('content')
    {{-- Alert Component --}}
    @include('layouts.alert')

    <div class="overview">
        {{-- Page Header Component --}}
        @include('layouts.header', [
            'icon' => 'uil uil-table',
            'title' => 'Items',
            'addButtonText' => 'Add Item',
            'addButtonLink' => '/items/create',
        ])

        {{-- Search Box --}}
        @include('layouts.search-box', [
            'action' => '/items',
            'placeholder' => 'Search item...',
        ])

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Item Code</th>
                        <th>Item Name</th>
                        <th>Item Category</th>
                        <th>Item Stock</th>
                        <th>Item Unit</th>
                        <th>Item Image</th>
                        @if (auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin')
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ ($items->currentPage() - 1) * $items->perPage() + $loop->index + 1 }}</td>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->category->name }}</td>
                            <td>{{ $item->stock }}</td>
                            <td>{{ $item->unit->name }}</td>
                            <td><img src="{{ asset('storage/images/' . $item->image) }}" alt="{{ $item->name }}"
                                    style="max-height: 150px; width: auto; object-fit: contain;"></td>
                            <td>
                                @if (auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin')
                                    <div>
                                        <a href="/items/edit/{{ $item->id }}" class="btn-edit">Edit</a>
                                        <button type="button" class="btn-delete"
                                            onclick="openDeleteModal({{ $item->id }}, '{{ $item->name }}','/items/delete/{{ $item->id }}')">Delete</button>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- Pagination --}}
        @include('layouts.pagination', ['paginator' => $items])

        {{-- Delete Modal --}}
        @include('layouts.delete-modal')

    </div>
@endsection
