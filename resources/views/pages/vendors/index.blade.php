@extends('layouts.main')

@section('title', 'TCP - Vendors')

@section('content')
    {{-- Alert Component --}}
    @include('layouts.alert')

    <div class="overview">
        {{-- Page Header Component --}}
        @include('layouts.header', [
            'icon' => 'uil uil-store',
            'title' => 'Vendor',
            'addButtonText' => 'Add Vendor',
            'addButtonLink' => '/vendors/create',
        ])

        {{-- Search Box --}}
        @include('layouts.search-box', [
            'action' => '/vendors',
            'placeholder' => 'Search vendor...',
        ])

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Vendor Name</th>
                        <th>Vendor Email</th>
                        <th>Vendor Address</th>
                        <th>Vendor Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vendors as $vendor)
                        <tr>
                            <td>{{ ($vendors->currentPage() - 1) * $vendors->perPage() + $loop->index + 1 }}</td>
                            <td>{{ $vendor->name }}</td>
                            <td>{{ $vendor->email }}</td>
                            <td>{{ $vendor->address }}</td>
                            <td>{{ $vendor->phone }}</td>
                            <td>
                                <div>
                                    <a href="/vendors/edit/{{ $vendor->id }}" class="btn-edit">Edit</a>
                                    <button type="button" class="btn-delete"
                                        onclick="openDeleteModal({{ $vendor->id }}, '{{ $vendor->name }}','/vendors/delete/{{ $vendor->id }}')">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- Pagination --}}
        @include('layouts.pagination', ['paginator' => $vendors])

        {{-- Delete Modal --}}
        @include('layouts.delete-modal')

    </div>
@endsection
