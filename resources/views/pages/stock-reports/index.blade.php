@extends('layouts.main')

@section('content')
    <div class="overview">
        @include('layouts.header', [
            'icon' => 'uil uil-chart',
            'title' => 'Stock Reports',
            'addButtonText' => 'Print PDF',
            'addButtonLink' =>
                '/stock-reports/export?category=' .
                (request('category') == 0 ? '' : request('category')) .
                (request('kritical') ? '&kritical=1' : ''),
        ])

        <div class="report-filters mb-3">
            <form action="{{ url('/stock-reports') }}" method="GET" class="search-form">
                <div class="search-wrapper">
                    <select name="category" class="search-input">
                        <option value="0">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="search-buttons">
                        <div class="checkbox-wrapper">
                            <input type="checkbox" id="kritical" name="kritical" value="1"
                                {{ request('kritical') ? 'checked' : '' }}>
                            <label for="kritical">Critical Stock</label>
                        </div>
                        <button type="submit" class="btn-search">Filter</button>
                        <a href="{{ url('/stock-reports') }}" class="btn-reset">Reset</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Item Name</th>
                        <th>Category</th>
                        <th>Unit</th>
                        <th>Stock</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $index => $item)
                        <tr style="{{ $item->stock <= 10 ? 'background-color: #ff9999;' : '' }}">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->category->name }}</td>
                            <td>{{ $item->unit->name }}</td>
                            <td>{{ $item->stock }}</td>
                            <td>
                                @if ($item->stock <= 10)
                                    <span class="badge bg-danger">Low Stock</span>
                                @else
                                    <span class="badge bg-success">Safe Stock</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .table-danger {
            background-color: #ff9999 !important;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 12px;
        }

        .badge-danger {
            background-color: #dc3545;
            color: white;
        }

        .badge-success {
            background-color: #28a745;
            color: white;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            margin-right: 10px;
        }

        .checkbox-wrapper input {
            margin-right: 5px;
        }
    </style>
@endsection
