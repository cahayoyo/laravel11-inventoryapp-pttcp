@extends('layouts.main')

@section('content')
    {{-- Alert Component --}}
    @include('layouts.alert')

    <div class="overview">
        {{-- Page Header Component --}}
        @include('layouts.header', [
            'icon' => 'uil uil-users-alt',
            'title' => 'Clients',
            'addButtonText' => 'Add Client',
            'addButtonLink' => '/clients/create',
        ])

        {{-- Search Box --}}
        @include('layouts.search-box', [
            'action' => '/clients',
            'placeholder' => 'Search client...',
        ])

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Client Name</th>
                        <th>Client Email</th>
                        <th>Client Address</th>
                        <th>Client Phone</th>
                        <th>Client Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td>{{ ($clients->currentPage() - 1) * $clients->perPage() + $loop->index + 1 }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->address }}</td>
                            <td>{{ $client->phone }}</td>
                            <td><img src="{{ asset('storage/images/' . $client->image) }}" alt="{{ $client->name }}"
                                    style="max-height: 100px; width: auto; object-fit: contain;"></td>
                            <td>
                                <div>
                                    <a href="/clients/edit/{{ $client->id }}" class="btn-edit">Edit</a>
                                    <button type="button" class="btn-delete"
                                        onclick="openDeleteModal({{ $client->id }}, '{{ $client->name }}','/clients/delete/{{ $client->id }}')">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- Pagination --}}
        @include('layouts.pagination', ['paginator' => $clients])

        {{-- Delete Modal --}}
        @include('layouts.delete-modal')

    </div>
@endsection
