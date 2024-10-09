@extends('frontend.layouts.app')

@section('content')
    <section class="store-header">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-4">
                    <a target="_blank" href="{{ $store->website }}" class="bcss store-img"
                        style="background-image: url('{{ asset('uploads/stores/' . $store->image) }}');"> </a>
                </div>
                <div class="col-md-8 col-8">
                    <h2 class="mb-4 header-heading">{{ $store->name }}</h2>
                    @php
                        // Count verified coupons
                        $verifiedCount = $coupons
                            ->filter(function ($coupon) {
                                return $coupon->verify == 1;
                            })
                            ->count();
                    @endphp

                    <p class="lead">{{ $verifiedCount }} VERIFIED OFFERS ON {{ now()->format('F jS, Y') }}</p>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-4 mt-5">
        <div class="row customRowDirection gap-5 bg-white rounded-3">
            <div class="col-sm-12 col-md-12 col-lg-3 sidebar">
                <h2 class="mb-4">{{ $store->name }}</h2>

                <h6>About {{ $store->name }}</h6>
                <p style="font-size: 13px;line-height: unset; text-align: justify; hyphens: auto;">
                    {{ $store->tagline }}
                </p>

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

                <h4>Popular Stores</h4>
                <ul class="list-unstyled">
                    @foreach ($popularStores as $populatStore)
                        <li><a href="{{ route('stores-details', $populatStore->slug) }}">{{ $populatStore->name }}</a>
                        </li>
                    @endforeach
                </ul>

                <h4>Related Stores</h4>
                <ul class="list-unstyled">
                    @forelse ($relatedStores as $relatedStore)
                        <li><a
                                href="{{ route('stores-details', ['slug' => $relatedStore->slug]) }}">{{ $relatedStore->name }}</a>
                        </li>
                    @empty
                        <li>No related stores found.</li>
                    @endforelse
                </ul>

            </div>

            <main class="col-sm-12 col-md-12 col-lg-8">
                <!-- Tabs Section -->
                <ul class="nav nav-tabs border-0 shadow-none border-bottom p-0 justify-content-start bg-transparent"
                    id="storeTabs" role="tablist">

                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all"
                            type="button" role="tab" aria-controls="all" aria-selected="false">All</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="coupons-tab" data-bs-toggle="tab" data-bs-target="#coupons"
                            type="button" role="tab" aria-controls="coupons" aria-selected="true">Coupons</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="deals-tab" data-bs-toggle="tab" data-bs-target="#deals" type="button"
                            role="tab" aria-controls="deals" aria-selected="false">Deals</button>
                    </li>
                </ul>

                <!-- Tab Panes -->
                <div class="tab-content mt-4" id="storeTabsContent">

                    <!-- Store Details Section -->
                    <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                        <h3 class="mb-4">Available Offers</h3>
                        <div class="row">
                            @forelse ($coupons as $offer)
                                <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
                                    <div class="list-body showAll showCoupon">
                                        <span id="offer-{{ $offer->id }}-expiry" style="display: none;">
                                            {{ $offer->expiry_date->format('d-F-Y') }}
                                        </span>
                                        <div class="list-content row align-items-center mx-auto">
                                            <div class="col-lg-9 col-md-7">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-12 p-0">
                                                        <div class="list-left left-code term">
                                                            <a rel="nofollow" class="txtLink"
                                                                href="javascript:sanitizeURL({{ $offer->id }});">
                                                                <div class="one32">{{ e($offer->discounted_price) }}</div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-12">
                                                        <div class="list-center">
                                                            <div class="top-content">
                                                                @if ($offer->verify == 1)
                                                                    <div class="verified">
                                                                        <span class="Verify">Verify</span>
                                                                    </div>
                                                                @endif
                                                                @if ($offer->deal_exclusive == 1)
                                                                    <div class="verified">
                                                                        <span class="Verify">Exclusive</span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <a rel="nofollow" class="txtLink"
                                                                href="javascript:sanitizeURL({{ $offer->id }});">
                                                                <h3 class="center-title">{{ $offer->name }}</h3>
                                                            </a>
                                                            <div class="center-dsc">
                                                                <p class="list-dsc-content">
                                                                    {{ $offer->type === 'deal' ? 'Deal expires at:' : 'Coupon expires at:' }}
                                                                    {{ $offer->expiry_date->format('d-F-Y') }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-5">
                                                <div class="list-right py-3 justify-content-center">
                                                    @if (!empty($offer->coupon_code))
                                                        <button class="button has-code w-100"
                                                            onclick="openCodeModal('{{ $offer->id }}', '{{ $offer->coupon_code }}', '{{ $offer->affiliated_link }}')">
                                                            Get Code
                                                            <span class="peel-code"><em
                                                                    class="peel-text">{{ $offer->coupon_code }}</em></span>
                                                        </button>
                                                    @elseif (empty($offer->coupon_code))
                                                        <button class="button has-deal w-100"
                                                            onclick="openDealModal('{{ $offer->id }}', '{{ $offer->affiliated_link }}')">
                                                            Get Deal
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>No offers right now.</p>
                            @endforelse
                        </div>

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

                    <!-- Coupons Section -->
                    <div class="tab-pane fade" id="coupons" role="tabpanel" aria-labelledby="coupons-tab">
                        <h3 class="mb-4">Available Coupons</h3>
                        <div class="row">
                            @forelse ($coupons as $offer)
                                @if (!empty($offer->coupon_code))
                                    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
                                        <div class="list-body showAll showCoupon">
                                            <span id="offer-{{ $offer->id }}-expiry" style="display: none;">
                                                {{ $offer->expiry_date->format('d-F-Y') }}
                                            </span>
                                            <div class="list-content row align-items-center mx-auto">
                                                <div class="col-lg-9 col-md-7">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-12 p-0">
                                                            <div class="list-left left-code term">
                                                                <a rel="nofollow" class="txtLink"
                                                                    href="javascript:sanitizeURL({{ $offer->id }});">
                                                                    <div class="one32">{{ e($offer->discounted_price) }}
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-12">
                                                            <div class="list-center">
                                                                <div class="top-content">
                                                                    @if ($offer->verify == 1)
                                                                        <div class="verified">
                                                                            <span class="Verify">Verify</span>
                                                                        </div>
                                                                    @endif
                                                                    @if ($offer->deal_exclusive == 1)
                                                                        <div class="verified">
                                                                            <span class="Verify">Exclusive</span>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <a rel="nofollow" class="txtLink"
                                                                    href="javascript:sanitizeURL({{ $offer->id }});">
                                                                    <h3 class="center-title">{{ $offer->name }}</h3>
                                                                </a>
                                                                <div class="center-dsc">
                                                                    <p class="list-dsc-content">
                                                                        {{ $offer->type === 'deal' ? 'Deal expires at:' : 'Coupon expires at:' }}
                                                                        {{ $offer->expiry_date->format('d-F-Y') }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-5">
                                                    <div class="list-right py-3 justify-content-center">
                                                        @if (!empty($offer->coupon_code))
                                                            <button class="button has-code w-100"
                                                                onclick="openCodeModal('{{ $offer->id }}', '{{ $offer->coupon_code }}', '{{ $offer->affiliated_link }}')">
                                                                Get Code
                                                                <span class="peel-code"><em
                                                                        class="peel-text">{{ $offer->coupon_code }}</em></span>
                                                            </button>
                                                        @elseif (empty($offer->coupon_code))
                                                            <button class="button has-deal w-100"
                                                                onclick="openDealModal('{{ $offer->id }}', '{{ $offer->affiliated_link }}')">
                                                                Get Deal
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <p>No offers right now.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Deals Section -->
                    <div class="tab-pane fade" id="deals" role="tabpanel" aria-labelledby="deals-tab">
                        <h3 class="mb-4">Available Deals</h3>
                        <div class="row">
                            @forelse ($coupons as $offer)
                                @if (empty($offer->coupon_code))
                                    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
                                        <div class="list-body showAll showCoupon">
                                            <span id="offer-{{ $offer->id }}-expiry" style="display: none;">
                                                {{ $offer->expiry_date->format('d-F-Y') }}
                                            </span>
                                            <div class="list-content row align-items-center mx-auto">
                                                <div class="col-lg-9 col-md-7">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-12 p-0">
                                                            <div class="list-left left-code term">
                                                                <a rel="nofollow" class="txtLink"
                                                                    href="javascript:sanitizeURL({{ $offer->id }});">
                                                                    <div class="one32">{{ e($offer->discounted_price) }}
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-12">
                                                            <div class="list-center">
                                                                <div class="top-content">
                                                                    @if ($offer->verify == 1)
                                                                        <div class="verified">
                                                                            <span class="Verify">Verify</span>
                                                                        </div>
                                                                    @endif
                                                                    @if ($offer->deal_exclusive == 1)
                                                                        <div class="verified">
                                                                            <span class="Verify">Exclusive</span>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <a rel="nofollow" class="txtLink"
                                                                    href="javascript:sanitizeURL({{ $offer->id }});">
                                                                    <h3 class="center-title">{{ $offer->name }}</h3>
                                                                </a>
                                                                <div class="center-dsc">
                                                                    <p class="list-dsc-content">
                                                                        {{ $offer->type === 'deal' ? 'Deal expires at:' : 'Coupon expires at:' }}
                                                                        {{ $offer->expiry_date->format('d-F-Y') }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-5">
                                                    <div class="list-right py-3 justify-content-center">
                                                        @if (!empty($offer->coupon_code))
                                                            <button class="button has-code w-100"
                                                                onclick="openCodeModal('{{ $offer->id }}', '{{ $offer->coupon_code }}', '{{ $offer->affiliated_link }}')">
                                                                Get Code
                                                                <span class="peel-code"><em
                                                                        class="peel-text">{{ $offer->coupon_code }}</em></span>
                                                            </button>
                                                        @elseif (empty($offer->coupon_code))
                                                            <button class="button has-deal w-100"
                                                                onclick="openDealModal('{{ $offer->id }}', '{{ $offer->affiliated_link }}')">
                                                                Get Deal
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <p>No offers right now.</p>
                            @endforelse
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>

    <div class="modal fade" id="codeModal" tabindex="-1" role="dialog" aria-labelledby="codeModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="border:none">
                    <h4 class="modal-title" id="myModalLabel">Coupon Code</h4>
                    <button type="button" class="close fs-2" onclick="$('#codeModal').modal('hide');">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <a id="modalStoreLink" href="#">
                        <img id="modalStoreImage" alt="Signup For Exclusive Deals &amp; Discounts" src=""
                            style="border: 1px solid #000;border-radius: 64px;margin-bottom: 1rem;">
                    </a>
                    <p style="font-weight: 600;">Signup For Exclusive Deals &amp; Discounts</p>
                    <div
                        class="align-items-center border border-1 border-end-0 border-start-0 d-block d-flex gap-2 justify-content-center me-auto ms-auto p-2 position-relative">
                        <h5 class="mb-0">Click to copy</h5>
                        <button class="Btn" onclick="copyToClipboard()">
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
                                <div class="text" id="modalCouponCode"></div>
                            </div>
                        </button>
                    </div>
                    <p style="margin-top:1rem">Copy and paste this code at <a id="modalStoreName" href="#"
                            style="border-bottom:1px solid #000;"></a></p>
                </div>
                <div class="modal-footer text-center" style="background-color: #b0b0b026;">
                    <p class="p-2 rounded w-100" id="modalExpiryDate"></p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="dealModal" tabindex="-1" role="dialog" aria-labelledby="dealModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="border:none">
                    <h4 class="modal-title" id="myModalLabel">Deal Information</h4>
                    <button type="button" class="close fs-2" onclick="$('#dealModal').modal('hide');">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <a id="modalDealStoreLink" href="#">
                        <img id="modalDealStoreImage" alt="Exclusive Deal" src=""
                            style="border: 1px solid #000;border-radius: 64px;margin-bottom: 1rem;">
                    </a>
                    <p style="font-weight: 600;">Exclusive Deals & Discounts</p>
                    <div
                        class="align-items-center border border-1 border-end-0 border-start-0 d-block d-flex gap-2 justify-content-center me-auto ms-auto p-2 position-relative">
                        {{-- <h5 class="mb-0" id="modalDealText"></h5> --}}
                        <button class="w-50 rounded-5 getdeal"
                            onclick="window.open(document.getElementById('modalDealStoreLink').href, '_blank')">
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
                                <div class="deal-text">Get Deal</div>
                            </div>
                        </button>
                    </div>
                    <p style="margin-top:1rem">Click the button above to get this deal at <a id="modalDealStoreName"
                            href="#" style="border-bottom:1px solid #000;"></a></p>
                </div>
                <div class="modal-footer text-center" style="background-color: #b0b0b026;">
                    <p class="p-2 rounded w-100" id="modalDealExpiryDate"></p>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function copyToClipboard() {
            var couponCode = document.getElementById('modalCouponCode').textContent;
            navigator.clipboard.writeText(couponCode).then(function() {
                var button = document.querySelector('.Btn');
                button.innerHTML = '<div class="svgWrapper">' +
                    '<svg xml:space="preserve" viewBox="0 0 6.35 6.35" y="0" x="0" height="20" width="20" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg" class="clipboard">' +
                    '<g><path fill="currentColor" d="M2.43.265c-.3 0-.548.236-.573.53h-.328a.74.74 0 0 0-.735.734v3.822a.74.74 0 0 0 .735.734H4.82a.74.74 0 0 0 .735-.734V1.529a.74.74 0 0 0-.735-.735h-.328a.58.58 0 0 0-.573-.53zm0 .529h1.49c.032 0 .049.017.049.049v.431c0 .032-.017.049-.049.049H2.43c-.032 0-.05-.017-.05-.049V.843c0-.032.018-.05.05-.05zm-.901.53h.328c.026.292.274.528.573.528h1.49a.58.58 0 0 0 .573-.529h.328a.2.2 0 0 1 .206.206v3.822a.2.2 0 0 1-.206.205H1.53a.2.2 0 0 1-.206-.205V1.529a.2.2 0 0 1 .206-.206z"></path></g></svg>' +
                    '<div class="text">Copied!</div>' +
                    '</div>';

                // Reset the button text after 2 seconds
                setTimeout(function() {
                    button.innerHTML = '<div class="svgWrapper">' +
                        '<svg xml:space="preserve" viewBox="0 0 6.35 6.35" y="0" x="0" height="20" width="20" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg" class="clipboard">' +
                        '<g><path fill="currentColor" d="M2.43.265c-.3 0-.548.236-.573.53h-.328a.74.74 0 0 0-.735.734v3.822a.74.74 0 0 0 .735.734H4.82a.74.74 0 0 0 .735-.734V1.529a.74.74 0 0 0-.735-.735h-.328a.58.58 0 0 0-.573-.53zm0 .529h1.49c.032 0 .049.017.049.049v.431c0 .032-.017.049-.049.049H2.43c-.032 0-.05-.017-.05-.049V.843c0-.032.018-.05.05-.05zm-.901.53h.328c.026.292.274.528.573.528h1.49a.58.58 0 0 0 .573-.529h.328a.2.2 0 0 1 .206.206v3.822a.2.2 0 0 1-.206.205H1.53a.2.2 0 0 1-.206-.205V1.529a.2.2 0 0 1 .206-.206z"></path></g></svg>' +
                        '<div class="text" id="modalCouponCode">' + couponCode + '</div>' +
                        '</div>';
                }, 2000);
            }, function(err) {
                console.error('Could not copy text: ', err);
            });
        }

        function getUrlParameter(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        }

        // Function to open code modal
        function openCodeModal(couponId, couponCode, affiliatedLink) {
            var currentUrl = window.location.href.split('?')[0];
            var modalUrl = currentUrl + '?openModal=true&couponId=' + couponId;

            sessionStorage.setItem('tempCouponCode', couponCode);
            sessionStorage.setItem('tempCouponId', couponId);

            window.open(modalUrl, '_blank');
            window.location.href = affiliatedLink;
        }

        $(document).ready(function() {
            var openModal = getUrlParameter('openModal');
            if (openModal === 'true') {
                var couponId = getUrlParameter('couponId');
                if (!couponId) {
                    couponId = sessionStorage.getItem('tempCouponId');
                }
                var couponCode = sessionStorage.getItem('tempCouponCode');
                sessionStorage.removeItem('tempCouponCode');
                sessionStorage.removeItem('tempCouponId');

                var $storeElement = $('.store-header');
                var storeName = $storeElement.find('h2').text().trim();
                var storeWebsite = $storeElement.find('a.store-img').attr('href');
                var storeImage = $storeElement.find('a.store-img').css('background-image').replace(/url\(['"]?/, '')
                    .replace(/['"]?\)/, '');

                var expiryDate = $('#offer-' + couponId + '-expiry').text().trim();

                $('#modalCouponCode').text(couponCode);
                $('#modalExpiryDate').text('Deal will expire on: ' + expiryDate);
                $('#modalStoreImage').attr('src', storeImage);
                $('#modalStoreLink').attr('href', storeWebsite);
                $('#modalStoreName').text(storeName).attr('href', storeWebsite);

                $('#codeModal').modal('show');
            }
        });

        // Function to open deal modal
        function openDealModal(dealId, affiliatedLink) {
            var currentUrl = window.location.href.split('?')[0];
            var modalUrl = currentUrl + '?openDealModal=true&dealId=' + dealId;

            sessionStorage.setItem('tempDealId', dealId);

            window.open(modalUrl, '_blank');
            window.location.href = affiliatedLink;
        }

        // Check if we need to open the deal modal on page load
        $(document).ready(function() {
            var openDealModal = getUrlParameter('openDealModal');
            if (openDealModal === 'true') {
                var dealId = getUrlParameter('dealId');
                if (!dealId) {
                    dealId = sessionStorage.getItem('tempDealId');
                    sessionStorage.removeItem('tempDealId');
                }

                var $storeElement = $('.store-header');
                var storeName = $storeElement.find('h2').text().trim();
                var storeWebsite = $storeElement.find('a.store-img').attr('href');
                var storeImage = $storeElement.find('a.store-img').css('background-image').replace(/url\(['"]?/, '')
                    .replace(/['"]?\)/, '');

                var $dealElement = $('[id^="offer-' + dealId + '"]').closest('.list-body');
                var dealText = $dealElement.find('.center-title').text().trim();
                var expiryDate = $('#offer-' + dealId + '-expiry').text().trim();

                $('#modalDealText').text(dealText);
                $('#modalDealExpiryDate').text('Deal will expire on: ' + expiryDate);
                $('#modalDealStoreImage').attr('src', storeImage);
                $('#modalDealStoreLink').attr('href', storeWebsite);
                $('#modalDealStoreName').text(storeName).attr('href', storeWebsite);

                $('#dealModal').modal('show');
            }
        });
        $(document).ready(function() {
            $("#coupon-list").sortable({
                update: function(event, ui) {
                    var coupons = [];
                    $(".coupon-item").each(function(index) {
                        coupons.push({
                            id: $(this).data("id"),
                            sort_order: index + 1
                        });
                    });

                    $.ajax({
                        url: '/admin/coupons/reorder',
                        method: 'POST',
                        data: {
                            coupons: coupons,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log('Reordering successful');
                        },
                        error: function(xhr) {
                            console.error('Reordering failed');
                        }
                    });
                }
            });
        });
    </script>
@endsection
