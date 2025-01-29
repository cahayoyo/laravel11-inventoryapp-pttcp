<div class="top">
    <i class="uil uil-bars sidebar-toggle"></i>

    <div class="search-box">
        <i class="uil uil-search"></i>
        <input type="text" placeholder="Search here..." />
    </div>
    @if (auth()->user()->role === 'superadmin')
        <img src="{{ asset('asset/img/superadmin.png') }}" alt="" />
    @endif
    @if (auth()->user()->role === 'admin')
        <img src="{{ asset('asset/img/admin.png') }}" alt="" />
    @endif
    @if (auth()->user()->role === 'owner')
        <img src="{{ asset('asset/img/owner.png') }}" alt="" />
    @endif

</div>
