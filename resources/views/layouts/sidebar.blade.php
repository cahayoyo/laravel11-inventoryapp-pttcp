<div class="logo-name">
    <div class="logo-image">
        <img src="{{ asset('asset/img/LogoTCPMerah.png') }}" alt="" />
    </div>

    <span class="logo_name">PT Tri Cipta Patriot</span>
</div>
<div class="menu-items">
    <ul class="nav-links">
        <li>
            <a href="/">
                <i class="uil uil-home"></i>
                <span class="link-name">Dashboard</span>
            </a>
        </li>
        @if (auth()->user()->role === 'superadmin')
            <li>
                <a href="/categories">
                    <i class="uil uil-grids"></i>
                    <span class="link-name">Categories</span>
                </a>
            </li>
            <li>
                <a href="/units">
                    <i class="uil uil-pathfinder-unite"></i>
                    <span class="link-name">Units</span>
                </a>
            </li>
        @endif
        <li>
            <a href="/items">
                <i class="uil uil-table"></i>
                <span class="link-name">Items</span>
            </a>
        </li>
        @if (auth()->user()->role === 'superadmin')
            <li>
                <a href="/products">
                    <i class="uil uil-layers"></i>
                    <span class="link-name">Products</span>
                </a>
            </li>
            <li>
                <a href="/vendors">
                    <i class="uil uil-store"></i>
                    <span class="link-name">Vendors</span>
                </a>
            </li>
            <li>
                <a href="/clients">
                    <i class="uil uil-users-alt"></i>
                    <span class="link-name">Clients</span>
                </a>
            </li>
            <li>
                <a href="/ipabajas">
                    <i class="uil uil-tear"></i>
                    <span class="link-name">IPA Baja</span>
                </a>
            </li>
        @endif
        <li>
            <a href="/projects">
                <i class="uil uil-bag"></i>
                <span class="link-name">Projects</span>
            </a>
        </li>
        <li>
            <a href="/item-entries">
                <i class="uil uil-arrow-circle-down"></i>
                <span class="link-name">Item Entry</span>
            </a>
        </li>
        <li>
            <a href="/item-exits">
                <i class="uil uil-arrow-circle-up"></i>
                <span class="link-name">Item Exit</span>
            </a>
        </li>
        <li>
            <a href="/stock-reports">
                <i class="uil uil-chart"></i>
                <span class="link-name">Stock Reports</span>
            </a>
        </li>
        <li>
            <a href="/stock-transactions">
                <i class="uil uil-chart"></i>
                <span class="link-name">Trans Reports</span>
            </a>
        </li>
    </ul>

    <ul class="logout-mode">
        <li>
            <a href="/logout" data-method="POST"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="uil uil-sign-out-alt"></i>
                <span class="link-name">Logout</span>
            </a>
            <form id="logout-form" action="/logout" method="POST" style="display: none;">
                @csrf
                @method('POST')
            </form>
        </li>
        <li class="mode">
            <a href="#">
                <i class="uil uil-moon"></i>
                <span class="link-name">Dark Mode</span>
            </a>

            <div class="mode-toggle">
                <span class="switch"></span>
            </div>
        </li>
    </ul>
</div>
