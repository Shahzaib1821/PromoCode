@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <section class="section">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                    <h2 class="fw-bold text-dark mt-4 mb-2">Privacy Policy</h2>
                    <div class="about-us mt-3">
                        <p style="line-height: 30px;">
                            Smartsdeal is a Coupon and Deal Website That Is Only Dedicated To Bringing You The Most Up-To-Date Online Coupons And Deals From Around The World. You Do Not Need To Submit Any Information To Us To Purchase On These Discounts; Simply Click On The Offer That Suits Your Budget And You Will Be Routed To The Respective Web Store Carrying That Deal. Smartsdeal Provides You With The Most Up-To-Date Coupons From Top Class Brands In The United States, Enabling You To Save More. Our approach is to keep our customers up to date on amusing discounts and offers that help them to save money. We also provide daily specials and offers that are easily accessible through our website. This method only directs you to their separate websites; smartsdeal is not responsible for any errors or misuse of information. Customers who have subscribed to our newsletters will only receive exclusive offers
                        </p>
                        <p class="fw-bold fs-4">1. PERSONAL DETAILS</p>
                        <p style="line-height: 30px;">
                            We collect personal information such as the user's email address, city and country, and deal preferences. We use the information to send daily deal newsletters to our users based on their interests. If a user does not wish to receive newsletters, he or she may do so at any time. Your personal information is never sold or rented to anybody.The only reason we collect your personal information is to send you the best deals in your inbox.
                            We just keep the contact information of the consumer or affiliates in order to communicate with them efficiently and promptly. The contact information stored in our systems enables us to contact the consumer in order to notify them of new discount deals and offers. We may contact you using your email, postal code, phone number, social media, or even your website. Furthermore, we are interested in learning your preferences so that we can provide you with the best service possible. We would like to know which of our tens of thousands of stores and deals you prefer and frequent. This enables us to provide you with far better and more options for those stores and specific brands, making the entire smartsdeal experience worthwhile for you.

                        </p>
                        <p class="fw-bold fs-4">2. HOW WILL WE GET YOUR INFORMATION?</p>
                        <p style="line-height: 30px;">
                            When you first sign up with us, we collect the most important personal information. When you sign up to reveal your discount deals and coupon codes with us, subscribe to our monthly newsletter, or create an account to advertise and create coupons with us, we collect information. Information is collected and stored with us regardless of how you use the smartsdeal website. We will never, ever utilize Your Personal Information to spam your email addresses or text message In Boxes. Also, when you leave a comment on our website, contact us for advertising and other official purposes, use our blog, guest blog us, or make forum comments about us, we collect your personal information via cookies and cache. Furthermore, if you use our Android apps or our social media apps, we may have set certain terms and conditions for those apps. As a result, by using those apps, you agree to our privacy policies and authorize the app to store information about you on our behalf.
                        </p>
                        <p class="fw-bold fs-4">3. APPLICATION OF 'COOKIES'</p>
                        <p style="line-height: 30px;">
                            Smartsdeal also employs "cookies" and web server logs to collect information about how our visitors interact with our site. Cookies Are A Web Browser Feature That Stores Information That Helps Personalize Your Web Experience. You can always opt out of cookie collection by disabling it in your browser's settings. Cookies and web logs may track the time of visit, the amount of time spent on our site, the pages viewed, and the sites visited immediately before and immediately after our site. This information does not include any personal information about you and is gathered in aggregate.
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
                                        <img src="https://smartsdeal.com/thumbnails/844665319.webp" width="150px" alt=""  style="width: 150px; height: auto;"class="mb-2 img-fluid rounded-2">
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
