@extends('layouts.main')

@section('content')
    {{-- Alert Component --}}
    @include('layouts.alert')

    <div class="overview">
        {{-- Page Header Component --}}
        @include('layouts.header', [
            'icon' => 'uil uil-tear',
            'title' => 'IPA Baja',
            'addButtonText' => 'Add IPA Baja',
            'addButtonLink' => '/ipabajas/create',
        ])

        {{-- Search Box --}}
        @include('layouts.search-box', [
            'action' => '/ipabajas',
            'placeholder' => 'Search IPA Baja...',
        ])

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ipaBajas as $ipaBaja)
                        <tr>
                            <td>{{ ($ipaBajas->currentPage() - 1) * $ipaBajas->perPage() + $loop->index + 1 }}</td>
                            <td>{{ $ipaBaja->name }}</td>
                            <td>
                                @if ($ipaBaja->image)
                                    <img src="{{ asset('storage/images/' . $ipaBaja->image) }}" alt="{{ $ipaBaja->name }}"
                                        style="max-height: 100px; width: auto;">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>
                                <div>
                                    <a href="/ipabajas/edit/{{ $ipaBaja->id }}" class="btn-edit">Edit</a>
                                    <button type="button" class="btn-delete"
                                        onclick="openDeleteModal({{ $ipaBaja->id }}, '{{ $ipaBaja->name }}','/ipabajas/delete/{{ $ipaBaja->id }}')">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- Pagination --}}
        @include('layouts.pagination', ['paginator' => $ipaBajas])
        {{-- Delete Modal --}}
        @include('layouts.delete-modal')

    </div>
@endsection
