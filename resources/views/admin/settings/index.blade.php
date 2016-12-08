@extends('layouts.master')
@section('page_title', 'Настройки')
@section('css')

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
    @if(session('status'))
      <div class="alert bg-green alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {{ session('status') }}
      </div>
    @endif
    {!! Form::model($settings, ['route' => ['settings'], 'id'=>'settings_form'])!!}

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
              <div class="form-line {{ $errors->has('company_name') ? ' error' : '' }}">
                {{ Form::text('company_name', null,['class'=>'form-control' , 'placeholder' => 'Наименование организации' ]) }}
              </div>
              @if ($errors->has('company_name'))
                  <label id="company_name-error" class="error" for="company_name">{{ $errors->first('company_name') }}</label>
              @endif
            </div>
            <b>Адрес организации</b>
            <div class="form-group">
              <div class="form-line {{ $errors->has('company_address') ? ' error' : '' }}">
                {{ Form::text('company_address', null,['class'=>'form-control' , 'placeholder' => 'Адрес организации' ]) }}
              </div>
              @if ($errors->has('company_address'))
                  <label id="company_address-error" class="error" for="company_address">{{ $errors->first('company_address') }}</label>
              @endif
            </div>
            <div class="row">
              <div class="col-sm-6">
                <b>Телефон</b>
                <div class="form-group">
                  <div class="form-line {{ $errors->has('company_phone') ? ' error' : '' }}">
                    {{ Form::text('company_phone', null,['class'=>'form-control' , 'placeholder' => '8 (xxx) xxx xxxx' ]) }}
                  </div>
                  @if ($errors->has('company_phone'))
                    <label id="company_phone-error" class="error" for="company_phone">{{ $errors->first('company_phone') }}</label>
                  @endif
                </div>
              </div>
              <div class="col-sm-6">
                <b>Электронная почта</b>
                <div class="form-group">
                  <div class="form-line {{ $errors->has('company_email') ? ' error' : '' }}">
                    {{ Form::text('company_email', null,['class'=>'form-control' , 'placeholder' => 'email@domain.ru' ]) }}
                  </div>
                  @if ($errors->has('company_email'))
                    <label id="company_email-error" class="error" for="company_email">{{ $errors->first('company_email') }}</label>
                  @endif
                </div>
              </div>
            </div>
            <b>Заведующий КДЛ</b>
            {{ Form::select('company_head_id', App\User::getArray(true), null, ['class' => 'form-control show-tick', 'data-live-search' => 'true']) }}
            @if ($errors->has('company_head_id'))
              <label id="company_head_id-error" class="error" for="company_head_id">{{ $errors->first('company_head_id') }}</label>
            @endif

            <button type="submit" class="btn btn-primary m-t-15 waves-effect">СОХРАНИТЬ</button>
          </div>
        </div>
      </div>
    {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection
@section('js')

@endsection