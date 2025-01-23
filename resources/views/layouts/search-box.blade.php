<div class="search-container">
    <form action="{{ $action }}" method="GET" class="search-form">
        <div class="search-wrapper">
            <input type="text" name="search" placeholder="{{ $placeholder }}" class="search-input"
                value="{{ request('search') }}">
            <div class="search-buttons">
                <button type="submit" class="btn-search">Search</button>
                <a href="{{ $action }}" class="btn-reset">Reset</a>
            </div>
        </div>
    </form>
</div>
