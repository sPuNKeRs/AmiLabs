@extends('layouts.notop-master')

@section('page_title', 'Восстановление пароля')
@section('page-class', 'fp-page ls-closed')

@section('content')
    <div class="fp-box">
        <div class="logo">
            <a href="javascript:void(0);">Ami<b>LABS</b></a>
            <small>Лабораторная информация система</small>
        </div>
         @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="card">
            <div class="body">
                <form id="forgot_password" role="form" method="POST" action="{{ url('/password/email') }}" novalidate="novalidate">
                {{ csrf_field() }}
                    <div class="msg">
                        Введите свой адрес электронной почты, который вы использовали при регистрации. Вам на электронную почту будет отправленно сообщения для сброса пароля.                        
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" placeholder="Электронная почта" required="" autofocus="" aria-required="true">
                        </div>
                    </div>

                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">СБРОСИТЬ ПАРОЛЬ</button>

                    <div class="row m-t-20 m-b--5 align-center">
                        <a href="{{ route('login') }}">Авторизация!</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
