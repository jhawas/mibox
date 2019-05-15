@extends('admin.layouts.auth')

@section('content')
    <div class="logo">
        <h1>{{ config('app.name', 'Laravel') }}</h1>
    </div>
    <div class="login-box">
        <form class="login-form" method="POST" action="{{ route('login') }}">
        @csrf
      <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
      <div class="form-group">
        <label class="control-label">USERNAME</label>
            <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" autofocus>

            @if ($errors->has('username'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
      </div>
      <div class="form-group">
        <label class="control-label">PASSWORD</label>
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
      </div>
      <div class="form-group">
        <div class="utility">
          <div class="animated-checkbox">
            <label>
                <input class="label-text" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}><span class="label-text">Remember Me</span>
            </label>
          </div>
          <p class="semibold-text mb-2"><a href="{{ route('password.request') }}" data-toggle="flip">Forgot Password ?</a></p>
        </div>
      </div>
      <div class="form-group btn-container">
        <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
      </div>
    </form>
  </div>
@endsection
