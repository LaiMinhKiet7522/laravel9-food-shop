@php
    $setting = \App\Models\SiteSetting::find(1);
@endphp
<footer class="main">
    <section class="newsletter mb-15 wow animate__animated animate__fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="position-relative newsletter-inner">
                        <div class="newsletter-content">
                            <h2 class="mb-20">
                                Stay home & get your daily <br />
                                needs from our shop
                            </h2>
                            <p class="mb-45">Start You'r Daily Shopping with <span class="text-brand">Nest
                                    Mart</span></p>
                            <form class="form-subcriber d-flex" method="post"
                                action="{{ route('subscriber.send.mail') }}" id="formSubscriberSubmit">
                                @csrf
                                <input type="email" name="email" placeholder="Your emaill address" />
                                <button class="btn" type="submit">Subscribe</button>
                            </form>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <img src="{{ asset('frontend/assets/imgs/banner/banner-9.png') }}" alt="newsletter" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="featured section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 mb-md-4 mb-xl-0">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp"
                        data-wow-delay="0">
                        <div class="banner-icon">
                            <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-1.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Best prices & offers</h3>
                            <p>Orders $50 or more</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp"
                        data-wow-delay=".1s">
                        <div class="banner-icon">
                            <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-2.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Free delivery</h3>
                            <p>24/7 amazing services</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp"
                        data-wow-delay=".2s">
                        <div class="banner-icon">
                            <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-3.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Great daily deal</h3>
                            <p>When you sign up</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp"
                        data-wow-delay=".3s">
                        <div class="banner-icon">
                            <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-4.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Wide assortment</h3>
                            <p>Mega Discounts</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp"
                        data-wow-delay=".4s">
                        <div class="banner-icon">
                            <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-5.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Easy returns</h3>
                            <p>Within 30 days</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-xl-none">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp"
                        data-wow-delay=".5s">
                        <div class="banner-icon">
                            <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-6.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Safe delivery</h3>
                            <p>Within 30 days</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-padding footer-mid">
        <div class="container pt-15 pb-20">
            <div class="row">
                <div class="col">
                    <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0 wow animate__animated animate__fadeInUp"
                        data-wow-delay="0">
                        <div class="logo mb-30">
                            <a href="{{ url('/') }}" class="mb-15"><img src="{{ asset($setting->logo) }}"
                                    alt="logo" /></a>
                            <p class="font-lg text-heading">Awesome grocery store website</p>
                        </div>
                        <ul class="contact-infor">
                            <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}"
                                    alt="" /><strong>Address: </strong>
                                <span>{{ $setting->company_address }}</span>
                            </li>
                            <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}"
                                    alt="" /><strong>Call Us:
                                </strong><span>{{ $setting->call_us_phone }}</span>
                            </li>
                            <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-email-2.svg') }}"
                                    alt="" /><strong>Email: </strong><span>{{ $setting->email }}</span></li>
                            <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-clock.svg') }}"
                                    alt="" /><strong>Hours: </strong><span>{{ $setting->hours }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                    <h4 class=" widget-title">Company</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                        <li><a href="{{ route('home.blog') }}">Blog & News</a></li>
                        <li><a href="{{ route('privacy_policy') }}">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                    <h4 class="widget-title">Account</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        <li><a href="#">Log In</a></li>
                        <li><a href="#">View Cart</a></li>
                        <li><a href="#">Wishlist</a></li>
                        <li><a href="#">Compare Products</a></li>
                    </ul>
                </div>
                <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                    <h4 class="widget-title">Corporate</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        <li><a href="#">Affiliate Program</a></li>
                        <li><a href="#">Farm Business</a></li>
                        <li><a href="#">Farm Careers</a></li>
                        <li><a href="#">Our Suppliers</a></li>
                    </ul>
                </div>
                <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                    @php
                        $categories = \App\Models\Category::orderBy('id', 'ASC')->limit(5)->get();
                    @endphp
                    <h4 class="widget-title">Popular</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        @foreach ($categories as $item)
                        <li><a href="{{ url('product/category/' . $item->id . '/' . $item->category_slug) }}">{{ Str::title($item->category_name) }}</a></li>
                        @endforeach
                    </ul>
                </div>

            </div>
    </section>
    <div class="container pb-30 wow animate__animated animate__fadeInUp" data-wow-delay="0">
        <div class="row align-items-center">
            <div class="col-12 mb-30">
                <div class="footer-bottom"></div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6">
                <p class="font-sm mb-0">&copy; {{ $setting->copyright }}</p>
            </div>
            <div class="col-xl-4 col-lg-6 text-center d-none d-xl-block">

                <div class="hotline d-lg-inline-flex">
                    <img src="{{ asset('frontend/assets/imgs/theme/icons/phone-call.svg') }}" alt="hotline" />
                    <p>{{ $setting->support_phone }}<span>24/7 Support Center</span></p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 text-end d-none d-md-block">
                <div class="mobile-social-icon">
                    <h6>Follow Us</h6>
                    <a href="{{ $setting->facebook }}"><img
                            src="{{ asset('frontend/assets/imgs/theme/icons/icon-facebook-white.svg') }}"
                            alt="" /></a>
                    <a href="{{ $setting->twitter }}"><img
                            src="{{ asset('frontend/assets/imgs/theme/icons/icon-twitter-white.svg') }}"
                            alt="" /></a>
                    <a href="{{ $setting->instagram }}"><img
                            src="{{ asset('frontend/assets/imgs/theme/icons/icon-instagram-white.svg') }}"
                            alt="" /></a>
                    <a href="{{ $setting->pinterest }}"><img
                            src="{{ asset('frontend/assets/imgs/theme/icons/icon-pinterest-white.svg') }}"
                            alt="" /></a>
                    <a href="{{ $setting->youtube }}"><img
                            src="{{ asset('frontend/assets/imgs/theme/icons/icon-youtube-white.svg') }}"
                            alt="" /></a>
                </div>
                <p class="font-sm">Up to 15% discount on your first subscribe</p>
            </div>
        </div>
    </div>
</footer>
