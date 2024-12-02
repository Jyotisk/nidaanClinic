<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home One || Nidaan || Medical & Healthcare HTML Template</title>
    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/favicons/apple-touch-icon.png')}}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicons/favicon-32x32.png')}}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicons/favicon-16x16.png')}}" />
    <link rel="manifest" href="assets/images/favicons/site.webmanifest" />
    <meta name="description" content="Nidaan Healthcare Clinic" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/bootstrap-select/bootstrap-select.min.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/animate/animate.min.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/all.min.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/jquery-ui/jquery-ui.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/jarallax/jarallax.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/jquery-magnific-popup/jquery.magnific-popup.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/nouislider/nouislider.min.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/nouislider/nouislider.pips.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/tiny-slider/tiny-slider.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/mediox-icons/style.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/owl-carousel/css/owl.carousel.min.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/owl-carousel/css/owl.theme.default.min.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/slick/css/slick.css')}}" />

    <!-- template styles -->
    <link rel="stylesheet" href="{{asset('css/mediox.css')}}" />
</head>

<body class="custom-cursor">

    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <div class="preloader">
        <div class="preloader__image" style="background-image: url('images/loader.png');"></div>
    </div>
    <!-- /.preloader -->

    <div class="page-wrapper">
        <header class="main-header main-header--two sticky-header sticky-header--normal">
            <div class="container-fluid">
                <div class="main-header__inner">
                    <div class="main-header__logo logo-retina">
                        <a href="{{route('index')}}">
                            <img src="{{asset('images/logo-dark.png')}}" alt="Nidaan HTML" width="164">
                        </a>
                    </div><!-- /.main-header__logo -->
                    <div class="main-header__right">
                        {{-- <div class="main-header__sidebar-btn sidebar-btn__toggler d-none">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div><!-- /.sidebar-btn__toggler --> --}}
                        <nav class="main-header__nav main-menu">
                            <ul class="main-menu__list">

                                <li>
                                    <a href="/">Home</a>
                                </li>

                                <li>
                                    <a href="/about">About</a>
                                </li>

                                <li class="dropdown">
                                    <a href="/services">Services</a>
                                    <ul>
                                        @foreach($menuItems AS $items)
                                        @if($items->type=='service')
                                        <li>
                                            <a href="{{url('/service-details')}}/{{$items->id}}">{{$items->facility_name}}</a>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </li>

                                <li class="dropdown">
                                    <a href="/speciality">Specialities</a>
                                    <ul>
                                        @foreach($menuItems AS $items)
                                        @if($items->type=='speciality')
                                        <li>
                                            <a href="{{url('/service-details')}}/{{$items->id}}">{{$items->facility_name}}</a>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </li>

                                <li>
                                    <a href="/gallery">Gallery</a>
                                </li>

                                <li>
                                    <a href="/teams">Teams</a>
                                </li>

                                <li>
                                    <a href="/contact">Contact</a>
                                </li>
                            </ul>
                        </nav>

                        <!-- /.main-header__nav -->
                        <div class="mobile-nav__btn mobile-nav__toggler">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div><!-- /.mobile-nav__toggler -->

                        <div class="main-header__call">
                            <span class="main-header__call__icon">
                                <i class="icon-telephone"></i>
                            </span><!-- /.main-header__call__icon -->
                            <div class="main-header__call__content">
                                <p class="main-header__call__title">call emergency</p><!-- /.call__title -->
                                <h4 class="main-header__call__number">
                                    <a href="tel:+916002095307">+91 6002095307</a>
                                </h4><!-- /.main-header__call__number -->
                            </div><!-- /.main-header__call__content -->
                        </div><!-- /.main-header__call -->
                        <a href="/booking" class="mediox-btn main-header__btn">
                            <span>make an appointment</span>
                            <span class="mediox-btn__icon"><i class="icon-up-right-arrow"></i></span>
                        </a><!-- /.mediox-btn -->
                    </div><!-- /.main-header__right -->
                </div><!-- /.main-header__inner -->
            </div><!-- /.container-fluid -->
        </header>

        <main>
            {{ $slot }}
        </main>

        <footer class="main-footer section-space-top">
            <div class="main-footer__bg" style="background-image: url('images/shapes/footer-bg.png');"></div>
            <!-- /.main-footer__bg -->
            <div class="container">
                <div class="row gutter-y-40">
                    <div class="col-xl-4 col-lg-6 col-md-7 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="00ms">
                        <div class="footer-widget footer-widget--about">
                            <div class="footer-widget__logo logo-retina">
                                <a href="{{route('index')}}">
                                    <img src="{{asset('images/logo-light.png')}}" alt="Nidaan HTML" width="164">
                                </a>
                            </div><!-- /.footer-widget__logo -->
                            <p class="footer-widget__about-text">Morem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elita Florai Psum Dolor Sit Amet, Consecteture.Borem Ipsum Dolor</p><!-- /.footer-widget__about-text -->
                            <a href="#appointmentSection" class="footer-widget__btn">
                                <span>get consultant</span>
                                <span class="footer-widget__btn__icon"><i class="icon-up-right-arrow"></i></span>
                            </a><!-- /.footer-widget__btn -->
                            <div class="social-links">
                                <a href="https://www.facebook.com/profile.php?id=61557296146800" target="_blank">
                                    <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                    <span class="sr-only">Facebook</span>
                                </a>
                                <a href="https://twitter.com">
                                    <i class="fab fa-twitter" aria-hidden="true"></i>
                                    <span class="sr-only">Twitter</span>
                                </a>
                                <a href="https://instagram.com">
                                    <i class="fab fa-instagram" aria-hidden="true"></i>
                                    <span class="sr-only">Instagram</span>
                                </a>
                                <a href="https://youtube.com">
                                    <i class="fab fa-youtube" aria-hidden="true"></i>
                                    <span class="sr-only">Youtube</span>
                                </a>
                            </div><!-- /.social-links -->
                        </div><!-- /.footer-widget -->
                    </div><!-- /.col-xl-4 -->
                    <div class="col-xl-2 col-lg-3 col-md-5 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="100ms">
                        <div class="footer-widget footer-widget--links">
                            <h2 class="footer-widget__title">our <span>Specialities</span></h2><!-- /.footer-widget__title -->
                            <ul class="list-unstyled footer-widget__links">
                                @foreach($menuItems AS $items)
                                @if($items->type=='service')
                                <li>
                                    <a href="{{url('/service-details')}}/{{$items->id}}">{{$items->facility_name}}</a>
                                </li>
                                @endif
                                @endforeach
                            </ul><!-- /.list-unstyled footer-widget__links -->
                        </div><!-- /.footer-widget -->
                    </div><!-- /.col-xl-2 -->
                    <div class="col-xl-2 col-lg-3 col-md-5 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms">
                        <div class="footer-widget footer-widget--links">
                            <h2 class="footer-widget__title">useful <span>links</span></h2><!-- /.footer-widget__title -->
                            <ul class="list-unstyled footer-widget__links">
                                <li><a href="/about">About Us</a></li>
                                <li><a href="/services">Our Services</a></li>
                                <li><a href="/speciality">Specialities</a></li>
                                <li><a href="/teams">Our Team</a></li>
                                <li><a href="/booking">Appointments</a></li>
                                <li><a href="/contact">Contact Us</a></li>
                            </ul><!-- /.list-unstyled footer-widget__links -->
                        </div><!-- /.footer-widget -->
                    </div><!-- /.col-xl-2 -->
                    <div class="col-xl-4 col-lg-6 col-md-7 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="100ms">
                        <div class="footer-widget footer-widget--links">
                            <h2 class="footer-widget__title">our <span>Services</span></h2><!-- /.footer-widget__title -->
                            <ul class="list-unstyled footer-widget__links">
                                @foreach($menuItems AS $items)
                                @if($items->type=='speciality')
                                <li>
                                    <a href="{{url('/service-details')}}/{{$items->id}}">{{$items->facility_name}}</a>
                                </li>
                                @endif
                                @endforeach
                            </ul><!-- /.list-unstyled footer-widget__links -->
                        </div><!-- /.footer-widget -->
                    </div><!-- /.col-xl-2 -->
                </div><!-- /.row -->
                <div class="main-footer__bottom">
                    <div class="main-footer__info">
                        <div class="main-footer__info__bg" style=""></div><!-- /.main-footer__info__bg -->
                        <div class="row main-footer__info__row gutter-y-40">
                            <div class="main-footer__info__col-1 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="00ms">
                                <div class="main-footer__contact">
                                    <span class="main-footer__contact__icon">
                                        <i class="icon-location"></i>
                                    </span><!-- /.main-footer__contact__icon -->
                                    <div class="main-footer__contact__content">
                                        <p class="main-footer__contact__title">office address</p>
                                        <h4 class="main-footer__contact__text">
                                            <a href="https://www.google.com/maps">ANU BHABAN COMPLEX, GANAKPATTY GOHAIN GAON</a>
                                            <span>NEAR PHUKAN NAGAR WATER SUPPLY</span>
                                            <span>SIVASAGAR, 785640</span>
                                        </h4>
                                    </div><!-- /.main-footer__contact__content -->
                                </div><!-- /.main-footer__contact -->
                            </div><!-- /.main-footer__info__col-1 -->
                            <div class="main-footer__info__col-2 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="100ms">
                                <div class="main-footer__contact">
                                    <span class="main-footer__contact__icon">
                                        <i class="icon-email"></i>
                                    </span><!-- /.main-footer__contact__icon -->
                                    <div class="main-footer__contact__content">
                                        <p class="main-footer__contact__title">send email</p>
                                        <h4 class="main-footer__contact__text">
                                            <a href="mailto:nidaanmedicalstore@gmail.com">nidaanmedicalstore@gmail.com</a>
                                        </h4>
                                    </div><!-- /.main-footer__contact__content -->
                                </div><!-- /.main-footer__contact -->
                            </div><!-- /.main-footer__info__col-2 -->
                            <div class="main-footer__info__col-3 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms">
                                <div class="main-footer__contact">
                                    <span class="main-footer__contact__icon">
                                        <i class="icon-telephone"></i>
                                    </span><!-- /.main-footer__contact__icon -->
                                    <div class="main-footer__contact__content">
                                        <p class="main-footer__contact__title">call emergency</p>
                                        <h4 class="main-footer__contact__text">
                                            <a href="tel:+916002095307">+916002095307</a>
                                        </h4>
                                    </div><!-- /.main-footer__contact__content -->
                                </div><!-- /.main-footer__contact -->
                            </div><!-- /.main-footer__info__col-3 -->
                        </div><!-- /.row main-footer__info__row -->
                    </div><!-- /.main-footer__info -->
                    <p class="main-footer__copyright">
                        &copy; Copyright <span class="dynamic-year"></span> by Nidaan | Developed by <a href="https://cybernetssolutions.com/" target="_blank">Cybernet Solutions</a>.
                    </p>
                </div><!-- /.main-footer__bottom -->
            </div><!-- /.container -->
        </footer><!-- /.main-footer section-space-top -->
    </div>

    <div class="mobile-nav__wrapper">
        <div class="mobile-nav__overlay mobile-nav__toggler"></div>
        <!-- /.mobile-nav__overlay -->
        <div class="mobile-nav__content">
            <span class="mobile-nav__close mobile-nav__toggler"><i class="icon-close"></i></span>

            <div class="logo-box logo-retina">
                <a href="{{route('index')}}" aria-label="logo image"><img src="{{asset('images/logo-light.png')}}" width="164" alt="" /></a>
            </div>
            <!-- /.logo-box -->
            <div class="mobile-nav__container"></div>
            <!-- /.mobile-nav__container -->

            <ul class="mobile-nav__contact list-unstyled">
                <li>
                    <span class="mobile-nav__contact__icon">
                        <i class="fa fa-envelope"></i>
                    </span>
                    <a href="mailto:nidaanmedicalstore@gmail.com">nidaanmedicalstore@gmail.com</a>
                </li>
                <li>
                    <span class="mobile-nav__contact__icon">
                        <i class="fa fa-phone-alt"></i>
                    </span>
                    <a href="tel:+918638184447">+91 8638184447</a>
                </li>
            </ul><!-- /.mobile-nav__contact -->
            <div class="mobile-nav__social social-links">
                <a href="https://www.facebook.com/profile.php?id=61557296146800" target="_blank">
                    <i class="fab fa-facebook-f" aria-hidden="true"></i>
                    <span class="sr-only">Facebook</span>
                </a>
                <a href="https://twitter.com">
                    <i class="fab fa-twitter" aria-hidden="true"></i>
                    <span class="sr-only">Twitter</span>
                </a>
                <a href="https://instagram.com">
                    <i class="fab fa-instagram" aria-hidden="true"></i>
                    <span class="sr-only">Instagram</span>
                </a>
                <a href="https://youtube.com">
                    <i class="fab fa-youtube" aria-hidden="true"></i>
                    <span class="sr-only">Youtube</span>
                </a>
            </div><!-- /.mobile-nav__social -->
        </div>
        <!-- /.mobile-nav__content -->
    </div>

    <a href="#" data-target="html" class="scroll-to-target scroll-to-top">
        <span class="scroll-to-top__text">back top</span>
        <span class="scroll-to-top__wrapper"><span class="scroll-to-top__inner"></span></span>
    </a>

    <script src="{{asset('plugins/jquery/jquery-3.7.0.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/jarallax/jarallax.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-ui/jquery-ui.js')}}"></script>
    <script src="{{asset('plugins/jquery-ajaxchimp/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-appear/jquery.appear.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-circle-progress/jquery.circle-progress.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-magnific-popup/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-validate/jquery.validate.min.js')}}"></script>
    <script src="{{asset('plugins/nouislider/nouislider.min.js')}}"></script>
    <script src="{{asset('plugins/tiny-slider/tiny-slider.js')}}"></script>
    <script src="{{asset('plugins/wnumb/wNumb.min.js')}}"></script>
    <script src="{{asset('plugins/owl-carousel/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('plugins/slick/js/slick.min.js')}}"></script>
    <script src="{{asset('plugins/wow/wow.js')}}"></script>
    <script src="{{asset('plugins/imagesloaded/imagesloaded.min.js')}}"></script>
    <script src="{{asset('plugins/isotope/isotope.js')}}"></script>
    <script src="{{asset('plugins/countdown/countdown.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-circleType/jquery.circleType.js')}}"></script>
    <script src="{{asset('plugins/jquery-lettering/jquery.lettering.min.js')}}"></script>
    <!-- template js -->
    <script src="{{asset('js/mediox.js')}}"></script>
</body>

</html>
