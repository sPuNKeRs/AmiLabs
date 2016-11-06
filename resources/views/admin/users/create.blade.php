@extends('layouts.master')
@section('page_title', 'Создать пользователя')
@section('css')
<!-- Bootstrap Select Css -->
<link href="{{ URL::asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endsection
@section('body')
<!-- Search Bar -->
@include('partials.search-bar')
<!-- #END# Search Bar -->
<!-- Top Bar -->
@include('partials.top-bar')
<!-- #Top Bar -->
@endsection
<!-- Menu -->
@section('left_menu')
@include('partials.left-sidebar.menu', ['menu' => $menu_admin->roots()])
@endsection
<!-- #Menu -->
@section('sidebars')
@include('partials.left-sidebar')
@endsection
@section('content')
<div class="row clearfix">
  <form id="sign_in" role="form" method="POST" action="{{ route('users.create') }}">
    {{ csrf_field() }}
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
        <div class="header">
          <h2>
          СОЗДАНИЕ ПОЛЬЗОВАТЕЛЯ
          </h2>
          <ul class="header-dropdown m-r--5">
            <li class="dropdown">
              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="material-icons">more_vert</i>
              </a>
              <ul class="dropdown-menu pull-right">
                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Сохранить</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <div class="body">
          <h2 class="card-inside-title">Информация о пользователе</h2>
          <hr>
          <div class="row clearfix">
            <div class="col-sm-12">
              <b>ФИО</b>
              <div class="form-group">
                <div class="form-line {{ $errors->has('name') ? ' error' : '' }}">
                  <input type="text" class="form-control" placeholder="Фамилия Имя Отчество" name="name" value="{{old('name')}}">
                </div>
                @if ($errors->has('name'))
                  <label id="name-error" class="error" for="name">{{ $errors->first('name') }}</label>
                @endif
              </div>
              <b>Электронный адрес</b>
              <div class="form-group">
                <div class="form-line {{ $errors->has('email') ? ' error' : '' }}">
                  <input type="text" class="form-control" placeholder="email@domain.ru" name="email" value="{{old('email')}}">
                </div>
                @if ($errors->has('email'))
                  <label id="email-error" class="error" for="email">{{ $errors->first('email') }}</label>
                @endif
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <b>Пароль</b>
                  <div class="form-group">
                    <div class="form-line {{ $errors->has('password') ? ' error' : '' }}">
                      <input type="password" class="form-control" placeholder="Пароль" name="password">
                    </div>
                    @if ($errors->has('password'))
                      <label id="password-error" class="error" for="password">{{ $errors->first('password') }}</label>
                    @endif
                  </div>
                </div>
                <div class="col-sm-6">
                  <b>Повторить пароль</b>
                  <div class="form-group">
                    <div class="form-line {{ $errors->has('password_confirmation') ? ' error' : '' }}">
                      <input type="password" class="form-control" placeholder="Повторите пароль" name="password_confirmation">
                    </div>
                    @if ($errors->has('password_confirmation'))
                      <label id="password_confirmation-error" class="error" for="password_confirmation">{{ $errors->first('password_confirmation') }}</label>
                    @endif
                  </div>
                </div>
              </div>
              <b>Тип пользователя</b>
              <select class="form-control show-tick" data-live-search="true" name="user_type_id" value="{{ old('user_type_id') }}">
                <option value="1" {{(old('user_type_id') == 1) ? '"selected"="selected"' : ''}}>Регистратор</option>
                <option value="2" {{(old('user_type_id') == 2) ? '"selected"="selected"' : ''}}>Администратор</option>
              </select>
              @if ($errors->has('user_type_id'))
                <label id="user_type_id-error" class="error" for="password_confirmation">{{ $errors->first('user_type_id') }}</label>
              @endif

              <button type="submit" class="btn btn-primary m-t-15 waves-effect">СОХРАНИТЬ</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection
@section('js')
<!-- Select Plugin Js -->
<script src="{{ URL::asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
@endsection