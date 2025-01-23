<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('asset/css/styleDashboard.css') }}" />
    <!-- Iconscout CSS -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />
    {{-- sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <nav>
        {{-- Sidebar --}}
        @include('layouts.sidebar')
        {{-- End Sidebar --}}
    </nav>


    <section class="dashboard">
        {{-- Navbar --}}
        @include('layouts.navbar')
        {{-- End Navbar --}}


        <div class="dash-content">
            {{-- Content --}}
            @yield('content')
            {{-- End Content --}}
        </div>
    </section>

    <script src="{{ asset('asset/js/scriptDashboard.js') }}"></script>
</body>

</html>
