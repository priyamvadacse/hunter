<style>
    .cut-text { 
  width: 300px; 
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
<footer class="footer footer--style2">
    <div class="footer__top bg_img" style="background-image: url(assets/images/footer/bg.jpg)">
        {{-- <div class="footer__newsletter wow fadeInUp" data-wow-duration="1.5s">
            <div class="container">
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-6 col-12">
                        <div class="footer__newsletter--area">
                            <div class="footer__newsletter--title">
                                <h4>Newsletter Sign up</h4>
                            </div>
                            <div class="footer__newsletter--form" >
                                <form action="#">
                                    <input type="email" placeholder="Your email address">
                                    <button style="background-color:#E50E47;" type="submit" class="default-btn" ><span>Subscribe</span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="footer__newsletter--area justify-content-xxl-end">
                            <div class="footer__newsletter--title me-xl-4">
                                <h4>Join Community</h4>
                            </div>
                            <div class="footer__newsletter--social">
                                <ul>
                                    <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-twitch"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                    <!-- <li><a href="#"><i class="fa-brands fa-dribbble"></i></a></li> -->
                                    <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="footer__toparea padding-top padding-bottom wow fadeInUp" data-wow-duration="1.5s">
            <div class="container ">
                <div class="row g-4">
                    <div class="col-lg-4 col-sm-4 col-12">
                        <div class="footer__item footer--about">
                            <div class="footer__inner">
                                <div class="footer__content">
                                    <div class="footer__content--title">
                                        <h4>About Hunttr</h4>
                                    </div>
                                    @php
                                        $about_us = App\Models\AboutUs::first();
                                                                                 
                                    @endphp
                                    <div class="footer__content--desc">
                                        <div class="cut-text footer__content--info">
                                            @if (!empty($about_us))
                                                <p >{!! $about_us->content !!}</p>
                                            @else
                                                <p></p>
                                            @endif                                        
                                        </div>
                                        <a href="{{route('landing.aboutpage')}}">Load More</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="col-lg-4 col-sm-4 col-12">
                        <div class="footer__item footer--support">
                            <div class="footer__inner">
                                <div class="footer__content">
                                    <div class="footer__content--title">
                                        <h4>Contacts & Support</h4>
                                    </div>
                                    <div class="footer__content--desc">
                                        <ul>
                                            <li><a href="{{ route('landing.aboutpage') }}"><i
                                                        class="fa-solid fa-angle-right"></i> About Us</a></li>
                                            <li><a href="{{ route('landing.contactus') }}"><i
                                                        class="fa-solid fa-angle-right"></i> Contact</a></li>
                                            <li><a href="#"><i class="fa-solid fa-angle-right"></i>Story</a></li>
                                            <!-- <li><a href="#"><i class="fa-solid fa-angle-right"></i> Get in Touch</a></li> -->
                                            <li><a href="{{ route('landing.faq_page') }}"><i
                                                        class="fa-solid fa-angle-right"></i> FAQ</a></li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-12">
                        <div class="footer__item footer--activity">
                            <div class="footer__inner">
                                <div class="footer__content">
                                    <div class="footer__content--title">
                                        <h4>Contact Address</h4>
                                    </div>
                                    @php
                                        $contactUs = App\Models\Admin\ContactUs::first();
                                    @endphp

                                    <div class="footer__content--desc">
                                        <ul>
                                            <div class="footer__content--info">
                                                {{-- <p ><b>Address :</b> {!! $contactUs->contact!!}</p> --}}
                                                {{-- <p class="clickable-phone"><b>Phone :</b> +91 {{$contactUs->phone_number}} </p> --}}
                                                <p class="clickable-email"><b>Email :</b> {{ $contactUs->email}}</p>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="footer__bottom wow fadeInUp" data-wow-duration="1.5s">
        <div class="container">
            <div class=" text-center">
                <p class="mb-0">All Rights Reserved &copy; <a href="{{ route('landing.page') }}">Hunttr</a> || Design
                    By:Xcrino</p>
                <p> <a href="{{ route('landing.term_conditions') }}">Terms & Condition</a>|<a
                        href="{{ route('landing.privacy_policy') }}"> Privacy & Cookie Policy</a> </p>
            </div>
        </div>
    </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
		// Select the elements using their classes
		var phoneElement = $('.clickable-phone');
		var emailElement = $('.clickable-email');

		// Make the phone number clickable
		var phoneNumber = phoneElement.text();
		var phoneNumberLink = $('<a style="color: rgb(85, 85, 85);">').attr('href', 'tel:' + phoneNumber).text(phoneNumber);
		phoneElement.empty().append(phoneNumberLink);

		// Make the email address clickable
		var emailAddress = emailElement.text();
		var emailAddressLink = $('<a style="color: rgb(85, 85, 85);">').attr('href', 'mailto:' + emailAddress).text(emailAddress);
		emailElement.empty().append(emailAddressLink);
	});
</script>
