@extends('layouts.app')

@section('content')
<div>
    @if(isset($error))
        {{ $error.error }}
    @endif
</div>
<div id="login-page" class="row">
    <div class="col offset-s3 s6 z-depth-4 card-panel">
        <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col s12 center">
                    <img alt="" class="circle responsive-img valign profile-image-login">
                    <p class="center login-form-text">News Randomizer: Login</p>
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="input-field col s12">
                    <input name="email" id="email" type="text">
                    <label for="email">Email Address</label>
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="input-field col s12">
                    <input id="password" type="password" class="form-control" name="password" required>
                    <label for="password">Password</label>
                </div>
            </div>

            <div class="row">          
                <div class="input-field col s12 m12 l12  login-text">
                    <input type="checkbox" id="remember-me" name="remember">
                    <label for="remember-me">Remember me</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <button type="submit" class="btn waves-effect waves-light col s12">Login</button>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 m6 l6">
                    <p class="margin medium-small"><a href="{{ route('register') }}">Register Now!</a></p>
                </div>
                <div class="input-field col s6 m6 l6">
                    <p class="margin right-align medium-small"><a href="{{ route('password.request') }}">Forgot password ?</a></p>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
