<x-guest-layout>
    <section class="services-section fix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div style="margin-top: 150px;">
                        <h2>Admin Login</h2>
                    </div>
                </div>
                <div class="col-12">
                    <div class="login-wrapper mt-5" style="margin-bottom: 100px;">
                        <div class="logo">
                            <div class="logo__circle">
                                <img class="logo__svg" src="{{asset('images/logo-dark.png')}}" alt="Logo">
                            </div>
                        </div>
                        <form  method="post" action="{{ route('login') }}">
                            @csrf
                                <div class="form-one__control">
                                    <div class="form__icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M5 5a5 5 0 0 1 10 0v2A5 5 0 0 1 5 7V5zM0 16.68A19.9 19.9 0 0 1 10 14c3.64 0 7.06.97 10 2.68V20H0v-3.32z"/></svg>
                                    </div>
                                    <input class="form-control" type="email" name="email" :value="old('email')"
                                        required autofocus autocomplete="User-ID" />
                                </div>

                                <div class="form-one__control">
                                    <div class="form__icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z"/></svg>
                                    </div>
                                    <input class="form-control" type="password" name="password" required
                                        autocomplete="current-password" />
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
