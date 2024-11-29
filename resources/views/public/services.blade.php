<x-guest-layout>
    <div style="margin-top: 144px;">
        <section class="page-header">
            <div class="container-fluid">
                <div class="page-header__inner">
                    <div class="page-header__bg" style="background-image: url('images/backgrounds/page-header-bg.jpg');"></div><!-- /.page-header__bg -->
                    <div class="container">
                        <div class="page-header__content">
                            <h2 class="page-header__title">Our Services</h2>
                            <ul class="mediox-breadcrumb list-unstyled">
                                <li>
                                    <span class="mediox-breadcrumb__icon"><i class="icon-home"></i></span>
                                    <a href="{{route('index')}}">Home</a>
                                </li>
                                <li><span>Our Services</span></li>
                            </ul><!-- /.mediox-breadcrumb list-unstyled -->
                        </div><!-- /.page-header__content -->
                    </div><!-- /.container -->
                </div><!-- /.page-header__inner -->
            </div><!-- /.container-fluid -->
        </section><!-- /.page-header -->
    
        <section class="services-page services-page--three section-space">
            <div class="container">
                <div class="services-page__carousel mediox-owl__carousel mediox-owl__carousel--with-shadow mediox-owl__carousel--basic-nav owl-carousel owl-theme" data-owl-options='{
                "items": 1,
                "margin": 10,
                "loop": true,
                "smartSpeed": 700,
                "nav": false,
                "navText": ["<span class=\"icon-arrow-left\"></span>","<span class=\"icon-arrow-right\"></span>"],
                "dots": true,
                "autoplay": true,
                "responsive": {
                    "0": {
                        "items": 1,
                        "nav": true,
                        "dots": false,
                        "margin": 10
                    },
                    "768": {
                        "items": 2,
                        "margin": 30
                    }
                }
            }'>
                    @foreach($services AS $service)
                    <div class="item wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="00ms">
                        <div class="service-card-two">
                            <div class="service-card-two__bg"></div><!-- /.service-card-two__bg -->
                            <div class="service-card-two__content">
                                <img src="{{ env('IMAGE_PATH').Storage::url($service->service_image)}}" alt="Medicines" class="service-card-two__image">
                                <h3 class="service-card-two__title"><a href="#">{{ $service->service_name }}</a></h3><!-- /.service-card-two__title -->
                                <a href="#" class="service-card-two__link">
                                    <i class="icon-up-right-arrow"></i>
                                </a><!-- /.service-card-two__link -->
                            </div><!-- /.service-card-two__content -->
                        </div><!-- /.service-card-two -->
                    </div><!-- /.item -->
                    @endforeach
                </div><!-- /.services-page__carousel -->
            </div><!-- /.container -->
        </section><!-- /.services-page services-page--three section-space -->
    </div>
</x-guest-layout>