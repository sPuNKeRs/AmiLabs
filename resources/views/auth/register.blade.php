@extends('layouts.master')

@section('page_title', 'Регистрация в системе')

@section('page-class', 'signup-page ls-closed')

@section('content')
<div class="signup-box">
    <div class="logo">
        <a href="javascript:void(0);">Ami<b>LABS</b></a>
        <small>Лабораторная информация система</small>
    </div>
    <div class="card">
        <div class="body">
            <form id="sign_up" role="form" method="POST" action="{{ url('/register') }}" novalidate="novalidate">
                {{ csrf_field() }}
                <div class="msg">Форма регистрации</div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line {{ $errors->has('name') ? ' error' : '' }}">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Имя" required="" autofocus="" aria-required="true">
                    </div>
                    @if ($errors->has('name'))
                        <label id="name-error" class="error" for="name">{{ $errors->first('name') }}</label>
                    @endif
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">email</i>
                    </span>
                    <div class="form-line {{ $errors->has('email') ? ' error' : '' }}">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Электронная почта" required="" aria-required="true">
                    </div>
                    @if ($errors->has('email'))
                        <label id="email-error" class="error" for="email">{{ $errors->first('email') }}</label>
                    @endif
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line {{ $errors->has('password') ? ' error' : '' }}">
                        <input type="password" class="form-control" name="password" minlength="6" placeholder="Пароль" required="" aria-required="true">
                    </div>
                    @if ($errors->has('password'))
                        <label id="password-error" class="error" for="password">{{ $errors->first('password') }}</label>                    
                    @endif
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line {{ $errors->has('password_confirmation') ? ' error' : '' }}">
                        <input type="password" class="form-control" name="password_confirmation" minlength="6" placeholder="Повторите пароль" required="" aria-required="true">
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <label id="password_confirmation-error" class="error" for="password_confirmation">{{ $errors->first('password_confirmation') }}</label>                    
                    @endif
                </div>
                
                <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">РЕГИСТРАЦИЯ</button>
                <div class="m-t-25 m-b--5 align-center">
                    <a href="{{ route('login') }}">Вы уже зарегистрированы?</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection