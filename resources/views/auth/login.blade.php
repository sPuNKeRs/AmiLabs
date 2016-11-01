@extends('layouts.master')

@section('page-class', 'login-page')

@section('content')
<!-- login form -->
<div class="login-box">
    <div class="logo">
        <a href="javascript:void(0);">Ami<b>LABS</b></a>
        <small>Лабораторная информация система</small>
    </div>
    <div class="card">
        <div class="body">
            <form id="sign_in" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}
                <div class="msg">Авторизируйтесь для начала работы</div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line {{ $errors->has('email') ? 'error' : '' }}">
                        <input type="text" class="form-control" name="email" placeholder="Логин" value="{{ old('email') }}" required autofocus>
                    </div>
                    @if ($errors->has('email'))
                        <label id="email-error" class="error" for="username">{{ $errors->first('email') }}</label>
                    @endif
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line {{ $errors->has('password') ? 'error' : '' }}">
                        <input type="password" class="form-control" name="password" placeholder="Пароль" value="{{ old('password') }}" required>
                    </div>
                     @if ($errors->has('password'))
                        <label id="password-error" class="error" for="password">{{ $errors->first('password') }}</label>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-8 p-t-5">
                        <input type="checkbox" name="remember" id="rememberme" class="filled-in chk-col-pink">
                        <label for="rememberme">Запомнить меня</label>
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-block bg-pink waves-effect" type="submit">ВХОД</button>
                    </div>
                </div>
                <div class="row m-t-15 m-b--20">
                    <div class="col-xs-6">
                        <a href="{{ url('/register') }}">Регистрация</a>
                    </div>
                    <div class="col-xs-6 align-right">
                        <a href="{{ url('/password/reset') }}">Забыли пароль?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- #login form -->
@endsection
