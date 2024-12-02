<x-guest-layout>
    <div style="margin-top: 144px;">
        <section class="page-header">
            <div class="container-fluid">
                <div class="page-header__inner">
                    <div class="page-header__bg" style="background-image: url('images/backgrounds/page-header-bg.jpg');"></div><!-- /.page-header__bg -->
                    <div class="container">
                        <div class="page-header__content">
                            <h2 class="page-header__title">Contact Us</h2>
                            <ul class="mediox-breadcrumb list-unstyled">
                                <li>
                                    <span class="mediox-breadcrumb__icon"><i class="icon-home"></i></span>
                                    <a href="{{route('index')}}">Home</a>
                                </li>
                                <li><span>Contact Us</span></li>
                            </ul><!-- /.mediox-breadcrumb list-unstyled -->
                        </div><!-- /.page-header__content -->
                    </div><!-- /.container -->
                </div><!-- /.page-header__inner -->
            </div><!-- /.container-fluid -->
        </section><!-- /.page-header -->

        <section class="contact-page section-space-top">
            <div class="contact-page__inner section-space">
                <div class="container">
                    <div class="row gutter-y-40 align-items-center">
                        <div class="col-xl-7 col-lg-6 order-1 order-lg-0 wow fadeInUp" data-wow-duration="1500ms">
                            <div class="contact-page__form">
                                <form class="contact-form-validated form-one" method="post" id="queryForm" data-wow-duration="1500ms">
                                    @csrf
                                    <div class="form-one__group">
                                        <div class="form-one__control form-one__control--full">
                                            <input type="text" name="name" placeholder="Full Name" required>
                                        </div><!-- /.form-one__control -->
                                        <div class="form-one__control form-one__control--full">
                                            <input type="email" name="email" placeholder="Email Address" required>
                                        </div><!-- /.form-one__control -->
                                        <div class="form-one__control form-one__control--full">
                                            <input type="tel" name="phone_number" placeholder="Phone Number" Maxlength="10" required>
                                        </div><!-- /.form-one__control -->
                                        <div class="form-one__control form-one__control--full">
                                            <textarea name="message" placeholder="Write Message . . ." required></textarea>
                                        </div><!-- /.form-one__control -->
                                        <div class="form-one__control form-one__control--full">
                                            <button type="submit" class="mediox-btn">
                                                <span>send message</span>
                                                <span class="mediox-btn__icon"><i class="icon-up-right-arrow"></i></span>
                                            </button>
                                            <!-- /.mediox-btn -->
                                        </div><!-- /.form-one__control -->
                                    </div><!-- /.form-one__group -->
                                </form><!-- /.form-one -->
                                <div class="result"></div><!-- /.result -->
                            </div><!-- /.contact-page__form -->
                        </div><!-- /.col-xl-7 col-lg-6 -->
                        <div class="col-xl-5 col-lg-6 order-0 order-lg-1">
                            <div class="contact-page__info">
                                <div class="sec-title @@extraClassName wow fadeInUp" data-wow-duration="1500ms">
                                    <div class="sec-title__top">

                                        <img src="{{asset('images/shapes/sec-title-s-1-1.png')}}" alt="contact us" class="sec-title__img">


                                        <h6 class="sec-title__tagline">contact us</h6><!-- /.sec-title__tagline -->

                                    </div><!-- /.sec-title__top -->
                                    <h3 class="sec-title__title">Just Say <span>Hello!</span></h3><!-- /.sec-title__title -->
                                </div><!-- /.sec-title -->
                                <div class="contact-page__info__inner wow fadeInUp" data-wow-duration="1500ms">
                                    <div class="contact-page__info__item">
                                        <span class="contact-page__info__icon">
                                            <i class="icon-telephone-2"></i>
                                        </span><!-- /.contact-page__info__icon -->
                                        <div class="contact-page__info__content">
                                            <h4 class="contact-page__info__title">call now</h4>
                                            <!-- /.contact-page__info__title -->
                                            <a href="tel:+91918638184447" class="contact-page__info__link">+91 918638184447</a>
                                            <!-- /.contact-page__info__link -->
                                        </div><!-- /.contact-page__info__content -->
                                    </div><!-- /.contact-page__info__item -->
                                    <div class="contact-page__info__item">
                                        <span class="contact-page__info__icon">
                                            <i class="icon-paper-plane"></i>
                                        </span><!-- /.contact-page__info__icon -->
                                        <div class="contact-page__info__content">
                                            <h4 class="contact-page__info__title">email</h4>
                                            <!-- /.contact-page__info__title -->
                                            <a href="mailto:nidaanmedicalstore@gmail.com" class="contact-page__info__link">nidaanmedicalstore@gmail.com</a>
                                            <!-- /.contact-page__info__link -->
                                        </div><!-- /.contact-page__info__content -->
                                    </div><!-- /.contact-page__info__item -->
                                    <div class="contact-page__info__item">
                                        <span class="contact-page__info__icon">
                                            <i class="icon-location"></i>
                                        </span><!-- /.contact-page__info__icon -->
                                        <div class="contact-page__info__content">
                                            <h4 class="contact-page__info__title">address</h4>
                                            <!-- /.contact-page__info__title -->
                                            <a href="https://www.google.com/maps" class="contact-page__info__link">ANU BHABAN COMPLEX, GANAKPATTY GOHAIN GAON
                                                <span>NEAR PHUKAN NAGAR WATER SUPPLY</span>
                                                <span>SIVASAGAR, 785640</span>
                                            </a><!-- /.contact-page__info__link -->
                                        </div><!-- /.contact-page__info__content -->
                                    </div><!-- /.contact-page__info__item -->
                                </div><!-- /.contact-page__info__inner -->
                            </div><!-- /.contact-page__info -->
                        </div><!-- /.col-xl-5 col-lg-6 -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
                <img src="{{asset('images/shapes/contact-shape-1-1.png')}}" alt="shape" class="contact-page__shape">
            </div><!-- /.contact-page__inner section-space -->
        </section><!-- /.contact-page section-space-top -->

        <section class="contact-map">
            <div class="container-fluid">
                <div class="google-map google-map__contact">
                    <iframe title="template google map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4562.753041141002!2d-118.80123790098536!3d34.152323469614075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80e82469c2162619%3A0xba03efb7998eef6d!2sCostco+Wholesale!5e0!3m2!1sbn!2sbd!4v1562518641290!5m2!1sbn!2sbd" class="map__contact" allowfullscreen></iframe>
                </div>
                <!-- /.google-map -->
            </div><!-- /.container-fluid -->
        </section><!-- /.contact-map -->
    </div>
</x-guest-layout>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#queryForm').submit(function(e) {
            e.preventDefault(); 
            
            var formData = $(this).serialize();

            $.ajax({
                url: "{{ route('customerQuery') }}",
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.status == 'success') {
                        $('#queryForm :input').attr('disabled', 'disabled');
                        Swal.fire({
                            title: "Thank You!",
                            text: response.message,
                            icon: "success"
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: "Validation Fail!",
                        text: "Please Enter Correct Data",
                        icon: "error"
                    });
                }
            });
        });
    });
</script>