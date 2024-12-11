<x-guest-layout>
    <div style="margin-top: 144px;">
        <section class="page-header">
            <div class="container-fluid">
                <div class="page-header__inner">
                    <div class="page-header__bg" style="background-image: url({{ asset('images/backgrounds/page-header-bg.jpg' )}});"></div><!-- /.page-header__bg -->
                    <div class="container">
                        <div class="page-header__content">
                            <h2 class="page-header__title">Teams</h2>
                            <ul class="mediox-breadcrumb list-unstyled">
                                <li>
                                    <span class="mediox-breadcrumb__icon"><i class="icon-home"></i></span>
                                    <a href="{{route('index')}}">Home</a>
                                </li>
                                <li><span>Teams</span></li>
                            </ul><!-- /.mediox-breadcrumb list-unstyled -->
                        </div><!-- /.page-header__content -->
                    </div><!-- /.container -->
                </div><!-- /.page-header__inner -->
            </div><!-- /.container-fluid -->
        </section><!-- /.page-header -->

        <section class="team-page team-page--two section-space">
            <div class="container">
                <div class="row gutter-y-30">
                    @foreach ($speciaLists as $row)
                    <div class="col-lg-4 col-md-6">
                        <div class="team-card wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='000ms'>
                            <img src="{{ env('IMAGE_PATH').Storage::url($row->doctor_image)}}" alt="{{ $row->doctor_name }}" class="team-card__image">
                            <div class="team-card__identity">
                                <h3 class="team-card__name"><a href="{{url('/team-details')}}/{{ $row->id}}">{{ $row->doctor_name }}</a></h3>
                                <p class="team-card__designation">
                                <p>{{ \Illuminate\Support\Str::limit($row->description, $limit = 100, $end = '...') }}</p>
                                </p>
                                <div class="social-links">
                                    <a href="{{ $row->facebook_link }}" target="_blank">
                                            <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                            <span class="sr-only">Facebook</span>
                                        </a>
                                        <a href="{{ $row->instagram_link }}" target="_blank">
                                            <i class="fab fa-instagram" aria-hidden="true"></i>
                                            <span class="sr-only">Instagram</span>
                                        </a>
                                        <a href="{{ $row->twitter_link }}" target="_blank">
                                            <i class="fab fa-twitter" aria-hidden="true"></i>
                                            <span class="sr-only">Twitter</span>
                                        </a>
                                        <a href="{{ $row->linked_in_link }}" target="_blank">
                                            <i class="fab fa-linkedin-in" aria-hidden="true"></i>
                                            <span class="sr-only">Linkedin</span>
                                        </a>
                                </div><!-- /.social-links -->
                            </div><!-- /.team-card__identity -->
                        </div><!-- /.team-card -->
                    </div><!-- /.col-lg-4 col-md-6 -->
                    @endforeach

                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.team-page section-space -->
    </div>
</x-guest-layout>