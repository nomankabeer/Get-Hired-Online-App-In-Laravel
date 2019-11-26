@extends('layouts.app')
@section('content')
    @include('partials.flash_message')
<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <h1>Create Account</h1>
            <div class="social-container">
                <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <span>or use your email for registration</span>

            <input id="name" type="text" class=" @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name" />
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <input id="email" type="email" class=" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" >

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
             </span>
            @enderror

            <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password" />
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input id="password-confirm" type="password" class="" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">

            <div class="" style="display: inline-flex">
                <span class="col-sm">
                    Freelancer<input id="" type="radio" class="" name="role_id" value="2">
                </span>
                <span class="sol-sm">
                    Client<input id="" type="radio" class="" name="role_id" value="3">
                </span>
            </div>

            <button>Sign Up</button>
        </form>
    </div>
    <div class="form-container sign-in-container">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h1>Sign in</h1>
            <div class="social-container">
                <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <span>or use your account</span>
            <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus  placeholder="Email" />
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password" />
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <a href="#" class="forgot-password">Forgot your password?</a>
            <button>Sign In</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Welcome Back!</h1>
                <p>To keep connected with us please login with your personal info</p>
                <button class="ghost" id="signIn">Sign In</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Hello, Friend!</h1>
                <p>Enter your personal details and start journey with us</p>
                <button class="ghost" id="signUp">Sign Up</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');
    signUpButton.addEventListener('click', () => container.classList.add('right-panel-active'));
    signInButton.addEventListener('click', () => container.classList.remove('right-panel-active'));
</script>
@endsection