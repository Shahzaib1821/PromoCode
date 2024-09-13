@extends('frontend.layouts.app') <!-- Assuming you have a main layout -->

@section('content')
    @include('frontend.components.slider')

    <div class="container">
        <div class="wrapper pb-0">

            <div class="col-lg-12">
                <div class="contentt">
                    <h3 class="title">Coupons and Deals From Stores You Love</h3>
                </div>
            </div>

            <!-- Deals Section -->
            <section class="section deals">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center mb-3 justify-content-between">
                            <h4 class="section-title">Top Deals</h4>
                            <a href="{{ url('deals') }}" class="section-link">View all</a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            @foreach (range(1, 8) as $index)
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="card p-0 card-horizontal">
                                        <img src="{{ asset('frontend/assets/img/deals/1.png') }}"
                                            alt="Store {{ $index }}" class="card-img-top">
                                        <div class="card-body">
                                            <h5 class="card-title">Moroccanoil</h5>
                                            <p class="card-text">20% Off Shampoo</p>
                                            <a href="#" class="coupon-link">coupon code</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <!-- Categories Section -->
            <section class="section categories">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center mb-3 justify-content-between">
                            <h4 class="section-title">Trending Categories</h4>
                            <a href="{{ url('categories') }}" class="section-link">View all</a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="categories-list">
                            @foreach ($categories as $category)
                                <a href="{{ route('categories', ['active' => $category->slug]) }}" class="category">
                                    <div class="category-image">
                                        <img src="{{ asset('storage/' . $category->image) }}" class="img-fluid mb-2 rounded"
                                            alt="{{ $category->name }}">
                                    </div>
                                    <div class="category-name">
                                        {{ $category->name }}
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>

    <!-- Sale Banner Section -->
    <section class="section sale-banner px-0">
        <div class="sale-banner-img text-center"
            style="background-image: url('https://img.freepik.com/free-vector/sale-limited-offer-dark-blue-abstract-papercut-background-banner_1340-17129.jpg?size=626&ext=jpg&ga=GA1.1.381309730.1720812878&semt=ais_hybrid');background-repeat: no-repeat; padding: 100px; background-size: cover;">
            <div class="sale-banner-content">
                <h4 class="sale-banner-title text-white title">Summer Sale</h4>
                <p class="sale-banner-description text-white">Up to 50% off on selected items</p>
                <a href="#" class="btn btn-danger">Shop Now</a>
            </div>
        </div>
    </section>
    
    <div class="container">
        <div class="wrapper pb-0">

            <!-- Top Stores Section -->
            <section class="section stores">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center mb-3 justify-content-between">
                            <h4 class="section-title">Top Stores</h4>
                            <a href="{{ url('stores') }}" class="section-link">View all</a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            @foreach ($stores as $store)
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <a href="{{ route('stores-details', ['slug' => $store->slug]) }}">
                                        <div class="store-card">
                                            <img src="{{ asset('uploads/stores/' . $store->image) }}"
                                                alt="Store {{ $store->name }}" class="store-image">
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <!-- Event Banner Section -->
            <section class="section categories">
                <div class="row">
                    <div class="col-lg-12">
                        <img src="{{ asset('frontend/assets/img/banners/Cta.png') }}" class="w-100" alt="">
                    </div>
                </div>
            </section>

            @include('frontend.components.blogs')

            <!-- FAQ Section -->
            <section class="section faq">
                <h2 class="title">Frequently Asked Questions</h2>
                <div class="accordion">
                    @foreach ([
            ['How does it work?', 'OpenPhone uses Internet to provide you with additional phone numbers on top of your existing devices. Download OpenPhone on your mobile or use it on the web to make and receive calls and messages.'],
            ['What devices do you support?', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.'],
            ['Does OpenPhone use my phone plan’s minutes?', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.'],
            ['How good is the call quality?', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.'],
            ['What countries can I call and text?', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.'],
        ] as $faq)
                        <div class="accordion-item">
                            <button id="accordion-button-{{ $loop->index + 1 }}" aria-expanded="false">
                                <span class="accordion-title">{{ $faq[0] }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-down">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M6 9l6 6l6 -6" />
                                </svg>
                            </button>
                            <div class="accordion-content">
                                <p>{{ $faq[1] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="shape-left">
                    <img src="{{ asset('frontend/assets/img/shape-left.svg') }}" alt="">
                </div>
            </section>
        </div>
    </div>
@endsection
