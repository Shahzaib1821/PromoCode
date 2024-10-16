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
                            {{-- <a href="{{ url('deals') }}" class="section-link">View all</a> --}}
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            @foreach ($deals as $deal)
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <a href="{{ route('stores-details', ['slug' => $deal->store->slug]) }}"
                                        class="text-black">
                                        <div class="card p-0 card-horizontal">
                                            {{-- <img src="{{ asset('uploads/stores/' . $deal->store->image) }}"
                                                alt="{{ $deal->store->name }}" class="card-img-top"> --}}
                                            <a href="{{ route('stores-details', ['slug' => $deal->store->slug]) }}"
                                                style="background-image: url('{{ asset('uploads/stores/' . $deal->store->image) }}'); background-repeat: no-repeat; background-size: cover; width: 100%; height: 150px; border-bottom: 1px solid #8080802e; background-color: #ddd9d94a; background-position: center center">

                                            </a>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $deal->store->name }}</h5>
                                                <p class="card-text">Get Discount of {{ $deal->discounted_price }}</p>
                                                <a href="{{ route('stores-details', ['slug' => $deal->store->slug]) }}"
                                                    class="coupon-link">Get Deal</a>
                                            </div>
                                        </div>
                                    </a>
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
                                        <img src="{{ asset('uploads/categories/' . $category->image) }}"
                                            class="img-fluid rounded" alt="{{ $category->name }}">
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
    @if ($saleBanner)
        <section class="section sale-banner px-0">
            <div class="sale-banner-img text-center">
                <a href="{{ $saleBanner->link }}">
                    <img src="{{ asset('uploads/banners/' . $saleBanner->desktop_image) }}" class="w-100 desktop"
                        alt="{{ $saleBanner->title }}">
                    <img src="{{ asset('uploads/banners/' . $saleBanner->mobile_image) }}" class="w-100 mobile"
                        alt="{{ $saleBanner->title }}">
                </a>
            </div>
        </section>
    @endif

    <div class="container">
        <div class="wrapper pt-0">

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
                                <div class="col-lg-2 col-md-4 col-sm-6">
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
            @if ($eventBanner)
                <section class="section categories">
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="{{ $eventBanner->link }}">
                                <img src="{{ asset('uploads/banners/' . $eventBanner->desktop_image) }}"
                                    class="w-100 desktop" alt="{{ $eventBanner->title }}">
                                <img src="{{ asset('uploads/banners/' . $eventBanner->mobile_image) }}"
                                    class="w-100 mobile" alt="{{ $eventBanner->title }}">
                            </a>
                        </div>
                    </div>
                </section>
            @endif

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
