@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <section class="section">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">

                    <!--------- Section::Here ------------->

                    <section>
                        <h2 class="fw-bold text-dark mt-4 mb-2">About Us</h2>
                        <img src="https://smartsdeal.com/front/images/About-Us.png" class="rounded-2" width="100%"
                            alt="about Us">

                        <div class="about-us mt-3">
                            <h3 class="fw-bold fs-3">CONCERNING SMARTSDEAL</h3>
                            <p style="line-height: 30px;">
                                We are a one-stop shop where you can find everything you need to make every shopping trip a
                                lot of fun for you. We can tell you everything you need to know about discounts, special
                                offers, deals, and amazing price cuts.<br>
                                You don't have to spend extra time and money figuring out what to buy and where to buy it
                                anymore.
                            </p>
                            <h4>WHAT IS SMARTSDEAL?</h4>
                            <p style="line-height: 35px;">
                                We're a place where you can spend less time, energy, and, most importantly, cash, hence our
                                name. We have everything you need to satisfy your shopping itch without breaking the bank.
                                You may rest easy knowing that we have exciting deals on every brand and store in the
                                world.<br>

                                Find out where you may get certain things at a bargain. We put in a lot of time and effort
                                as writers and researchers to make sure you get the best of both worlds.
                            </p>
                            <div class="mb-3">
                                <h3 class="fw-bold fs-3">WHY GO WITH US?</h3>
                                <p>Since you've probably seen hundreds of other bargain sites online, you may be wondering
                                    what makes us special. This is what sets us apart from the competition:</p>
                            </div>
                            <div class="mb-3">
                                <h3 class="fw-bold fs-3">AUTHENTICITY</h3>
                                <p>You can always use one of our vouchers. A reward is guaranteed at all times if the
                                    instructions on the website are followed. There are no additional or obscure
                                    requirements.</p>
                            </div>
                            <div class="mb-3">
                                <h3 class="fw-bold fs-3">PRIORITY</h3>
                                <p>We put the needs of our customers first. What good is it if our customers aren't happy
                                    with our service, even though we have a unique reward system? To help you out as much as
                                    possible, we constantly give our all.</p>
                            </div>
                        </div>
                    </section>

                    <!--------- Section::End ------------->

                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <aside>
                        <div class="card border-0 shadow">
                            <div class="card-body px-0">
                                <div class="d-flex flex-wrap gap-1 justify-content-center">
                                    <a href="#" class="border p-1">
                                        <img src="https://smartsdeal.com/thumbnails/668215987.webp" width="150px"
                                            alt="" style="width: 150px; height: auto;"
                                            class="mb-2 img-fluid rounded-2">
                                    </a>
                                    <a href="#" class="border p-1">
                                        <img src="https://smartsdeal.com/thumbnails/2059239456.webp" width="150px"
                                            alt="" style="width: 150px; height: auto;"
                                            class="mb-2 img-fluid rounded-2">
                                    </a>
                                    <a href="#" class="border p-1">
                                        <img src="https://smartsdeal.com/thumbnails/925246685.webp" width="150px"
                                            alt="" style="width: 150px; height: auto;"
                                            class="mb-2 img-fluid rounded-2">
                                    </a>
                                    <a href="#" class="border p-1">
                                        <img src="https://smartsdeal.com/thumbnails/844665319.webp" width="150px"
                                            alt="" style="width: 150px; height: auto;"
                                            class="mb-2 img-fluid rounded-2">
                                    </a>
                                    <a href="#" class="border p-1">
                                        <img src="https://smartsdeal.com/thumbnails/2047575499.webp" width="150px"
                                            alt="" style="width: 150px; height: auto;"
                                            class="mb-2 img-fluid rounded-2">
                                    </a>
                                    <a href="#" class="border p-1">
                                        <img src="https://smartsdeal.com/thumbnails/1495878707.webp" width="150px"
                                            alt="" style="width: 150px; height: auto;"
                                            class="mb-2 img-fluid rounded-2">
                                    </a>
                                    <a href="#" class="border p-1">
                                        <img src="https://smartsdeal.com/thumbnails/1455463952.webp" width="150px"
                                            alt="" style="width: 150px; height: auto;"
                                            class="mb-2 img-fluid rounded-2">
                                    </a>
                                    <a href="#" class="border p-1">
                                        <img src="https://smartsdeal.com/thumbnails/326486552.webp" width="150px"
                                            alt="" style="width: 150px; height: auto;"
                                            class="mb-2 img-fluid rounded-2">
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
