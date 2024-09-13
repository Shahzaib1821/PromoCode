@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="wrapper">
            <section class="section coupons">
                <div class="text-center">
                    <h3 class="title mb-4">Explore Exclusive Category Discounts with Smartsdeal Coupons!</h3>
                    <p class="mb-5">
                        Prepare to save big on all the things you love with our first-rate promo codes. We have everything
                        you need, from the newest styles in clothing to the most cutting-edge electronics to basic household
                        items. Thanks to our user-friendly site and legit discount codes. SmartsDeal is the place to go if
                        you want to save a lot of money while shopping online. Take a look at our wide variety of retailers
                        and labels right now!
                    </p>

                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-5">
                        @foreach ($categories as $category)
                            <div class="col">
                                <a href="{{ route('categories.show', $category->slug) }}"
                                    class="text-decoration-none text-center all-coupons-info">
                                    <img src="{{ asset('storage/' . $category->image) }}" class="img-fluid mb-2 rounded"
                                        alt="{{ $category->name }}">
                                    <h4 class="text-dark">{{ $category->name }}</h4>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <p class="mt-4">
                        We have some suggestions if you're seeking methods to cut expenditures across a variety of
                        categories, including groceries, apparel, electronics, and travel. Our team regularly refreshes our
                        website with new deals and discounts to guarantee that you have access to the most recent
                        information.
                    </p>
                    <p>
                        SmartsDeal is the place to go to get anything you want without going into debt. You may save money
                        with our coupons on everyday purchases as well as big-ticket items. And because of the site's
                        intuitive design, finding discounts and making purchases is a breeze.
                    </p>
                </div>
            </section>
        </div>
    </div>
@endsection
