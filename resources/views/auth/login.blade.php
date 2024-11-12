<x-guest-layout>
    <!--? Hero Start -->
    <div class="slider-area2 ">
        <div class="slider-height2 hero-overly d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero__caption hero__caption2">
                            <h2>Admin Login</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->
    <!-- Session Status -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="appointment-one__content">
                        <h3 class="appointment-one__title">Book An Appointment</h3><!-- /.appointment-one__title -->
                        <form class="appointment-one__form contact-form-validated form-one wow fadeInUp" data-wow-duration="1500ms" id="appointmentForm" method="post" action="{{ route('login') }}">
                            @csrf
                            <!-- Email Address -->
                                <div class="form-one__control">
                                    <input class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                </div>
                            <!-- Password -->
                                <div class="form-one__control">
                                    <input class="form-control" type="password" name="password" required autocomplete="current-password" />

                                </div>

                            <div class="flex items-center justify-end mt-4">
                                @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                                @endif

                                <button class="ms-3 btn btn-success btn-sm">
                                    {{ __('Log in') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>