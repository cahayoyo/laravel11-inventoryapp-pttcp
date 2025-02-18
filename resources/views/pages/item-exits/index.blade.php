@extends('layouts.main')

@section('title', 'TCP - Item Exits')

@section('content')
    {{-- Alert Component --}}
    @include('layouts.alert')

    <div class="overview">
        {{-- Page Header Component --}}
        @include('layouts.header', [
            'icon' => 'uil uil-arrow-circle-up',
            'title' => 'Item Exits',
            'addButtonText' => 'Add Item Exit',
            'addButtonLink' => '/item-exits/create',
        ])

        {{-- Search Box --}}
        @include('layouts.search-box', [
            'action' => '/item-exits',
            'placeholder' => 'Search item exit...',
        ])

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Reference Number</th>
                        <th>Product</th>
                        <th>Client</th>
                        <th>Project</th>
                        <th>Quantity</th>
                        <th>Exit Date</th>
                        <th>Description</th>
                        @if (auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin')
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itemExits as $exit)
                        <tr>
                            <td>{{ ($itemExits->currentPage() - 1) * $itemExits->perPage() + $loop->index + 1 }}</td>
                            <td>{{ $exit->reference_number }}</td>
                            <td>{{ $exit->product->name }}</td>
                            <td>{{ $exit->project->client->name }}</td>
                            <td>{{ $exit->project->name }}</td>
                            <td>{{ $exit->quantity }}</td>
                            <td>{{ \Carbon\Carbon::parse($exit->exit_date)->format('d M Y') }}</td>
                            <td>{{ $exit->description ?? '-' }}</td>
                            <td>
                                @if (auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin')
                                    <div>
                                        <a href="/item-exits/edit/{{ $exit->id }}" class="btn-edit"
                                            style="margin-bottom: 10px">Edit</a>
                                        <button type="button" class="btn-delete"
                                            onclick="openDeleteModal({{ $exit->id }}, '{{ $exit->reference_number }}','/item-exits/delete/{{ $exit->id }}')">Delete</button>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- Pagination --}}
        @include('layouts.pagination', ['paginator' => $itemExits])

        {{-- Delete Modal --}}
        @include('layouts.delete-modal')
    </div>
@endsection
