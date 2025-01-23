@extends('layouts.main')

@section('content')
    {{-- sweetalert popup success --}}
    @if (session('success'))
        <script>
            Swal.fire({
                title: "Success",
                text: "{{ session('success') }}",
                icon: "success"
            });
        </script>
    @endif
    {{-- sweetalert popup error --}}
    @if (session('error'))
        <script>
            Swal.fire({
                title: "Error",
                text: "{{ session('error') }}",
                icon: "error"
            });
        </script>
    @endif

    <div class="overview">
        <div class="title">
            <i class="uil uil-tachometer-fast-alt"></i>
            <span class="text">Dashboard</span>
        </div>
        <div class="boxes">
            <div class="box box1">
                <i class="uil uil-grids"></i>
                <span class="text">Total Category</span>
                <span class="number">{{ $categoryCount }}</span>
            </div>
            <div class="box box2">
                <i class="uil uil-pathfinder-unite"></i>
                <span class="text">Total Unit</span>
                <span class="number">{{ $unitCount }}</span>
            </div>
            <div class="box box3">
                <i class="uil uil-table"></i>
                <span class="text">Total Item</span>
                <span class="number">{{ $itemCount }}</span>
            </div>
            <div class="box box1">
                <i class="uil uil-store"></i>
                <span class="text">Total Vendor</span>
                <span class="number">{{ $vendorCount }}</span>
            </div>
            <div class="box box2">
                <i class="uil uil-users-alt"></i>
                <span class="text">Total Client</span>
                <span class="number">{{ $clientCount }}</span>
            </div>
            <div class="box box3">
                <i class="uil uil-tear"></i>
                <span class="text">Total IPA Baja</span>
                <span class="number">{{ $ipaBajaCount }}</span>
            </div>
            <div class="box box1">
                <i class="uil uil-bag"></i>
                <span class="text">Total Project</span>
                <span class="number">{{ $projectCount }}</span>
            </div>
            <div class="box box2">
                <i class="uil uil-arrow-circle-down"></i>
                <span class="text">Total Item Entry</span>
                <span class="number">{{ $itemEntryCount }}</span>
            </div>
            <div class="box box3">
                <i class="uil uil-arrow-circle-up"></i>
                <span class="text">Total Item Exit</span>
                <span class="number">{{ $itemExitCount }}</span>
            </div>
        </div>
        <div class="title">
            <i class="uil uil-arrow-circle-down"></i>
            <span class="text">Latest Incoming Items</span>
        </div>
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="title">
            <i class="uil uil-arrow-circle-down"></i>
            <span class="text">Latest Outgoing Items</span>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Reference Number</th>
                        <th>Item</th>
                        <th>Client</th>
                        <th>Project</th>
                        <th>Quantity</th>
                        <th>Exit Date</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itemExits as $exit)
                        <tr>
                            <td>{{ ($itemExits->currentPage() - 1) * $itemExits->perPage() + $loop->index + 1 }}</td>
                            <td>{{ $exit->reference_number }}</td>
                            <td>{{ $exit->item->name }}</td>
                            <td>{{ $exit->client->name }}</td>
                            <td>{{ $exit->project->name }}</td>
                            <td>{{ $exit->quantity }}</td>
                            <td>{{ \Carbon\Carbon::parse($exit->exit_date)->format('d M Y') }}</td>
                            <td>{{ $exit->description ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
