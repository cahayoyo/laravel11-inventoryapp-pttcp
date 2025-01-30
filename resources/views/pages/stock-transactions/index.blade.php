@extends('layouts.main')

@section('title', 'TCP - Stock Transactions')

@section('content')
    <div class="overview">
        @include('layouts.header', [
            'icon' => 'uil uil-chart',
            'title' => 'Stock Transaction Reports',
            'addButtonText' => 'Print PDF',
            'addButtonLink' => '/stock-transactions/export?' . http_build_query(request()->all()),
        ])

        <div class="report-filters">
            <form action="{{ url('/stock-transactions') }}" method="GET" class="search-form">
                <div class="search-wrapper">
                    <select name="type" class="search-input">
                        <option value="">All Types</option>
                        <option value="in" {{ request('type') == 'in' ? 'selected' : '' }}>Stock In</option>
                        <option value="out" {{ request('type') == 'out' ? 'selected' : '' }}>Stock Out</option>
                    </select>
                    <button type="submit" class="btn-search">Filter</button>
                    <a href="{{ url('/stock-transactions') }}" class="btn-reset">Reset</a>
                </div>
            </form>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Date</th>
                        <th>Reference</th>
                        <th>Type</th>
                        <th>Item/Product</th>
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Vendor/Client</th>
                        <th>Project</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $index => $trans)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ date('d/m/Y', strtotime($trans['date'])) }}</td>
                            <td>{{ $trans['reference'] }}</td>
                            <td>
                                <span class="badge {{ $trans['type'] == 'in' ? 'badge-success' : 'badge-danger' }}">
                                    {{ ucfirst($trans['type']) }}
                                </span>
                            </td>
                            <td>{{ $trans['item']->name ?? '-' }}</td>
                            <td>{{ $trans['item']->unit->name ?? '-' }}</td>
                            <td>{{ $trans['quantity'] }}</td>
                            <td>
                                @if ($trans['type'] == 'in')
                                    {{ $trans['vendor']->name ?? '-' }}
                                @else
                                    {{ $trans['client']->name ?? '-' }}
                                @endif
                            </td>
                            <td>{{ $trans['project']->name ?? '-' }}</td>
                            <td>{{ $trans['description'] ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
