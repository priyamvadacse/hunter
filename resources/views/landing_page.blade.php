<!doctype html>
<html class="no-js" lang="en">


<head>
    <meta charset="utf-8">
    <title>Hunttr</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- site favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/landingpage/images/hunt.png') }}">
    <!-- Place favicon.ico in the root directory -->

    <!-- All stylesheet and icons css  -->
    <link rel="stylesheet" href="{{ asset('assets/landingpage/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landingpage/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landingpage/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landingpage/css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landingpage/css/lightcase.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landingpage/css/style.css') }}">

</head>
<style>
    .about__content h3 {
        font-weight: bold;
        font-size: 40px;
        text-align: center;
        color: #E50E47;
        margin-top: -49px;

    }

    .about__bottom--head h5 {
        font-weight: bold;
        font-size: 40px;
    }

    /* .g-4{
        --bs-gutter-x: 13.5rem;
    } */
    .footer__content--desc p {
        font-size: 25px;
    }
</style>

<body>
    <!-- preloader start here -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- preloader ending here -->


    <!-- scrollToTop start here -->
    <a href="#" class="scrollToTop"><i class="fa-solid fa-angle-up"></i></a>
    <!-- scrollToTop ending here -->


    <!-- ================> header section start here <================== -->
    <header class="header" id="navbar">
        <div class="header__top d-none d-lg-block" style="background-color:#E50E47;">
            <div class="container">
                <div class="header__top--area">
                    <div class="header__top--left">
                        <ul>
                            <li>
                                <i class="fa-solid fa-phone"></i> <span>+91-123-4567 658</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-location-dot"></i> India
                            </li>
                        </ul>
                    </div>
                    <div class="header__top--right">
                        <ul>
                            <li><a href="#"><i class="fa-brands fa-facebook-f"></i> Facebook</a></li>
                            <li><a href="#"><i class="fa-brands fa-instagram"></i> Instagram</a></li>
                            <li><a href="#"><i class="fa-brands fa-youtube"></i> Youtube</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header__bottom">
            <div class="container">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="index-2.html"><img
                            src="{{ asset('assets/landingpage/images/logo/logo2.png') }}" alt="logo"></a>
                    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler--icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                        <div class="navbar-nav mainmenu">
                            <ul>
                                <!-- <li>
         <a href="#">Home</a>
         <ul>
          <li><a href="index.html">Home Page One</a></li>
          <li><a href="index-2.html" ></a></li>
          <li><a href="index-3.html">Home Page Three</a></li>
         </ul>
        </li> -->
                                <li>
                                    <a href="#">Home</a>
                                </li>

                                <!-- <li>
         <a href="#0">Pages</a>
         <ul>
          <li><a href="about.html">About Us</a></li>
                                        <li><a href="membership.html">Membership</a></li>
                                        <li><a href="comingsoon.html">comingsoon</a></li>
                                        <li><a href="404.html">404</a></li>
         </ul>
        </li> -->
                                <li>
                                    <a href="#">About</a>
                                </li>

                                <!-- <li>
         <a href="#0">Community</a>
         <ul>
          <li><a href="community.html">Community</a></li>
          <li><a href="group.html">All Group</a></li>
          <li><a href="members.html">All Members</a></li>
          <li><a href="activity.html">Activity</a></li>

         </ul>
        </li> -->
                                <!-- <li>
         <a href="#0">Shops</a>
         <ul>
          <li><a href="shop.html">Product</a></li>
          <li><a href="shop-single.html">Product Details</a></li>
          <li><a href="shop-cart.html">Product Cart</a></li>
         </ul>
        </li> -->
                                <!-- <li>
         <a href="blog.html">Blogs</a>
         <ul> -->
                                <!-- <li><a href="blog.html">Blog</a></li> -->
                                <!-- <li><a href="blog-2.html">Blog Style Two</a></li>
          <li><a href="blog-single.html">Blog Details</a></li> -->
                                <!-- </ul>
        </li> -->
                                <li>
                                    <a href="#">Story</a>
                                </li>
                                {{-- <li><a href="{{route('contactus')}}">contact</a></li> --}}
                                <li><a href="{{ route('landing.contact') }}">contact</a></li>
                            </ul>
                        </div>
                        <!-- <div class="header__more">
                            <button class="default-btn dropdown-toggle" type="button" id="moreoption" data-bs-toggle="dropdown" aria-expanded="false">My Account</button>
                            <ul class="dropdown-menu" aria-labelledby="moreoption">
                                <li><a class="dropdown-item" href="login.html">Log In</a></li>
                                <li><a class="dropdown-item" href="register.html">Sign Up</a></li>
                            </ul>
      </div> -->
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <!-- ================> header section end here <================== -->


    <!-- ================> Banner section start here <================== -->
    <div class="banner banner--style2 padding-top bg_img"
        style="background-image: url('{{ asset('assets/landingpage/images/banner/bg-2.jpg') }}');">
        <div class="container">
            <div class="banner__wrapper">
                <div class="row g-0 justify-content-center">
                    <div class="col-lg-4 col-12">
                        <div class="banner__content wow fadeInLeft" data-wow-duration="1.5s">
                            <div class="banner__title">
                                <h2>New Places, Unforgettable Dating.</h2>
                                <p>Join our international family today! Please call us for more info.</p>
                                <!-- <a href="membership.html" class="default-btn style-2"><span>Get A Membership</span></a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-12">
                        <div class="banner__thumb wow fadeInUp" data-wow-duration="1.5s">
                            <img src="{{ asset('assets/landingpage/images/banner/02.png') }}" alt="Indian singles">
                            <div class="banner__thumb--shape">
                                <div class="shapeimg shapeimg__one">
                                    <img src="{{ asset('assets/landingpage/images/banner/shape/home2/01.png') }}"
                                        alt="Dating chat">
                                </div>
                                <div class="shapeimg shapeimg__two">
                                    <img src="{{ asset('assets/landingpage/images/banner/shape/home2/02.png') }}"
                                        alt="Find a partner">
                                </div>
                                <div class="shapeimg shapeimg__three">
                                    <img src="{{ asset('assets/landingpage/images/banner/shape/home2/03.png') }}"
                                        alt="Dating apps for young adults">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================> Banner section end here <================== -->


    <!-- ================> About section start here <================== -->
    <div class="about about--style2 padding-top pt-xl-0">
        <div class="container">
            <div class="section__wrapper wow fadeInUp" data-wow-duration="1.5s">
                <div class="row g-0 justify-content-center row-cols-lg-2 row-cols-1">
                    <div class="col-lg-12">
                        <div class="about__left">
                            <div class="about__left mb-5">
                                <div class="about__content">
                                    <h3>Welcome To Hunttr</h3>
                                    {{-- <p style="font-size: 25px;">You find us, finally, and you are already in love. More
                                        than 4.000.000 around the
                                        world already shared the same experiences and uses our system. Joining us today
                                        just got easier!</p> --}}
                                </div>
                            </div>
                            <div class="about__bottom">
                                <div class="about__bottom--head">
                                    <h5>Latest Registered Members</h5>
                                    <div class="about__bottom--navi">
                                        <div class="ragi-prev"><i class="fa-solid fa-chevron-left"></i></div>
                                        <div class="ragi-next active"><i class="fa-solid fa-chevron-right"></i></div>
                                    </div>
                                </div>
                                <div class="about__bottom--body">
                                    <div class="ragi__slider overflow-hidden">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <div class="ragi__thumb">
                                                    <a href="#"><img
                                                            src="{{ asset('assets/landingpage/images/ragi/rag1.png') }}"
                                                            alt="Most Popular Dating App"></a>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="ragi__thumb">
                                                    <a href="#"><img
                                                            src="{{ asset('assets/landingpage/images/ragi/reg2.png') }}"
                                                            alt="Dating For Every Single Person"></a>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="ragi__thumb">
                                                    <a href="#"><img
                                                            src="{{ asset('assets/landingpage/images/ragi/reg3.png') }}"
                                                            alt="Trusted Online Dating Site"></a>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="ragi__thumb">
                                                    <a href="#"><img
                                                            src="{{ asset('assets/landingpage/images/ragi/reg4.png') }}"
                                                            alt="Meet People Of Many Ages"></a>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="ragi__thumb">
                                                    <a href="#"><img
                                                            src="{{ asset('assets/landingpage/images/ragi/reg5.png') }}"
                                                            alt="Free Dating Site In India"></a>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="ragi__thumb">
                                                    <a href="#"><img
                                                            src="{{ asset('assets/landingpage/images/ragi/rag1.png') }}"
                                                            alt="Best Dating App In India"></a>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="ragi__thumb">
                                                    <a href="#"><img
                                                            src="{{ asset('assets/landingpage/images/ragi/reg2.png') }}"
                                                            alt="Free Dating App In India"></a>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="ragi__thumb">
                                                    <a href="#"><img
                                                            src="{{ asset('assets/landingpage/images/ragi/reg3.png') }}"
                                                            alt="Trusted Dating App"></a>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="ragi__thumb">
                                                    <a href="#"><img
                                                            src="{{ asset('assets/landingpage/images/ragi/reg4.png') }}"
                                                            alt="Online Dating App Free Chat In India"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="about__right">
                        <div class="about__title">
                            <h3>Find Your True Love</h3>
                        </div>
                        <form action="#">
                            <div class="banner__list">
                                <div class="row">
                                    <div class="col-6">
                                        <label>I am a</label>
                                        <div class="banner__inputlist">
                                            <select>
                                                <option>Select Gender</option>
                                                <option value="male" selected>Male</option>
                                                <option value="female">Female</option>
                                                <option value="others">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label>Looking for</label>
                                        <div class="banner__inputlist">
                                            <select>
                                                <option>Select Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female" selected>Female</option>
                                                <option value="others">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="banner__list">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <label>Age</label>
                                        <div class="row g-3">
                                            <div class="col-6">
                                                <div class="banner__inputlist">
                                                    <select>
                                                        <option value="18" selected>18</option>
                                                        <option value="19">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>
                                                        <option value="24">24</option>
                                                        <option value="25">25</option>
                                                        <option value="26">26</option>
                                                        <option value="27">27</option>
                                                        <option value="28">28</option>
                                                        <option value="29">29</option>
                                                        <option value="30">30</option>
                                                        <option value="31">31</option>
                                                        <option value="32">32</option>
                                                        <option value="33">33</option>
                                                        <option value="34">34</option>
                                                        <option value="35">35</option>
                                                        <option value="36">36</option>
                                                        <option value="37">37</option>
                                                        <option value="38">38</option>
                                                        <option value="39">39</option>
                                                        <option value="40">40</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="banner__inputlist">
                                                    <select>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>
                                                        <option value="24">24</option>
                                                        <option value="25" selected>25</option>
                                                        <option value="26">26</option>
                                                        <option value="27">27</option>
                                                        <option value="28">28</option>
                                                        <option value="29">29</option>
                                                        <option value="30">30</option>
                                                        <option value="31">31</option>
                                                        <option value="32">32</option>
                                                        <option value="33">33</option>
                                                        <option value="34">34</option>
                                                        <option value="35">35</option>
                                                        <option value="36">36</option>
                                                        <option value="37">37</option>
                                                        <option value="38">38</option>
                                                        <option value="39">39</option>
                                                        <option value="40">40</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <label>Country</label>
                                        <div class="banner__inputlist">
                                            <select id="country" name="country">
                                                <option value="Afganistan">Afghanistan</option>
                                                <option value="Albania">Albania</option>
                                                <option value="Algeria">Algeria</option>
                                                <option value="American Samoa">American Samoa</option>
                                                <option value="Andorra">Andorra</option>
                                                <option value="Angola">Angola</option>
                                                <option value="Anguilla">Anguilla</option>
                                                <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                                                <option value="Argentina">Argentina</option>
                                                <option value="Armenia">Armenia</option>
                                                <option value="Aruba">Aruba</option>
                                                <option value="Australia">Australia</option>
                                                <option value="Austria">Austria</option>
                                                <option value="Azerbaijan">Azerbaijan</option>
                                                <option value="Bahamas">Bahamas</option>
                                                <option value="Bahrain">Bahrain</option>
                                                <option value="Bangladesh" selected>Bangladesh</option>
                                                <option value="Barbados">Barbados</option>
                                                <option value="Belarus">Belarus</option>
                                                <option value="Belgium">Belgium</option>
                                                <option value="Belize">Belize</option>
                                                <option value="Benin">Benin</option>
                                                <option value="Bermuda">Bermuda</option>
                                                <option value="Bhutan">Bhutan</option>
                                                <option value="Bolivia">Bolivia</option>
                                                <option value="Bonaire">Bonaire</option>
                                                <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                                                <option value="Botswana">Botswana</option>
                                                <option value="Brazil">Brazil</option>
                                                <option value="British Indian Ocean Ter">British Indian Ocean Ter
                                                </option>
                                                <option value="Brunei">Brunei</option>
                                                <option value="Bulgaria">Bulgaria</option>
                                                <option value="Burkina Faso">Burkina Faso</option>
                                                <option value="Burundi">Burundi</option>
                                                <option value="Cambodia">Cambodia</option>
                                                <option value="Cameroon">Cameroon</option>
                                                <option value="Canada">Canada</option>
                                                <option value="Canary Islands">Canary Islands</option>
                                                <option value="Cape Verde">Cape Verde</option>
                                                <option value="Cayman Islands">Cayman Islands</option>
                                                <option value="Central African Republic">Central African Republic
                                                </option>
                                                <option value="Chad">Chad</option>
                                                <option value="Channel Islands">Channel Islands</option>
                                                <option value="Chile">Chile</option>
                                                <option value="China">China</option>
                                                <option value="Christmas Island">Christmas Island</option>
                                                <option value="Cocos Island">Cocos Island</option>
                                                <option value="Colombia">Colombia</option>
                                                <option value="Comoros">Comoros</option>
                                                <option value="Congo">Congo</option>
                                                <option value="Cook Islands">Cook Islands</option>
                                                <option value="Costa Rica">Costa Rica</option>
                                                <option value="Cote DIvoire">Cote DIvoire</option>
                                                <option value="Croatia">Croatia</option>
                                                <option value="Cuba">Cuba</option>
                                                <option value="Curaco">Curacao</option>
                                                <option value="Cyprus">Cyprus</option>
                                                <option value="Czech Republic">Czech Republic</option>
                                                <option value="Denmark">Denmark</option>
                                                <option value="Djibouti">Djibouti</option>
                                                <option value="Dominica">Dominica</option>
                                                <option value="Dominican Republic">Dominican Republic</option>
                                                <option value="East Timor">East Timor</option>
                                                <option value="Ecuador">Ecuador</option>
                                                <option value="Egypt">Egypt</option>
                                                <option value="El Salvador">El Salvador</option>
                                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                <option value="Eritrea">Eritrea</option>
                                                <option value="Estonia">Estonia</option>
                                                <option value="Ethiopia">Ethiopia</option>
                                                <option value="Falkland Islands">Falkland Islands</option>
                                                <option value="Faroe Islands">Faroe Islands</option>
                                                <option value="Fiji">Fiji</option>
                                                <option value="Finland">Finland</option>
                                                <option value="France">France</option>
                                                <option value="French Guiana">French Guiana</option>
                                                <option value="French Polynesia">French Polynesia</option>
                                                <option value="French Southern Ter">French Southern Ter</option>
                                                <option value="Gabon">Gabon</option>
                                                <option value="Gambia">Gambia</option>
                                                <option value="Georgia">Georgia</option>
                                                <option value="Germany">Germany</option>
                                                <option value="Ghana">Ghana</option>
                                                <option value="Gibraltar">Gibraltar</option>
                                                <option value="Great Britain">Great Britain</option>
                                                <option value="Greece">Greece</option>
                                                <option value="Greenland">Greenland</option>
                                                <option value="Grenada">Grenada</option>
                                                <option value="Guadeloupe">Guadeloupe</option>
                                                <option value="Guam">Guam</option>
                                                <option value="Guatemala">Guatemala</option>
                                                <option value="Guinea">Guinea</option>
                                                <option value="Guyana">Guyana</option>
                                                <option value="Haiti">Haiti</option>
                                                <option value="Hawaii">Hawaii</option>
                                                <option value="Honduras">Honduras</option>
                                                <option value="Hong Kong">Hong Kong</option>
                                                <option value="Hungary">Hungary</option>
                                                <option value="Iceland">Iceland</option>
                                                <option value="Indonesia">Indonesia</option>
                                                <option value="India">India</option>
                                                <option value="Iran">Iran</option>
                                                <option value="Iraq">Iraq</option>
                                                <option value="Ireland">Ireland</option>
                                                <option value="Isle of Man">Isle of Man</option>
                                                <option value="Israel">Israel</option>
                                                <option value="Italy">Italy</option>
                                                <option value="Jamaica">Jamaica</option>
                                                <option value="Japan">Japan</option>
                                                <option value="Jordan">Jordan</option>
                                                <option value="Kazakhstan">Kazakhstan</option>
                                                <option value="Kenya">Kenya</option>
                                                <option value="Kiribati">Kiribati</option>
                                                <option value="Korea North">Korea North</option>
                                                <option value="Korea Sout">Korea South</option>
                                                <option value="Kuwait">Kuwait</option>
                                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                <option value="Laos">Laos</option>
                                                <option value="Latvia">Latvia</option>
                                                <option value="Lebanon">Lebanon</option>
                                                <option value="Lesotho">Lesotho</option>
                                                <option value="Liberia">Liberia</option>
                                                <option value="Libya">Libya</option>
                                                <option value="Liechtenstein">Liechtenstein</option>
                                                <option value="Lithuania">Lithuania</option>
                                                <option value="Luxembourg">Luxembourg</option>
                                                <option value="Macau">Macau</option>
                                                <option value="Macedonia">Macedonia</option>
                                                <option value="Madagascar">Madagascar</option>
                                                <option value="Malaysia">Malaysia</option>
                                                <option value="Malawi">Malawi</option>
                                                <option value="Maldives">Maldives</option>
                                                <option value="Mali">Mali</option>
                                                <option value="Malta">Malta</option>
                                                <option value="Marshall Islands">Marshall Islands</option>
                                                <option value="Martinique">Martinique</option>
                                                <option value="Mauritania">Mauritania</option>
                                                <option value="Mauritius">Mauritius</option>
                                                <option value="Mayotte">Mayotte</option>
                                                <option value="Mexico">Mexico</option>
                                                <option value="Midway Islands">Midway Islands</option>
                                                <option value="Moldova">Moldova</option>
                                                <option value="Monaco">Monaco</option>
                                                <option value="Mongolia">Mongolia</option>
                                                <option value="Montserrat">Montserrat</option>
                                                <option value="Morocco">Morocco</option>
                                                <option value="Mozambique">Mozambique</option>
                                                <option value="Myanmar">Myanmar</option>
                                                <option value="Nambia">Nambia</option>
                                                <option value="Nauru">Nauru</option>
                                                <option value="Nepal">Nepal</option>
                                                <option value="Netherland Antilles">Netherland Antilles</option>
                                                <option value="Netherlands">Netherlands (Holland, Europe)</option>
                                                <option value="Nevis">Nevis</option>
                                                <option value="New Caledonia">New Caledonia</option>
                                                <option value="New Zealand">New Zealand</option>
                                                <option value="Nicaragua">Nicaragua</option>
                                                <option value="Niger">Niger</option>
                                                <option value="Nigeria">Nigeria</option>
                                                <option value="Niue">Niue</option>
                                                <option value="Norfolk Island">Norfolk Island</option>
                                                <option value="Norway">Norway</option>
                                                <option value="Oman">Oman</option>
                                                <option value="Pakistan">Pakistan</option>
                                                <option value="Palau Island">Palau Island</option>
                                                <option value="Palestine">Palestine</option>
                                                <option value="Panama">Panama</option>
                                                <option value="Papua New Guinea">Papua New Guinea</option>
                                                <option value="Paraguay">Paraguay</option>
                                                <option value="Peru">Peru</option>
                                                <option value="Phillipines">Philippines</option>
                                                <option value="Pitcairn Island">Pitcairn Island</option>
                                                <option value="Poland">Poland</option>
                                                <option value="Portugal">Portugal</option>
                                                <option value="Puerto Rico">Puerto Rico</option>
                                                <option value="Qatar">Qatar</option>
                                                <option value="Republic of Montenegro">Republic of Montenegro</option>
                                                <option value="Republic of Serbia">Republic of Serbia</option>
                                                <option value="Reunion">Reunion</option>
                                                <option value="Romania">Romania</option>
                                                <option value="Russia">Russia</option>
                                                <option value="Rwanda">Rwanda</option>
                                                <option value="St Barthelemy">St Barthelemy</option>
                                                <option value="St Eustatius">St Eustatius</option>
                                                <option value="St Helena">St Helena</option>
                                                <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                                                <option value="St Lucia">St Lucia</option>
                                                <option value="St Maarten">St Maarten</option>
                                                <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                                                <option value="St Vincent & Grenadines">St Vincent & Grenadines
                                                </option>
                                                <option value="Saipan">Saipan</option>
                                                <option value="Samoa">Samoa</option>
                                                <option value="Samoa American">Samoa American</option>
                                                <option value="San Marino">San Marino</option>
                                                <option value="Sao Tome & Principe">Sao Tome & Principe</option>
                                                <option value="Saudi Arabia">Saudi Arabia</option>
                                                <option value="Senegal">Senegal</option>
                                                <option value="Seychelles">Seychelles</option>
                                                <option value="Sierra Leone">Sierra Leone</option>
                                                <option value="Singapore">Singapore</option>
                                                <option value="Slovakia">Slovakia</option>
                                                <option value="Slovenia">Slovenia</option>
                                                <option value="Solomon Islands">Solomon Islands</option>
                                                <option value="Somalia">Somalia</option>
                                                <option value="South Africa">South Africa</option>
                                                <option value="Spain">Spain</option>
                                                <option value="Sri Lanka">Sri Lanka</option>
                                                <option value="Sudan">Sudan</option>
                                                <option value="Suriname">Suriname</option>
                                                <option value="Swaziland">Swaziland</option>
                                                <option value="Sweden">Sweden</option>
                                                <option value="Switzerland">Switzerland</option>
                                                <option value="Syria">Syria</option>
                                                <option value="Tahiti">Tahiti</option>
                                                <option value="Taiwan">Taiwan</option>
                                                <option value="Tajikistan">Tajikistan</option>
                                                <option value="Tanzania">Tanzania</option>
                                                <option value="Thailand">Thailand</option>
                                                <option value="Togo">Togo</option>
                                                <option value="Tokelau">Tokelau</option>
                                                <option value="Tonga">Tonga</option>
                                                <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                                                <option value="Tunisia">Tunisia</option>
                                                <option value="Turkey">Turkey</option>
                                                <option value="Turkmenistan">Turkmenistan</option>
                                                <option value="Turks & Caicos Is">Turks & Caicos Is</option>
                                                <option value="Tuvalu">Tuvalu</option>
                                                <option value="Uganda">Uganda</option>
                                                <option value="United Kingdom">United Kingdom</option>
                                                <option value="Ukraine">Ukraine</option>
                                                <option value="United Arab Erimates">United Arab Emirates</option>
                                                <option value="United States of America">United States of America
                                                </option>
                                                <option value="Uraguay">Uruguay</option>
                                                <option value="Uzbekistan">Uzbekistan</option>
                                                <option value="Vanuatu">Vanuatu</option>
                                                <option value="Vatican City State">Vatican City State</option>
                                                <option value="Venezuela">Venezuela</option>
                                                <option value="Vietnam">Vietnam</option>
                                                <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                                                <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                                                <option value="Wake Island">Wake Island</option>
                                                <option value="Wallis & Futana Is">Wallis & Futana Is</option>
                                                <option value="Yemen">Yemen</option>
                                                <option value="Zaire">Zaire</option>
                                                <option value="Zambia">Zambia</option>
                                                <option value="Zimbabwe">Zimbabwe</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="default-btn reverse d-block"><span>Find Your
                                    Partner</span></button>
                        </form>
                    </div> --> --}}
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="about padding-top padding-bottom">
        <div class="container">
            <div class="section__header style-2 text-center wow fadeInUp" data-wow-duration="1.5s">
                <h2>It All Starts With A Date</h2>
                <p>Begin your journey with Hunttr! Explore connections, friendships, and love through meaningful dates. Join us today and start something special.</p>
            </div>
            <div class="section__wrapper">
                <div class="row g-4 justify-content-center row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1">
                    <div class="col wow fadeInUp" data-wow-duration="1.5s">
                        <div class="about__item text-center">
                            <div class="about__inner">
                                <div class="about__thumb">
                                    <img src="{{ asset('assets/landingpage/images/about/icon/01.png') }}"
                                        alt="Most Famous Dating App In India">
                                </div>
                                <div class="about__content">
                                    <h3><span class="counter" data-to="990960" data-speed="1500"></span></h3>
                                    <p>Members in Total</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col wow fadeInUp" data-wow-duration="1.6s">
                        <div class="about__item text-center">
                            <div class="about__inner">
                                <div class="about__thumb">
                                    <img src="{{ asset('assets/landingpage/images/about/icon/02.png') }}"
                                        alt="Trusted Online Dating App in India">
                                </div>
                                <div class="about__content">
                                    <h3><span class="counter" data-to="628590" data-speed="1500"></span></h3>
                                    <p>Members Online</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col wow fadeInUp" data-wow-duration="1.7s">
                        <div class="about__item text-center">
                            <div class="about__inner">
                                <div class="about__thumb">
                                    <img src="{{ asset('assets/landingpage/images/about/icon/03.png') }}"
                                        alt="Popular dating app in India">
                                </div>
                                <div class="about__content">
                                    <h3><span class="counter" data-to="314587" data-speed="1500"></span></h3>
                                    <p>Women Online</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col wow fadeInUp" data-wow-duration="1.8s">
                        <div class="about__item text-center">
                            <div class="about__inner">
                                <div class="about__thumb">
                                    <img src="{{ asset('assets/landingpage/images/about/icon/04.png') }}"
                                        alt="Popular dating app in Delhi">
                                </div>
                                <div class="about__content">
                                    <h3><span class="counter" data-to="102369" data-speed="1500"></span></h3>
                                    <p>Men Online</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================> About section end here <================== -->


    <!-- ================> Story section start here <================== -->
    <div class="story bg_img padding-top padding-bottom"
        style="background-image: url('{{ asset('assets/landingpage/images/bg-img/02.jpg') }}');">
        <div class="container">
            <div class="section__header style-2 text-center wow fadeInUp" data-wow-duration="1.5s">
                <h2>Hunttr Stories From Our Lovers</h2>
                <p>Listen and learn from our community members and find out tips and tricks to meet your love. Join us
                    and be part of a bigger family.</p>
            </div>
            <div class="section__wrapper">
                <div class="row g-4 justify-content-center row-cols-lg-3 row-cols-sm-2 row-cols-1">
                    <div class="col wow fadeInUp" data-wow-duration="1.5s">
                        <div class="story__item">
                            <div class="story__inner">
                                <div class="story__thumb">
                                    <a href="blog.html"><img
                                            src="{{ asset('assets/landingpage/images/story/cp1.png') }}"
                                            alt="Best Dating App in Mumbai"></a>
                                    <span class="member__activity member__activity--ofline">Entertainment</span>
                                </div>
                                <div class="story__content">
                                    <a href="blog.html">
                                        <h4>Dream places and locations to visit in 2022</h4>
                                    </a>
                                    <div class="story__content--author">
                                        <div class="story__content--thumb">
                                            <img src="{{ asset('assets/landingpage/images/story/author/user1.png') }}"
                                                alt="Online Dating App in Bangalore">
                                        </div>
                                        <div class="story__content--content">
                                            <h6>Rohit Sharma</h6>
                                            <p>April 16, 2022</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col wow fadeInUp" data-wow-duration="1.6s">
                        <div class="story__item">
                            <div class="story__inner">
                                <div class="story__thumb">
                                    <a href="blog.html"><img
                                            src="{{ asset('assets/landingpage/images/story/cop2.png') }}"
                                            alt="Dating App In India For Free"></a>
                                    <span class="member__activity member__activity--ofline">Love Stories</span>
                                </div>
                                <div class="story__content">
                                    <a href="blog.html">
                                        <h4>Make your dreams come true and monetise quickly</h4>
                                    </a>
                                    <div class="story__content--author">
                                        <div class="story__content--thumb">
                                            <img src="{{ asset('assets/landingpage/images/story/author/user2.png') }}"
                                                alt="Top Dating App In India 2023">
                                        </div>
                                        <div class="story__content--content">
                                            <h6>Anjali Gupta</h6>
                                            <p>March 14, 2022</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col wow fadeInUp" data-wow-duration="1.7s">
                        <div class="story__item">
                            <div class="story__inner">
                                <div class="story__thumb">
                                    <a href="blog.html"><img
                                            src="{{ asset('assets/landingpage/images/story/cop3.png') }}"
                                            alt="No 1 Dating Site In India"></a>
                                    <span class="member__activity member__activity--ofline">Attraction</span>
                                </div>
                                <div class="story__content">
                                    <a href="blog.html">
                                        <h4>Love looks not with the eyes, but with the mind.</h4>
                                    </a>
                                    <div class="story__content--author">
                                        <div class="story__content--thumb">
                                            <img src="{{ asset('assets/landingpage/images/story/author/user3.png') }}"
                                                alt="Most Popular Dating Apps In India">
                                        </div>
                                        <div class="story__content--content">
                                            <h6>Riya </h6>
                                            <p>June 18, 2022</p>
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
    <!-- ================> Story section end here <================== -->


    <!-- ================> Member section start here <================== -->

    <!-- ================> Member section end here <================== -->


    <!-- ================> About section start here <================== -->
    <div class="about padding-top padding-bottom bg_img"
        style="background-image: url('{{ asset('assets/landingpage/images/bg-img/02.jpg') }}');">
        <div class="container">
            <div class="section__header style-2 text-center wow fadeInUp" data-wow-duration="1.5s">
                <h2>Why Choose Hunttr</h2>
                <p>Our dating platform is like a breath of fresh air. Clean and trendy design with ready to use features
                    we are sure you will love.</p>
            </div>
            <div class="section__wrapper">
                <div class="row g-4 justify-content-center row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1">
                    <div class="col wow fadeInUp" data-wow-duration="1.5s">
                        <div class="about__item text-center">
                            <div class="about__inner">
                                <div class="about__thumb">
                                    <img src="{{ asset('assets/landingpage/images/about/01.jpg') }}"
                                        alt="Top Free Dating Sites In India">
                                </div>
                                <div class="about__content">
                                    <h4>Simple To Use</h4>
                                    <p>Simple steps to follow to have a matching connection.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col wow fadeInUp" data-wow-duration="1.6s">
                        <div class="about__item text-center">
                            <div class="about__inner">
                                <div class="about__thumb">
                                    <img src="{{ asset('assets/landingpage/images/about/02.jpg') }}"
                                        alt="Top 5 Dating Apps In India 2023">
                                </div>
                                <div class="about__content">
                                    <h4>Smart Matching</h4>
                                    <p>Create connections with users that are like you.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col wow fadeInUp" data-wow-duration="1.7s">
                        <div class="about__item text-center">
                            <div class="about__inner">
                                <div class="about__thumb">
                                    <img src="{{ asset('assets/landingpage/images/about/03.jpg') }}"
                                        alt="Free Online Dating App In India">
                                </div>
                                <div class="about__content">
                                    <h4>Filter Very Fast</h4>
                                    <p>Don’t waste your time! Find only what you are interested</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col wow fadeInUp" data-wow-duration="1.8s">
                        <div class="about__item text-center">
                            <div class="about__inner">
                                <div class="about__thumb">
                                    <img src="{{ asset('assets/landingpage/images/about/04.jpg') }}"
                                        alt="Real Dating App In India">
                                </div>
                                <div class="about__content">
                                    <h4>Cool Community</h4>
                                    <p>Join Hunttr: Where Connections Thrive!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================> About section end here <================== -->



    <!-- Transportation Section Ending Here -->


    <!-- ================> Work section start here <================== -->
    <div class="work work--style2 padding-top padding-bottom bg_img"
        style="background-image: url('{{ asset('assets/landingpage/images/bg-img/01.jpg') }}');">
        <div class="container">
            <div class="section__wrapper">
                <div class="row g-4 justify-content-center">
                    <div class="col-xl-6 col-lg-8 col-12 wow fadeInLeft" data-wow-duration="1.5s">
                        <div class="work__item">
                            <div class="work__inner">
                                <div class="work__thumb">
                                    <img src="{{ asset('assets/landingpage/images/work/09.png') }}"
                                        alt="Best Dating Apps India 2023">
                                </div>
                                <div class="work__content">
                                    <h3>Trust And Safety</h3>
                                    <p>Choose from one of our membership levels and unlock features you need. </p>
                                    <a href="policy.html" class="default-btn"><span>See More Details</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-8 col-12 wow fadeInRight" data-wow-duration="1.5s">
                        <div class="work__item">
                            <div class="work__inner">
                                <div class="work__thumb">
                                    <img src="{{ asset('assets/landingpage/images/work/10.png') }}"
                                        alt="Real Dating Sites In India">
                                </div>
                                <div class="work__content">
                                    <h3>Simple Membership</h3>
                                    <p>Choose from one of our membership levels and unlock features you need. </p>
                                    <a href="membership.html" class="default-btn reverse"><span>Membership
                                            Details</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================> Work section end here <================== -->


    <!-- ================> App section start here <================== -->
    <div class="app app--style2 padding-top padding-bottom">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-xxl-6 col-12">
                    <div class="app__item wow fadeInUp" data-wow-duration="1.5s">
                        <div class="app__inner">
                            <div class="app__content text-center">
                                <h4>Download App Hunttr</h4>
                                <h2>Easy Connect To Everyone</h2>
                                <p>You find us, finally and you are already in love. More than 5.000.000 around the
                                    world already shared the same experience andng ares uses our system Joining us today
                                    just got easier!</p>
                                <ul class="justify-content-center">
                                    <li><a href="#"><img
                                                src="{{ asset('assets/landingpage/images/app/01.jpg') }}"
                                                alt="Best Online Dating App In India"></a></li>
                                    <li><a href="#"><img
                                                src="{{ asset('assets/landingpage/images/app/02.jpg') }}"
                                                alt="Local Dating App India"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================> App section end here <================== -->


    <!-- ================> Footer section start here <================== -->
    <footer class="footer footer--style2">
        <div class="footer__top bg_img"
            style="background-image: url('{{ asset('assets/landingpage/images/footer/bg.jpg') }}');">
            <div class="footer__newsletter wow fadeInUp" data-wow-duration="1.5s">
                <div class="container">
                    <div class="row g-4 justify-content-center">
                        <div class="col-lg-6 col-12">
                            <div class="footer__newsletter--area">
                                <div class="footer__newsletter--title">
                                    <h4>Newsletter Sign up</h4>
                                </div>
                                <div class="footer__newsletter--form">
                                    <form action="#">
                                        <input type="email" placeholder="Your email address">
                                        <button style="background-color:#E50E47;" type="submit"
                                            class="default-btn"><span>Subscribe</span></button>
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
            </div>
            <div class="footer__toparea padding-top padding-bottom wow fadeInUp" data-wow-duration="1.5s">
                <div class="container d-flex">
                    <div class="row g-4">
                        <div class="col-lg-6 col-lg-offset-3 col-sm-6 col-12">
                            <div class="footer__item footer--about">
                                <div class="footer__inner">
                                    <div class="footer__content">
                                        <div class="footer__content--title">
                                            <h4>About Hunttr</h4>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="footer__content--desc">

                                                <p>Hunttr website is an online platform that facilitates connections and
                                                    relationships between individuals. Users can create profiles and
                                                    browse
                                                    potential matches, swiping to express interest.<span
                                                        id="dots">...</span>

                                                    <span id="more">. Messaging
                                                        features
                                                        allow users to communicate and get to know each other. Safety
                                                        measures, such as verification and reporting, are implemented to
                                                        protect users' privacy and security. Premium subscriptions may
                                                        offer
                                                        additional features for enhanced user experiences</span>
                                                </p>
                                                <button id="mybtn" data-type="show-read-more">Read more</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="footer__item footer--support">
                                <div class="footer__inner">
                                    <div class="footer__content">
                                        <div class="footer__content--title">
                                            <h4>Contacts & Support</h4>
                                        </div>
                                        <div class="footer__content--desc">
                                            <ul>
                                                <li><a href="#"><i class="fa-solid fa-angle-right"></i>
                                                        About
                                                        Us</a>
                                                </li>
                                                <li><a href="#"><i class="fa-solid fa-angle-right"></i>
                                                        Contact</a>
                                                </li>
                                                <li><a href="#"><i class="fa-solid fa-angle-right"></i>Story</a>
                                                </li>
                                                <!-- <li><a href="#"><i class="fa-solid fa-angle-right"></i> Get in Touch</a></li> -->
                                                <li><a href="#"><i class="fa-solid fa-angle-right"></i>
                                                        FAQ</a>
                                                </li>
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
                <div class="footer__content text-center">
                    <p class="mb-0">All Rights Reserved &copy; <a href="index-2.html">Hunttr</a> || Design By:Xcrino
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- ================> Footer section end here <================== -->


    <!-- All Needed JS -->
    <script src="{{ asset('assets/landingpage/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/landingpage/js/vendor/modernizr-3.11.2.min.js') }}"></script>
    <script src="{{ asset('assets/landingpage/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/landingpage/js/swiper.min.js') }}"></script>
    <!-- <script src="assets/js/all.min.js"></script> -->
    <script src="{{ asset('assets/landingpage/js/wow.js') }}"></script>
    <script src="{{ asset('assets/landingpage/js/counterup.js') }}"></script>
    <script src="{{ asset('assets/landingpage/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/landingpage/js/lightcase.js') }}"></script>
    <script src="{{ asset('assets/landingpage/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/landingpage/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/landingpage/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/landingpage/js/main.js') }}"></script>


    <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
    <script>
        window.ga = function() {
            ga.q.push(arguments)
        };
        ga.q = [];
        ga.l = +new Date;
        ga('create', 'UA-XXXXX-Y', 'auto');
        ga('set', 'anonymizeIp', true);
        ga('set', 'transport', 'beacon');
        ga('send', 'pageview')

        //  about hunttr read more function //



        function myFunction() {
            var dots = document.getElementById("dots");
            var moretext = document.getElementById("more");
            var btnText = document.getElementById("mybtn");

            if (dots.style.display === "none") {
                dots.style.display = "inline";
                btnText.innerHTML = "Read more";
                moretext.style.display = "none";
            } else {
                dots.style.display = "none";
                btnText.innerHTML = "Read less";
                moretext.style.display = "inline";
            }
        }
        $('#more').hide();
        $('#mybtn').on('click', function(e) {
            e.preventDefault();
            var type = $(this).data('type');
            if (type == "show-read-more") {
                $('#more').show();
                $('#mybtn').data('type', 'hide-show-more');
                $('#mybtn').html('Less More');
            }
            if (type == "hide-show-more") {
                $('#more').hide();
                $('#mybtn').data('type', 'show-read-more');
                $('#mybtn').html('Read More');
            }


        })
    </script>

    <script src="../../../../www.google-analytics.com/analytics.js" async></script>


</body>

<!-- Mirrored from demos.codexcoder.com/themeforest/html/ollya/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 11 May 2023 12:47:50 GMT -->

</html>
