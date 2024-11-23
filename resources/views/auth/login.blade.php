<!DOCTYPE html>
<html lang="en-gb" dir="ltr">

<meta http-equiv="content-type" content="text/html;charset=utf-8"/>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Login Page </title>
    <link rel="icon" type="image/png" href="{{ URL::asset('images/logo-icon.png')}}">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Leckerli+One&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('css/main2.css')}}"/>
    <script src="{{ asset('js/uikit.js') }}"></script>
</head>

<body>

<div class="uk-grid-collapse" data-uk-grid>
    <div class="uk-width-1-2@m uk-padding-large uk-flex uk-flex-middle uk-flex-center" data-uk-height-viewport>
        <div class="uk-width-3-4@s">
            <div class="uk-text-center uk-margin-bottom">
                <a class="uk-logo uk-text-primary uk-text-bold" href="#">
                    <img src="{{ URL::asset('images/logo.png')}}" style="max-width: 150px;" alt="Taste & Chef">
                </a>
            </div>
            <div class="uk-text-center uk-margin-medium-bottom">
                <h1 class="uk-h2 uk-letter-spacing-small">Sign In to Taste & Chef</h1>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')"/>

            <form class="uk-text-center" method="POST" action="{{ route('login') }}">

                @csrf

                <!-- Email Address -->
                <div class="uk-width-1-1 uk-margin">
                    <label class="uk-form-label" for="email">Email</label>
                    <input class="uk-input uk-form-large uk-border-pill uk-text-center"
                           id="email" type="email" name="email" placeholder="name@example.com"
                           :value="old('email')" required autofocus autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                </div>

                <!-- Password -->
                <div class="uk-width-1-1 uk-margin">
                    <label class="uk-form-label" for="password">Password</label>
                    <input class="uk-input uk-form-large uk-border-pill uk-text-center"
                           id="password" type="password"
                           name="password" required autocomplete="current-password"
                           placeholder="Min 8 characters">
                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                <!-- Remember Me -->
                <div class="uk-width-1-1 uk-margin uk-text-left">
                    <label for="remember_me" class="uk-form-label uk-text-left">
                        <input id="remember_me" type="checkbox"
                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                               name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="uk-width-1-1 uk-margin uk-text-center">
                    @if (Route::has('password.request'))
                        <a class="uk-text-small uk-link-muted" href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    @endif
                </div>

                <div class="uk-width-1-1 uk-text-center">
                    <button class="uk-button uk-button-primary uk-button-large">Sign In</button>
                </div>
            </form>
        </div>
    </div>
    <div class="uk-width-1-2@m uk-padding-large uk-flex uk-flex-middle uk-flex-center uk-light">
        <div class="uk-background-cover uk-background-norepeat uk-background-blend-overlay uk-background-overlay
      uk-border-rounded-large uk-width-1-1 uk-height-xlarge uk-flex uk-flex-middle uk-flex-center"
             style="background-image: url(https://source.unsplash.com/7MAjXGUmaPw/600x700);">
            <div class="uk-padding-large">
                <div class="uk-text-center">
                    <h2 class="uk-letter-spacing-small">Hello There, Join Us</h2>
                </div>
                <div class="uk-margin-top uk-margin-medium-bottom uk-text-center">
                    <p>Enter your personal details and join the cooking community</p>
                </div>
                <div class="uk-width-1-1 uk-text-center">
                    <a href="{{ route('register') }}" class="uk-button uk-button-primary uk-button-large">Sign Up</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>


