@php
    $company = DB::table('company_infos')->first();
@endphp

<style>
    .scrollToTop {
        right: 2%;
    }


    .whatsapp-float {
        position: fixed;
        bottom: 14%;
        right: 1.6%;
        width: 56px;
        height: 56px;
        background-color: #25D366;
        color: #fff;
        border-radius: 50%;
        text-align: center;
        font-size: 28px;
        line-height: 56px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, .25);
        z-index: 9999;
        transition: all .3s ease;
    }

    .whatsapp-float:hover {
        background-color: #1ebe5d;
        color: #fff;
        transform: scale(1.08);
    }
</style>

<style>
    
</style>




<!-- ================> Footer section start here <================== -->
<footer class="footer footer--style2">
    <div class="footer__top bg_img" style="background-image: url(assets/images/footer/bg2.png)">

        <!-- Newsletter -->
        <div class="footer__newsletter wow fadeInUp" data-wow-duration="1.5s">
            <div class="container">
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-6 col-12">
                        <div class="footer__newsletter--area">
                            <div class="footer__newsletter--title mb-2">
                                <h4>Subscribe to Our Newsletter</h4>
                            </div>
                            <div class="footer__newsletter--form">
                                <form action="{{ route('subscribe.store') }}" method="POST" class="d-flex gap-2">
                                    @csrf

                                    <input type="email" name="email" placeholder="Enter your email address"
                                        value="{{ old('email') }}" required>

                                    <button type="submit" class="default-btn">
                                        <span>Subscribe</span>
                                    </button>
                                </form>

                                {{-- Success Message --}}
                                @if (session('success'))
                                    <p class="text-success mt-2">{{ session('success') }}</p>
                                @endif

                                {{-- Error --}}
                                @error('email')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror

                            </div>
                        </div>
                    </div>

                    <!-- Social -->
                    <div class="col-lg-6 col-12">
                        <div class="footer__newsletter--area justify-content-xxl-end">
                            <div class="footer__newsletter--title me-xl-4">
                                <h4>Join Our Community</h4>
                            </div>
                            <div class="footer__newsletter--social">
                                <ul>
                                    @if (!empty($company->facebook))
                                        <li class="wow fadeInLeft">
                                            <a href="{{ $company->facebook }}" target="_blank">
                                                <i class="fa-brands fa-facebook-f"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @if (!empty($company->instagram))
                                        <li class="wow fadeInLeft">
                                            <a href="{{ $company->instagram }}" target="_blank">
                                                <i class="fa-brands fa-instagram"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @if (!empty($company->twitter))
                                        <li class="wow fadeInLeft">
                                            <a href="{{ $company->twitter }}" target="_blank">
                                                <i class="fa-brands fa-twitter"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @if (!empty($company->youtube))
                                        <li class="wow fadeInLeft">
                                            <a href="{{ $company->youtube }}" target="_blank">
                                                <i class="fa-brands fa-youtube"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @if (!empty($company->linkedin))
                                        <li class="wow fadeInLeft">
                                            <a href="{{ $company->linkedin }}" target="_blank">
                                                <i class="fa-brands fa-linkedin-in"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @if (!empty($company->pinterest))
                                        <li class="wow fadeInLeft">
                                            <a href="{{ $company->pinterest }}" target="_blank">
                                                <i class="fa-brands fa-pinterest-p"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @if (!empty($company->phone1))
                                        <li class="wow fadeInLeft">
                                            <a href="https://wa.me/{{ $company->phone1 }}" target="_blank">
                                                <i class="fa-brands fa-whatsapp"></i>
                                            </a>
                                        </li>
                                    @endif

                                </ul>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Footer Content -->
        <div class="footer__toparea padding-top padding-bottom wow fadeInUp" data-wow-duration="1.5s">
            <div class="container">
                <div class="row g-4">

                    <!-- About -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="footer__item footer--about">
                            <div class="footer__inner">
                                <div class="footer__content">
                                    <div class="footer__content--title">
                                        <h4> Prajapati Ghatasutra</h4>
                                        <img src="{{ asset($company->logo ?? 'assets/images/logo/logo.png') }}"
                                            alt="logo" style="height:5rem">
                                    </div>
                                    <div class="footer__content--desc">
                                        <p>
                                            {!! $company->title !!}
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Support -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="footer__item footer--support">
                            <div class="footer__inner">
                                <div class="footer__content">
                                    <div class="footer__content--title">
                                        <h4>Our Services</h4>
                                    </div>
                                    <div class="footer__content--desc">
                                        <ul>
                                            <li><a href="{{ route('service.match.making') }}"><i
                                                        class="fa-solid fa-angle-right"></i> Match Making
                                                    Service</a></li>
                                            <li><a href="#"><i class="fa-solid fa-angle-right"></i> Astrology
                                                    Service</a></li>
                                            <li><a href="#"><i class="fa-solid fa-angle-right"></i> Mandap
                                                    Service</a></li>
                                            <li><a href="#"><i class="fa-solid fa-angle-right"></i> Priest/Pandit
                                                    Service</a></li>
                                            <li><a href="#"><i class="fa-solid fa-angle-right"></i> Food and
                                                    Catering
                                                    Service</a></li>
                                            <li><a href="#"><i class="fa-solid fa-angle-right"></i> Event
                                                    Management</a></li>
                                            <li><a href="#"><i class="fa-solid fa-angle-right"></i>Learning and
                                                    Training of Karma Kandas</a></li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Support -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="footer__item footer--support">
                            <div class="footer__inner">
                                <div class="footer__content">
                                    <div class="footer__content--title">
                                        <h4>Support & Links</h4>
                                    </div>
                                    <div class="footer__content--desc">
                                        <ul>
                                            <li><a href="{{ route('about') }}"><i class="fa-solid fa-angle-right"></i>
                                                    About Us</a>
                                            </li>
                                            <li><a href="#"><i class="fa-solid fa-angle-right"></i> Services</a>
                                            </li>
                                            <li><a href="{{ route('contact') }}"><i
                                                        class="fa-solid fa-angle-right"></i>
                                                    Contact Us</a>
                                            </li>
                                            <li><a href="{{ route('privacy-policy') }}"><i
                                                        class="fa-solid fa-angle-right"></i> Privacy
                                                    Policy</a></li>
                                            <li><a href="{{ route('terms-conditions') }}"><i
                                                        class="fa-solid fa-angle-right"></i> Terms &
                                                    Conditions</a></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Updates -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="footer__item footer--activity">
                            <div class="footer__inner">
                                <div class="footer__content">
                                    <div class="footer__content--title">
                                        <h4>Contact Us</h4>
                                    </div>
                                    <div class="footer__content--info">
                                        <p><b>Address :</b> {{ $company->address1 }}</p>
                                        <p><b>Contact :</b>
                                            {{ $company->phone1 }},{{ $company->phone2 }},{{ $company->phone3 }}</p>
                                        <p><b>Email :</b> {{ $company->email1 }}</p>
                                    </div>
                                    {{-- <div class="footer__content--desc">
										<ul>
											<li>
												<div class="content">
													<h6>New Matchmaking Profiles Added</h6>
													<p>Updated Weekly</p>
												</div>
											</li>
											<li>
												<div class="content">
													<h6>Astrology Consultation Available</h6>
													<p>Book Now</p>
												</div>
											</li>
											<li>
												<div class="content">
													<h6>Trusted by Families Nationwide</h6>
													<p>Since Years</p>
												</div>
											</li>
										</ul>
									</div> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Bottom -->
    <div class="footer__bottom wow fadeInUp" data-wow-duration="1.5s">
        <div class="container">
            <div class="footer__content text-center">
                <p class="mb-0">
                    All Rights Reserved &copy; {{ date('Y') }}
                    <a href="{{ route('home') }}">Prajapati Ghatasutra</a>
                </p>

            </div>
        </div>
    </div>

    @if (!empty($company->phone1))
        <a href="https://wa.me/{{ $company->phone1 }}" class="whatsapp-float" target="_blank" rel="noopener"
            aria-label="Chat on WhatsApp">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
    @endif



</footer>
<!-- ================> Footer section end here <================== -->
