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
    <section class="services-section section-padding30 fix">
        <div class="container">
            <div class="row">
                <div class="col-12">
    
                    <form class="form-contact contact_form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- Email Address -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            </div>
                        </div>
                        <!-- Password -->
                        <div class="col-md-12">
                            <div class="form-group">        
                                <input class="form-control" type="password" name="password" required autocomplete="current-password" />
        
                            </div>
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
    </section>
</x-guest-layout>