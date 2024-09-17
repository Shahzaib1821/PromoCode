<div class="topheader text-center">
    <marquee behavior="left" direction="left" class="text-white">50-70% Off Everything + An Extra 25% Off Purchase</marquee>
</div>
<nav class="navbar nav navbar-expand-lg py-3">
    <div class="container">
        <i class="uil uil-bars navOpenBtn"></i>
        <a class="navbar-brand text-white" href="{{ route('home') }}">Promo Code</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav gap-2">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('stores') }}">Store</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{route('blogs')}}">Blogs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('categories')}}">Categories</a>
                </li>
            </ul>
        </div>
        <div class="search-box">
            <button class="btn-search"><i class="fas fa-search"></i></button>
            <input type="text" class="input-search" id="live-search" placeholder="TYPE TO SEARCH">
            <div id="search-results" class="search-results-dropdown"></div>
        </div>
    </div>
</nav>
