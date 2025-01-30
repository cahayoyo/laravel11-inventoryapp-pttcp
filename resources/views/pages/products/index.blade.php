@extends('layouts.main')

@section('title', 'TCP - Products')

@section('content')
    {{-- Alert Component --}}
    @include('layouts.alert')

    <div class="overview">
        {{-- Page Header Component --}}
        @include('layouts.header', [
            'icon' => 'uil uil-layers',
            'title' => 'Products',
            'addButtonText' => 'Add Product',
            'addButtonLink' => '/products/create',
        ])

        {{-- Search Box --}}
        @include('layouts.search-box', [
            'action' => '/products',
            'placeholder' => 'Search product...',
        ])

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Product Name</th>
                        <th>Product Stock</th>
                        <th>Product Unit</th>
                        @if (auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin')
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->index + 1 }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->unit->name }}</td>
                            <td>
                                @if (auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin')
                                    <div>
                                        <a href="/products/edit/{{ $product->id }}" class="btn-edit">Edit</a>
                                        <button type="button" class="btn-delete"
                                            onclick="openDeleteModal({{ $product->id }}, '{{ $product->name }}','/products/delete/{{ $product->id }}')">Delete</button>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- Pagination --}}
        @include('layouts.pagination', ['paginator' => $products])

        {{-- Delete Modal --}}
        @include('layouts.delete-modal')

    </div>
@endsection
