<!DOCTYPE html>
<html lang="en-gb" dir="ltr">

<meta http-equiv="content-type" content="text/html;charset=utf-8"/>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Register Page </title>
    <link rel="icon" type="image/png" href="{{ URL::asset('images/logo-icon.png')}}">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Leckerli+One&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('css/main2.css')}}"/>
    <script src="{{ asset('js/uikit.js') }}"></script>
</head>

<body>

<div class="uk-grid-collapse" data-uk-grid>
    <div class="uk-width-1-2@m uk-padding-large uk-flex uk-flex-middle uk-flex-center">
        <div class="uk-width-3-4@s">
            <div class="uk-text-center uk-margin-bottom">
                <a class="uk-logo uk-text-primary uk-text-bold" href="#">
                    <img src="{{ URL::asset('images/logo.png')}}" style="max-width: 150px;" alt="Taste & Chef">
                </a>
            </div>
            <div class="uk-text-center uk-margin-medium-bottom">
                <h1 class="uk-h2 uk-letter-spacing-small">Create an Account</h1>
            </div>

            <form class="uk-text-center" method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="uk-width-1-1 uk-margin">
                    <input id="name" name="full_name" class="uk-input uk-form-large uk-border-pill uk-text-center"
                           type="text" placeholder="Full Name" value="{{ old('full_name') }}" required autofocus autocomplete="name">
                    <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="uk-width-1-1 uk-margin">
                    <input id="email" name="email" class="uk-input uk-form-large uk-border-pill uk-text-center"
                           type="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Phone Number -->
                <div class="uk-width-1-1 uk-margin">
                    <input id="phone_number" name="phone_number" class="uk-input uk-form-large uk-border-pill uk-text-center"
                           type="tel" placeholder="Phone Number" value="{{ old('phone_number') }}" required>
                    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="uk-width-1-1 uk-margin">
                    <input id="password" name="password" class="uk-input uk-form-large uk-border-pill uk-text-center"
                           type="password" placeholder="Password" required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="uk-width-1-1 uk-margin">
                    <input id="password_confirmation" name="password_confirmation" class="uk-input uk-form-large uk-border-pill uk-text-center"
                           type="password" placeholder="Confirm Password" required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="uk-width-1-1 uk-text-center">
                    <button class="uk-button uk-button-primary uk-button-large">Sign Up</button>
                </div>
            </form>
        </div>
    </div>
    <div class="uk-width-1-2@m uk-padding-large uk-flex uk-flex-middle uk-flex-center uk-light data-uk-height-viewport">
        <div class="uk-background-cover uk-background-norepeat uk-background-blend-overlay uk-background-overlay
      uk-border-rounded-large uk-width-1-1 uk-height-xlarge uk-flex uk-flex-middle uk-flex-center"
             style="background-image: url(https://source.unsplash.com/2wq0ReWAM8I/600x600);">
            <div class="uk-padding-large">
                <div class="uk-text-center">
                    <h2 class="uk-letter-spacing-small">Welcome Back</h2>
                </div>
                <div class="uk-margin-top uk-margin-medium-bottom uk-text-center">
                    <p>Already signed up, enter your details and start cooking your first meal today</p>
                </div>
                <div class="uk-width-1-1 uk-text-center">
                    <a href="{{ route('login') }}" class="uk-button uk-button-primary uk-button-large">Sign In</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>



