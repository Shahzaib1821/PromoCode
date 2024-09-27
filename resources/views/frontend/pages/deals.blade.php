@extends('frontend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="deals-banner">
                <h3 class="sub-title">Upto 60% Off</h3>
                <h3 class="title text-center">Coupons and Deals From Stores You Love</h3>
            </div>
        </div>
        <nav class="advanced-nav">
            <ul>
                <li><a href="#top-deals">Deals</a></li>
                @foreach ($categories as $category)
                    <li><a href="#{{ $category->name }}">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </nav>
    </div>

    <div class="container">
        <div class="wrapper">
            <!-- Stores section  -->
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
                                        <img src="{{ asset('storage/' . $category->image) }}" class="img-fluid rounded"
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

            <!-- Top deals section  -->
            <section class="section deals" id="top-deals">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center mb-3 justify-content-between">
                            <h4 class="section-title">Top Deals</h4>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            @foreach ($topDeals as $deal)
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="card p-0 card-horizontal">
                                        <img src="{{ asset('uploads/stores/' . $deal->store->image) }}"
                                            alt="{{ $deal->store->name }}" class="card-img-top">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $deal->store->name }}</h5>
                                            <p class="card-text">{{ $deal->description }}</p>
                                            <a href="{{ route('stores-details', ['slug' => $deal->store->slug]) }}"
                                                class="coupon-link">Get Deal</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <!-- Dynamic category sections -->
            @foreach ($categories as $index => $category)
                <section class="section deals" id="{{ $category->name }}">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center mb-3 justify-content-between">
                                <h4 class="section-title">{{ $category->name }}</h4>
                                <a href="{{ route('categories', ['active' => $category->slug]) }}"
                                    class="section-link">View all</a>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                @foreach ($dealsByCategory[$category->id] as $deal)
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card p-0 card-horizontal">
                                            <img src="{{ asset('uploads/stores/' . $deal->store->image) }}"
                                                alt="{{ $deal->store->name }}" class="card-img-top">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $deal->store->name }}</h5>
                                                <p class="card-text">{{ $deal->description }}</p>
                                                <a href="{{ route('stores-details', ['slug' => $deal->store->slug]) }}"
                                                    class="coupon-link">Get Deal</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            @endforeach
        </div>
    </div>
@endsection
