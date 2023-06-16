<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body id="login">

@if (($errors->any()))
    
    @if (array_search('These credentials do not match our records.', $errors->all()) === false)
        <div class="container right-panel-active" id="container">
    @else
        <div class="container" id="container">
    @endif
@else
<div class="container" id="container">
@endif


        <!-- sign Up form section start-->
        <div class="form sign_up">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <!-- heading -->
                <h1>Create An Account</h1>
                <!-- social media icons -->
                <span>use email for registration</span>
                <!-- input fields start -->
                <input id="name" type="text" placeholder="Name" class="@error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <input id="surname" type="text" placeholder="Surname"
                    class="@error('surname') is-invalid  @enderror" name="surname" value="{{ old('surname') }}" required
                    autocomplete="surname" autofocus>
                @error('surname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <input id="birth_date" type="date" placeholder="Birth Date"
                    class="@error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}"
                     autocomplete="birth_date" autofocus>
                @error('birth_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <input id="email" type="email" placeholder="Email" class="@error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <input id="password" type="password" placeholder="Password"
                    class="@error('password') is-invalid @enderror" name="password" required
                    autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <input id="password-confirm" placeholder="Confirm Password" type="password" name="password_confirmation"
                    required autocomplete="new-password">

                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
                <!-- input fields end -->
            </form>
        </div>
        <!-- sign Up form section end-->

        <!-- sign in form section start-->
        <div class="form sign_in">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- heading -->
                <h1>Login In</h1>
                <!-- social media icons -->
                <span>Login In with your Account</span>
                <!-- input fields start -->
                <input id="email" type="email" placeholder="Email" class="@error('email') is-invalid @enderror "
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <input id="password" type="password" placeholder="Password"
                    class="@error('password') is-invalid @enderror" name="password" required
                    autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <span>Forgot your <span class="forgot">password?</span></span>

                <div class="mb-4 row align-items-center">
                    <div class="col-9">
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                    <div class="col-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                    </div>



                </div>


                <button type="submit">
                    {{ __('Login') }}
                </button>
                <!-- input fields end -->
            </form>
        </div>
        <!-- sign in form section end-->

        <!-- overlay section start-->
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-pannel overlay-left">
                    <h1>Already have an account</h1>
                    <p>Please Login</p>
                    <button id="signIn" class="overBtn">SignIn</button>
                </div>
                <div class="overlay-pannel overlay-right">
                    <h1>Create Account</h1>
                    <p>Start Your Journey with Us</p>
                    <button id="signUp" class="overBtn">Sign Up</button>
                </div>
            </div>
        </div>
        {{-- <div id="container" class="container"> --}}

        {{-- <div class="row justify-content-center w-75">
                <div class="col-md-8">
                    <div class="">
                        <div class="py-3 border-bottom my-3 text-center fs-2 fw-bold">{{ __('BoolBnB') }}</div>
        
                        <div class="card">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
        
                                <div class="d-flex flex-column align-items-center text-center">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-right fs-4 fw-bold">{{ __('Email') }}</label>
        
                                    <div class="col-md-6 pb-4 w-50">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror " name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class=" d-flex flex-column align-items-center justify-content-center text-center">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-right fs-4 fw-bold">{{ __('Password') }}</label>
        
                                    <div class="col-md-6 pb-4 w-50">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="mb-4 row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
        
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="mb-4 row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>
        
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
</body>
