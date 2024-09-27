<div class="topheader text-center">
    <marquee behavior="left" direction="left" class="text-white">50-70% Off Everything + An Extra 25% Off Purchase
    </marquee>
</div>
<nav class="navbar nav navbar-expand-lg py-3">
    <div class="container">
        <a class="navbar-brand text-white" href="{{ route('home') }}"> <img
                src="{{ asset('uploads/' . $settings['header_logo']) ?? asset('default-header-logo.png') }}" style="max-width: {{ $settings['logo_max_width'] ?? 200 }}px;" alt="Header Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger">
                <input class="checkbox" type="checkbox" />
                <svg fill="none" viewBox="0 0 50 50" height="50" width="50">
                    <path class="lineTop line" stroke-linecap="round" stroke-width="4" stroke="black" d="M6 11L44 11">
                    </path>
                    <path stroke-linecap="round" stroke-width="4" stroke="black" d="M6 24H43" class="lineMid line">
                    </path>
                    <path stroke-linecap="round" stroke-width="4" stroke="black" d="M6 37H43" class="lineBottom line">
                    </path>
                </svg>
            </div>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav gap-2" id="main-navbar">
                <li class="nav-item">
                    <a class="nav-link text-white border-bottom-2" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white border-bottom-2" href="{{ route('deals') }}">Deals</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white border-bottom-2" href="{{ route('stores') }}">Store</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white border-bottom-2" href="{{ route('blogs') }}">Blogs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white border-bottom-2" href="{{ route('categories') }}">Categories</a>
                </li>
            </ul>
            <div class="search-box mobile">
                <button class="btn-search"><i class="fas fa-search"></i></button>
                <input type="text" class="input-search" id="live-search" placeholder="TYPE TO SEARCH">
                <div id="search-results" class="search-results-dropdown"></div>
            </div>
        </div>
        <div class="search-box">
            <button class="btn-search"><i class="fas fa-search"></i></button>
            <input type="text" class="input-search" id="live-search" placeholder="TYPE TO SEARCH">
            <div id="search-results" class="search-results-dropdown"></div>
        </div>
    </div>
</nav>
