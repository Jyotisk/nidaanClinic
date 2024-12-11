<x-guest-layout>
    <div style="margin-top: 144px">
        <section class="page-header">
            <div class="container-fluid">
                <div class="page-header__inner">
                    <div class="page-header__bg" style="background-image: url({{ asset('images/backgrounds/page-header-bg.jpg' )}});"></div><!-- /.page-header__bg -->
                    <div class="container">
                        <div class="page-header__content">
                            <h2 class="page-header__title">Specialities</h2>
                            <ul class="mediox-breadcrumb list-unstyled">
                                <li>
                                    <span class="mediox-breadcrumb__icon"><i class="icon-home"></i></span>
                                    <a href="/">Home</a>
                                </li>
                                <li><span>Specialities</span></li>
                            </ul><!-- /.mediox-breadcrumb list-unstyled -->
                        </div><!-- /.page-header__content -->
                    </div><!-- /.container -->
                </div><!-- /.page-header__inner -->
            </div><!-- /.container-fluid -->
        </section><!-- /.page-header -->
    
        <section class="services-page services-page--two section-space">
            <div class="container">
                <div class="row gutter-y-30">
                    <div class="col-12">
                        <div class="masonry">
                            @foreach($specialities AS $speciality)
                                <div class="brick wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="00ms">
                                    <div class="service-card">
                                        <div class="service-card__image">
                                            <img src="{{ env('IMAGE_PATH').Storage::url($speciality->image)}}" alt="{{ $speciality->facility_name }}">
                                        </div><!-- /.service-card__image -->
                                        <span class="service-card__icon">
                                            <i class="icon-medicine"></i>
                                        </span><!-- /.service-card__icon -->
                                        <div class="service-card__content">
                                            <p class="service-card__total-doctors">{{ $speciality->doctor_count }}+ doctors</p><!-- /.service-card__total-doctors -->
                                            <div class="service-card__content__inner">
                                                <h3 class="service-card__title"><a href="{{url('/service-details')}}/{{$speciality->id}}">{{ $speciality->facility_name }}</a></h3><!-- /.service-card__title -->
                                                <a href="{{url('/service-details')}}/{{$speciality->id}}" class="service-card__link">
                                                    <i class="icon-up-right-arrow"></i>
                                                </a><!-- /.service-card__link -->
                                            </div><!-- /.service-card__content__inner -->
                                        </div><!-- /.service-card__content -->
                                    </div><!-- /.service-card -->
                                </div><!-- /.col-lg-4 col-md-6 -->
                            @endforeach
                        </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.services-page services-page--two section-space -->
    </div>
</x-guest-layout>