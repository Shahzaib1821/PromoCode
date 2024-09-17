@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <section class="section">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                <h2 class="fw-bold text-dark mt-4 mb-2">Saving Tips</h2>
                <img src="https://smartsdeal.com/front/images/Saving-tips.png" class="rounded-2" width="100%" alt="saving tips">
                <div class="about-us mt-3">
                    <h3>How to Get the Most Out of smartsdeal</h3>
                    <p style="line-height: 30px;">
                        smartsdeal, as your ultimate shopping partner, is much more than just a repository of coupons and the most recent discounts. We are a community that strives to provide the best shopping experience possible by lowering prices while not sacrificing quality.<br>
                        We make everyday purchases to once-in-a-while shopping sprees affordable, whether you are addicted to that particular retailer or do not want to compromise your fashion statement with some substandard cheap buys. All thanks to our active members who provide the most recent updates. Every day, we publish over 1000 coupons, and our discounts are 100% genuine.<br>
                        Furthermore, we provide unique insight into shopping habits. Here are some tips from our purchasing Guru on how to save the most money with smartsdeal.

                    </p>
                    <p class="fw-bold fs-4">OFFERS IN MANY FORMATS</p>
                    <p style="line-height: 30px;">
                        At smartsdeal, we cover almost every type of savings plan imaginable, from last-minute closeout bargains to incredible freebies, in addition to coupons and offers. While Offers might take many forms, they all have one thing in common: they can save you money and time.
                    </p>
                    <p class="fw-bold fs-4">EXCLUSIVE DEALS</p>
                    <p style="line-height: 30px;">
                        Some stores have joined forces with us to better serve you. In exchange for being listed on our page and receiving valuable views, they provide us discounts that we never keep for ourselves but instead pass on to you. You can obtain special exclusive discounts from your favorite stores, which are exclusively available on smartsdeal.
                    </p>
                    <p class="fw-bold fs-4">PROMO CODES AND COUPON CODES</p>
                    <p style="line-height: 30px;">
                        Smartsdeal now has over 10,000 online discount codes and promo codes from prominent retailers worldwide (and counting). These Offers are distinguished by a "Get Deal" button, which will offer you with a one-of-a-kind discount code to enter at checkout. If you are purchasing with us for the first time, we will also show you how to utilize the coupon.
                    </p>
                    <p class="fw-bold fs-4">DEALS ON SPECIAL PRODUCTS</p>
                    <p style="line-height: 30px;">
                        We go out of our way to uncover the best product deals for you and post them on our site in real time. Some of our product offerings are part of limited-time promotions, significant price cuts, or end-of-season discounts, while others are simply excellent deals. Our product discounts are labeled explicitly with direct website links, pricing, and a percentage off, so you know exactly what you are getting and how much you are saving.
                    </p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <aside>
                    <div class="card  border-0   shadow">
                        <div class="card-body px-0">
                            <div class="d-flex flex-wrap gap-1 justify-content-center">
                                <a href="#" class="border p-1">
                                    <img src="https://smartsdeal.com/thumbnails/668215987.webp" width="150px" alt="" style="width: 150px; height: auto;" class="mb-2 img-fluid rounded-2">
                                </a>
                                <a href="#" class="border p-1">
                                    <img src="https://smartsdeal.com/thumbnails/2059239456.webp" width="150px" alt="" style="width: 150px; height: auto;" class="mb-2 img-fluid rounded-2">
                                </a>
                                <a href="#" class="border p-1">
                                    <img src="https://smartsdeal.com/thumbnails/925246685.webp" width="150px" alt="" style="width: 150px; height: auto;" class="mb-2 img-fluid rounded-2">
                                </a>
                                <a href="#" class="border p-1">
                                    <img src="https://smartsdeal.com/thumbnails/844665319.webp" width="150px" alt="" style="width: 150px; height: auto;" class="mb-2 img-fluid rounded-2">
                                </a>
                                <a href="#" class="border p-1">
                                    <img src="https://smartsdeal.com/thumbnails/2047575499.webp" width="150px" alt="" style="width: 150px; height: auto;" class="mb-2 img-fluid rounded-2">
                                </a>
                                <a href="#" class="border p-1">
                                    <img src="https://smartsdeal.com/thumbnails/1495878707.webp" width="150px" alt="" style="width: 150px; height: auto;" class="mb-2 img-fluid rounded-2">
                                </a>
                                <a href="#" class="border p-1">
                                    <img src="https://smartsdeal.com/thumbnails/1455463952.webp" width="150px" alt="" style="width: 150px; height: auto;" class="mb-2 img-fluid rounded-2">
                                </a>
                                <a href="#" class="border p-1">
                                    <img src="https://smartsdeal.com/thumbnails/326486552.webp" width="150px" alt="" style="width: 150px; height: auto;" class="mb-2 img-fluid rounded-2">
                                </a>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
        <div class="stores text-center mt-4">
            <h3 class="mb-3 fw-bold">Popular Stores</h3>
            <ul class="p-0 list-unstyled stores_info">
                @foreach ($popularStores as $store)
                    <li class="border-1 p-2 bg-light shadow-sm rounded-2 mb-3">
                        <a href="{{ $store->website }}"
                            class="text-decoration-none text-dark fs-6">{{ $store->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
</div>
@endsection
