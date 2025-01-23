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
    </div>
@endsection
