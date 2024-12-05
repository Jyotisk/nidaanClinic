<x-guest-layout>
    <div style="margin-top: 144px;">
        <section class="page-header">
            <div class="container-fluid">
                <div class="page-header__inner">
                    <div class="page-header__bg" style="background-image: url('images/backgrounds/page-header-bg.jpg');"></div><!-- /.page-header__bg -->
                    <div class="container">
                        <div class="page-header__content">
                            <h2 class="page-header__title">{{$speciaLists->doctor_name}}</h2>
                            <ul class="mediox-breadcrumb list-unstyled">
                                <li>
                                    <span class="mediox-breadcrumb__icon"><i class="icon-home"></i></span>
                                    <a href="{{route('index')}}">Home</a>
                                </li>
                                <li><span>Teams</span></li>
                                <li><span>{{$speciaLists->doctor_name}}</span></li>
                            </ul><!-- /.mediox-breadcrumb list-unstyled -->
                        </div><!-- /.page-header__content -->
                    </div><!-- /.container -->
                </div><!-- /.page-header__inner -->
            </div><!-- /.container-fluid -->
        </section><!-- /.page-header -->

        <section class="team-details section-space-top">
            <div class="container">
                <div class="team-details__inner">
                    <div class="team-details__image wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="00ms">
                        <img class="w-100" src="{{ env('IMAGE_PATH').Storage::url($speciaLists->doctor_image)}}" alt="Sarah Albert">
                        <div class="social-links">
                            @if($speciaLists->facebook_link)
                            <a href="{{$speciaLists->facebook_link}}">
                                <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                <span class="sr-only">Facebook</span>
                            </a>
                            @endif
                            @if($speciaLists->instagram_link)
                            <a href="{{$speciaLists->instagram_link}}">
                                <i class="fab fa-instagram" aria-hidden="true"></i>
                                <span class="sr-only">Instagram</span>
                            </a>
                            @endif
                            @if($speciaLists->twitter_link)
                            <a href="{{$speciaLists->twitter_link}}">
                                <i class="fab fa-twitter" aria-hidden="true"></i>
                                <span class="sr-only">Twitter</span>
                            </a>
                            @endif
                            @if($speciaLists->link_in_link)
                            <a href="{{$speciaLists->link_in_link}}">
                                <i class="fab fa-linkedin-in" aria-hidden="true"></i>
                                <span class="sr-only">Linkedin</span>
                            </a>
                            @endif
                        </div><!-- /.social-links -->
                        <div class="team-details__identity">
                            <h3 class="team-details__name">{{$speciaLists->doctor_name}}</h3><!-- /.team-details__name -->
                            <p class="team-details__designation">{{$speciaLists->department_name}}</p>
                            <!-- /.team-details__designation -->
                        </div><!-- /.team-details__identity -->
                    </div><!-- /.team-details__image -->
                    <div class="team-details__about wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="100ms">
                        <div class="team-details__about__inner">
                            <h3 class="team-details__about__title">about me</h3><!-- /.team-details__about__title -->
                            <p class="team-details__about__description">{{$speciaLists->descriptions}}</p><!-- /.team-details__about__description -->
                        </div><!-- /.team-details__about__inner -->
                        <ul class="team-details__contact list-unstyled">
                            @foreach ($speciaListDetails as $item)
                            <li>
                                <div class="team-details__contact__content">
                                    @if($item->header)
                                    <h3 class="team-details__contact__title">{{ $item->header }}</h3>
                                    @endif
                                    @if($item->specialist_detail)
                                    <p>{{$item->specialist_detail}}</p>
                                    @endif
                                </div>
                            </li><!-- /.item -->
                            @endforeach
                        </ul><!-- /.team-details__contact -->
                    </div><!-- /.team-details__about -->
                </div><!-- /.team-details__inner -->
            </div><!-- /.container -->
        </section><!-- /.team-details section-space-top -->
    </div>
</x-guest-layout>