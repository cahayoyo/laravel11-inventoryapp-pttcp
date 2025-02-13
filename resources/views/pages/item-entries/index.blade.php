@extends('layouts.main')

@section('title', 'TCP - Item Entries')

@section('content')
    {{-- Alert Component --}}
    @include('layouts.alert')

    <div class="overview">
        {{-- Page Header Component --}}
        @include('layouts.header', [
            'icon' => 'uil uil-arrow-circle-down',
            'title' => 'Item Entries',
            'addButtonText' => 'Add Item Entry',
            'addButtonLink' => '/item-entries/create',
        ])

        {{-- Search Box --}}
        @include('layouts.search-box', [
            'action' => '/item-entries',
            'placeholder' => 'Search item entry...',
        ])

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Reference Number</th>
                        <th>Item</th>
                        <th>Vendor</th>
                        <th>Total Price</th>
                        <th>Payment</th>
                        <th>Quantity</th>
                        <th>Entry Date</th>
                        <th>Description</th>
                        @if (auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin')
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itemEntries as $entry)
                        <tr>
                            <td>{{ ($itemEntries->currentPage() - 1) * $itemEntries->perPage() + $loop->index + 1 }}</td>
                            <td>{{ $entry->reference_number }}</td>
                            <td>{{ $entry->item->name }}</td>
                            <td>{{ $entry->vendor->name }}</td>
                            <td>Rp {{ number_format($entry->total_price, 0, ',', '.') }}</td>
                            <td>{{ $entry->payment }}</td>
                            <td>{{ $entry->quantity }}</td>
                            <td>{{ \Carbon\Carbon::parse($entry->entry_date)->format('d M Y') }}</td>
                            <td>{{ $entry->description ?? '-' }}</td>
                            <td>
                                @if (auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin')
                                    <div>
                                        <a href="/item-entries/edit/{{ $entry->id }}" class="btn-edit"
                                            style="margin-bottom: 10px">Edit</a>
                                        <button type="button" class="btn-delete"
                                            onclick="openDeleteModal({{ $entry->id }}, '{{ $entry->reference_number }}','/item-entries/delete/{{ $entry->id }}')">Delete</button>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- Pagination --}}
        @include('layouts.pagination', ['paginator' => $itemEntries])

        {{-- Delete Modal --}}
        @include('layouts.delete-modal')
    </div>
@endsection
