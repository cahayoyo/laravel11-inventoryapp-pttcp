@extends('layouts.main')

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
        {{-- Pagination --}}
        @include('layouts.pagination', ['paginator' => $items])

        {{-- Delete Modal --}}
        @include('layouts.delete-modal')

    </div>
@endsection
