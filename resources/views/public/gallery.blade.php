<x-guest-layout>
    <div style="margin-top: 144px;">
        <section class="page-header">
            <div class="container-fluid">
                <div class="page-header__inner">
                    <div class="page-header__bg" style="background-image: url('images/backgrounds/page-header-bg.jpg');"></div><!-- /.page-header__bg -->
                    <div class="container">
                        <div class="page-header__content">
                            <h2 class="page-header__title">Gallery</h2>
                            <ul class="mediox-breadcrumb list-unstyled">
                                <li>
                                    <span class="mediox-breadcrumb__icon"><i class="icon-home"></i></span>
                                    <a href="{{route('index')}}">Home</a>
                                </li>
                                <li><span>Gallery</span></li>
                            </ul><!-- /.mediox-breadcrumb list-unstyled -->
                        </div><!-- /.page-header__content -->
                    </div><!-- /.container -->
                </div><!-- /.page-header__inner -->
            </div><!-- /.container-fluid -->
        </section><!-- /.page-header -->

        <section class="gallery-page section-space">
            <div class="container">
                <div class="row gutter-y-30 fitRow-layout">
                    @foreach($gallaryImage AS $image)
                    <div class="col-md-6 col-lg-4">
                        <div class="gallery-page__card">
                            <img src="{{ env('IMAGE_PATH').Storage::url($image->image)}}" alt="gallery">
                            <div class="gallery-page__card__hover">
                                <a href="{{ env('IMAGE_PATH').Storage::url($image->image)}}" class="img-popup">
                                    <span class="gallery-page__card__icon"></span>
                                </a>
                                <span class="gallery-page__card__hover__box gallery-page__card__hover__box--1"></span>
                                <span class="gallery-page__card__hover__box gallery-page__card__hover__box--2"></span>
                                <span class="gallery-page__card__hover__box gallery-page__card__hover__box--3"></span>
                                <span class="gallery-page__card__hover__box gallery-page__card__hover__box--4"></span>
                            </div><!-- /.gallery-page__card__hover -->
                        </div><!-- /.gallery-page__card -->
                    </div>
                    @endforeach
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.gallery-page section-space -->
    </div>
</x-guest-layout>