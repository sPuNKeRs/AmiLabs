@extends('layouts.master')
@section('page_title', 'Настройки')
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
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>
        НАСТРОЙКИ
        <small>Общие настройки системы</small>
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
        <h2 class="card-inside-title">Информация об организации</h2>
        <hr>
        <div class="row clearfix">
          <div class="col-sm-12">
            <b>Наименование организации</b>
            <div class="form-group">
              <div class="form-line">
                <input type="text" class="form-control" placeholder="Наименование организации">
              </div>
            </div>
            <b>Адрес организации</b>
            <div class="form-group">
              <div class="form-line">
                <input type="text" class="form-control" placeholder="Адрес организации">
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <b>Телефон</b>
                <div class="form-group">
                  <div class="form-line">
                    <input type="text" class="form-control" placeholder="8 (xxx) xxx xxxx">
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <b>Электронная почта</b>
                <div class="form-group">
                  <div class="form-line">
                    <input type="text" class="form-control" placeholder="email@domain.ru">
                  </div>
                </div>
              </div>
            </div>
            <b>Заведующий КДЛ</b>            
            <select class="form-control show-tick" data-live-search="true" tabindex="-98">
              <option>Иванов И. И.</option>
              <option>Петров П. П.</option>
            </select>
            <button type="button" class="btn btn-primary m-t-15 waves-effect">СОХРАНИТЬ</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<!-- Select Plugin Js -->
<script src="{{ URL::asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
@endsection