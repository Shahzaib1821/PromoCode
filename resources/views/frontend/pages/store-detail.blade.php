@extends('frontend.layouts.app')

@section('content')
    <section class="store-header">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-3">
                    <a target="_blank" href="{{ $store->website }}" class="bcss store-img"
                        style="background-image: url('{{ asset('uploads/stores/' . $store->image) }}');"> </a>
                </div>
                <div class="col-md-9 col-9">
                    <h2 class="mb-4">{{ $store->name }}</h2>
                    <p class="lead">{{ $store->tagline }}</p>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-4 mt-5">
        <div class="row customRowDirection gap-5 bg-white rounded-3">
            <div class="col-sm-12 col-md-12 col-lg-3 sidebar">
                <h2 class="mb-4">{{ $store->name }}</h2>

                <h4>Popular Stores</h4>
                <ul class="list-unstyled">
                    @foreach ($popularStores as $store)
                        <li><a href="{{ route('stores-details', $store->slug) }}">{{ $store->name }}</a></li>
                    @endforeach
                </ul>

                <h4>Categories</h4>
                <ul class="list-unstyled">
                    @foreach ($categories as $category)
                    <li><a href="{{ route('categories', ['active' => $category->slug]) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <main class="col-sm-12 col-md-12 col-lg-8">
                <!-- Tabs Section -->
                <ul class="nav nav-tabs border-0 shadow-none border-bottom pb-0 justify-content-start bg-transparent"
                    id="storeTabs" role="tablist">

                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="features-tab" data-bs-toggle="tab" data-bs-target="#features"
                            type="button" role="tab" aria-controls="features" aria-selected="false">Features</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="coupons-tab" data-bs-toggle="tab" data-bs-target="#coupons"
                            type="button" role="tab" aria-controls="coupons" aria-selected="true">Coupons</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="deals-tab" data-bs-toggle="tab" data-bs-target="#deals" type="button"
                            role="tab" aria-controls="deals" aria-selected="false">Deals</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="store-details-tab" data-bs-toggle="tab" data-bs-target="#store-details"
                            type="button" role="tab" aria-controls="store-details" aria-selected="false">Store
                            Details</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="faq-tab" data-bs-toggle="tab" data-bs-target="#faq" type="button"
                            role="tab" aria-controls="faq" aria-selected="false">FAQ</button>
                    </li>
                </ul>

                <!-- Tab Panes -->
                <div class="tab-content mt-4" id="storeTabsContent">

                    <!-- Features Section -->

                    <div class="tab-pane show active" id="features" role="tabpanel" aria-labelled="features-tab">
                        <table class="w-full table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="py-2">You can save upto</td>
                                    <td class="py-2">{{ $store->savings ?? '$50.00' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2">Total Offers</td>
                                    <td class="py-2">{{ $coupons->count() }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2">Coupon Codes</td>
                                    <td class="py-2">{{ $coupons->count() }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2">Free Shipping</td>
                                    <td class="py-2">{{ $store->free_shipping ?? 'Yes' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2">Best Discount</td>
                                    <td class="py-2">{{ $store->discount ?? '70% Off' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2">Last Updated</td>
                                    <td class="py-2">{{ now()->format('d M, Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Coupons Section -->
                    <div class="tab-pane fade" id="coupons" role="tabpanel" aria-labelledby="coupons-tab">
                        <h3 class="mb-4">Available Coupons</h3>
                        @forelse ($coupons as $coupon)
                            <div class="list-body showAll showCoupon">
                                <div class="list-content">
                                    <div class="list-left left-code term">
                                        <a rel="nofollow" class="txtLink"
                                            href="javascript:sanitizeURL({{ $coupon->id }});">
                                            <div class="one32">{{ e($coupon->discounted_price) }}</div>
                                            <div class="one32">Off</div>
                                        </a>
                                    </div>
                                    <div class="list-center">
                                        <div class="top-content">
                                            @if ($coupon->verify == 1)
                                                <div class="verified">
                                                    <span class="Verify">
                                                        Verify </span>
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                        <a rel="nofollow" class="txtLink"
                                            href="javascript:sanitizeURL({{ $coupon->id }});">
                                            <h3 class="center-title">{{ $coupon->name }}</h3>

                                        </a>
                                        <div class="center-dsc">
                                            <p class="list-dsc-content">{{ $coupon->description }}</p>
                                        </div>
                                        <div class="ms-3">
                                            <span style="font-size: 11px"> Coupon expires at
                                                :{{ $coupon->expiry_date->format('Y-m-d') }}</span>
                                        </div>
                                    </div>
                                    <div class="list-right">

                                        <button class="button has-code"
                                            onclick="openCodeModal('{{ $coupon->id }}', '{{ $coupon->coupon_code }}', '{{ $coupon->affiliated_link }}')">
                                            {{-- onclick="openCodeModal('{{ $coupon->id }}', '{{ $coupon->coupon_code }}')"> --}}
                                            Get Code
                                            <span class="peel-code"><em class="peel-text">abc12b</em></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No coupons right now</p>
                        @endforelse
                    </div>


                    <!-- Deals Section -->
                    <div class="tab-pane fade" id="deals" role="tabpanel" aria-labelledby="deals-tab">
                        <h3 class="mb-4">Available Deals</h3>
                        {{-- @foreach ($deals as $deal)
                            <div class="list-body showAll showCoupon">
                                <div class="list-content">
                                    <div class="list-left left-code term">
                                        <a rel="nofollow" class="txtLink" href="javascript:sanitizeURL({{ $deal->id }});">
                                            <div class="one32">{{ $deal->discount }}</div>
                                            <div class="one32">Off</div>
                                        </a>
                                    </div>
                                    <div class="list-center">
                                        <a rel="nofollow" class="txtLink" href="javascript:sanitizeURL({{ $deal->id }});">
                                            <h3 class="center-title">{{ $deal->title }}</h3>
                                        </a>
                                        <div class="center-dsc">
                                            <p class="list-dsc-content">{{ $deal->description }}</p>
                                        </div>
                                    </div>
                                    <div class="list-right">
                                        <button class="button has-code">Get Deal</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach --}}
                        <p>no deal avaible right now</p>
                    </div>

                    <!-- Store Details Section -->
                    <div class="tab-pane fade" id="store-details" role="tabpanel" aria-labelledby="store-details-tab">
                        <h3 class="mb-4">Store Details</h3>

                        <!-- Store Video -->
                        @if ($store->video)
                            <div class="video-container mb-4">
                                {!! $store->video !!}
                            </div>
                        @endif

                        <div class="storeList cb">
                            <h3>{{ $store->name }} COUPON AND PROMO CODES:</h3>
                            <p>{!! $store->description !!}</p>
                        </div>

                    </div>

                    <!-- FAQ Section -->
                    <div class="tab-pane fade" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                        <h3 class="mb-4">Frequently Asked Questions</h3>
                        <div class="accordion">
                            @if (count($faqs) > 0)
                                @foreach ($faqs as $faq)
                                    <div class="accordion-item">
                                        <button id="accordion-button" aria-expanded="false">
                                            <span class="accordion-title">{{ $faq['question'] }}</span>
                                        </button>
                                        <div class="accordion-content">
                                            <p>{{ $faq['answer'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-sm text-gray-500">No FAQs available at the moment.</p>
                            @endif
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>
    {{-- <div class="modal fade" id="codeModal" tabindex="-1" role="dialog" aria-labelledby="codeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="codeModalLabel">Coupon Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Your coupon code is: <strong id="couponCode"></strong></p>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="modal fade " id="codeModal" tabindex="-1" role="dialog" aria-labelledby="dealModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="border:none">
                    <h4 class="modal-title" id="myModalLabel">Coupon Code</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <a href="{{ $store->website }}"> <img alt="Signup For Exclusive Deals &amp; Discounts"
                            src="{{ asset('uploads/stores/' . $store->image) }}"
                            style="border: 1px solid #000;border-radius: 64px;margin-bottom: 1rem;"></a>
                    <p style="font-weight: 600;">Signup For Exclusive Deals &amp; Discounts</p>
                    <div
                        class="align-items-center border border-1 border-end-0 border-start-0 d-block d-flex gap-2 justify-content-center me-auto ms-auto p-2 position-relative">
                        <h5 class="mb-0">Click to copy</h5>
                        <button class="Btn">
                            <div class="svgWrapper">
                                <svg xml:space="preserve" viewBox="0 0 6.35 6.35" y="0" x="0" height="20"
                                    width="20" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" class="clipboard">
                                    <g>
                                        <path fill="currentColor"
                                            d="M2.43.265c-.3 0-.548.236-.573.53h-.328a.74.74 0 0 0-.735.734v3.822a.74.74 0 0 0 .735.734H4.82a.74.74 0 0 0 .735-.734V1.529a.74.74 0 0 0-.735-.735h-.328a.58.58 0 0 0-.573-.53zm0 .529h1.49c.032 0 .049.017.049.049v.431c0 .032-.017.049-.049.049H2.43c-.032 0-.05-.017-.05-.049V.843c0-.032.018-.05.05-.05zm-.901.53h.328c.026.292.274.528.573.528h1.49a.58.58 0 0 0 .573-.529h.328a.2.2 0 0 1 .206.206v3.822a.2.2 0 0 1-.206.205H1.53a.2.2 0 0 1-.206-.205V1.529a.2.2 0 0 1 .206-.206z">
                                        </path>
                                    </g>
                                </svg>
                                {{-- <div class="text">{{ $coupon->coupon_code }}</div> --}}
                            </div>
                        </button>

                    </div>
                    <p style="margin-top:1rem">Copy and paste this code at <a href="{{ $store->website }}"
                            style="border-bottom:1px solid #000;">{{ $store->name }}</a></p>
                </div>
                <div class="modal-footer text-center" style="background-color: #b0b0b026;">
                    {{-- <p class="p-2 rounded w-100 ">Deal will be expire on : {{ $coupon->expiry_date->format('Y-m-d') }}</p> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function openCodeModal(couponId, couponCode, affiliatedLink) {
            // Open current page in a new tab
            var newTab = window.open(window.location.href, '_blank');

            // In the new tab, show the modal
            newTab.onload = function() {
                newTab.$(document).ready(function() {
                    newTab.$('#codeModal').modal('show');
                    newTab.$('#couponCode').text(couponCode);
                });
            };

            window.location.href = affiliatedLink;
        }

        // Ensure the modal is hidden when the page loads
        $(document).ready(function() {
            $('#codeModal').modal('hide');
        });
    </script>
@endsection
