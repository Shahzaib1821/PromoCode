<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 footer-col">
                <h4 class="text-left"><img
                        src="{{ asset('uploads/' . $settings['footer_logo']) ?? asset('default-footer-logo.png') }}"
                        style="max-width: {{ $settings['logo_max_width'] ?? 200 }}px;" alt="Footer Logo"></h4>
                <p class="text-white">Promo Code tracks coupon codes from online
                    merchants to help consumers save money. We may earn
                    a commission when you use one of our coupons/links to
                    make a purchase. You should check any coupon or
                    promo code of interest on the merchant website to
                    ensure validity before making a purchase.</p>
                <div class="social-links">
                    @if (isset($settings['facebook_link']))
                        <a href="{{ $settings['facebook_link'] }}" target="_blank"><i
                                class="fa-brands fa-facebook-f"></i></a>
                    @endif
                    @if (isset($settings['twitter_link']))
                        <a href="{{ $settings['twitter_link'] }}" target="_blank"><i
                                class="fa-brands fa-x-twitter"></i></a>
                    @endif
                    @if (isset($settings['instagram_link']))
                        <a href="{{ $settings['instagram_link'] }}" target="_blank"><i
                                class="fa-brands fa-instagram"></i></a>
                    @endif
                    @if (isset($settings['linkedin_link']))
                        <a href="{{ $settings['linkedin_link'] }}" target="_blank"><i
                                class="fa-brands fa-linkedin-in"></i></a>
                    @endif
                </div>
            </div>
            <div class="col-lg-2 footer-col">
                <h4>Company</h4>
                <ul class="p-0">
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('saving-tips') }}">Saving Tips</a></li>
                    <li><a href="{{ route('write-for-us') }}">Write For Us</a></li>
                    <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                    <li><a href="{{ route('terms-conditions') }}">Terms & Conditions</a></li>
                </ul>
            </div>
            <div class="col-lg-2 footer-col">
                <h4>Get Help</h4>
                <ul class="p-0">
                    {{-- <li><a href="{{ route('faq') }}">FAQ</a></li>
                    <li><a href="{{ route('shipping') }}">Shipping</a></li>
                    <li><a href="{{ route('returns') }}">Returns</a></li>
                    <li><a href="{{ route('order-status') }}">Order Status</a></li>
                    <li><a href="{{ route('payment-options') }}">Payment Options</a></li> --}}
                </ul>
            </div>
            <div class="col-lg-2 footer-col">
                <h4>Online Shop</h4>
                <ul class="p-0">
                    {{-- <li><a href="{{ route('download') }}">Download</a></li>
                    <li><a href="{{ route('changelog') }}">Changelog</a></li>
                    <li><a href="{{ route('github') }}">GitHub</a></li>
                    <li><a href="{{ route('all-versions') }}">All Versions</a></li> --}}
                </ul>
            </div>
        </div>
    </div>
</footer>

<div class="foot_bot">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                <p class="mt-3 text-white">Copyright 2024 © Promo Code. All rights reserved.</p>
            </div>
        </div>
    </div>
</div>
