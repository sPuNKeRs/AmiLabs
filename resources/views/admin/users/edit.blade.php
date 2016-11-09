@extends('layouts.master')
@section('page_title', 'Редактирование пользователя')
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
    {!! Form::model($user, ['route' => ['users.edit', $user->id], 'id'=>'user_edit_form'])!!}
    {!! Form::hidden('userid', $user->id) !!}
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
        <div class="header">
          <h2>
          РЕДАКТИРОВАНИЕ ПОЛЬЗОВАТЕЛЯ
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
                  {{ Form::text('name', null,['class'=>'form-control' , 'placeholder' => 'Иванов Иван Иванович' ]) }}
                </div>
                @if ($errors->has('name'))
                  <label id="name-error" class="error" for="name">{{ $errors->first('name') }}</label>
                @endif
              </div>
              <b>Электронный адрес</b>
              <div class="form-group">
                <div class="form-line {{ $errors->has('email') ? ' error' : '' }}">
                  {{ Form::text('email', null,['class'=>'form-control' , 'placeholder' => 'ivanov@mail.ru' ]) }}
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
                      {{ Form::password('password', ['class'=>'form-control' , 'placeholder' => 'Пароль' ]) }}
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
                      {{ Form::password('password_confirmation', ['class'=>'form-control' , 'placeholder' => 'Повтор пароля' ]) }}
                    </div>
                    @if ($errors->has('password_confirmation'))
                      <label id="password_confirmation-error" class="error" for="password_confirmation">{{ $errors->first('password_confirmation') }}</label>
                    @endif
                  </div>
                </div>
              </div>
              <b>Тип пользователя</b>
              {{ Form::select('user_type_id', ['1' => 'Регистратор', '2' => 'Администратор'], null, ['class' => 'form-control show-tick', 'data-live-search' => 'true']) }}
              @if ($errors->has('user_type_id'))
                <label id="user_type_id-error" class="error" for="password_confirmation">{{ $errors->first('user_type_id') }}</label>
              @endif
              <button type="submit" class="btn btn-primary m-t-15 waves-effect">СОХРАНИТЬ</button> <a href="{{ route('users')}}" class="btn bg-deep-orange m-t-15 waves-effect">ОТМЕНА</a>
              <a onclick="showConfirmMessage()" class="btn btn-danger m-t-15 waves-effect">УДАЛИТЬ</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  {!! Form::close()!!}
</div>
@endsection
@section('js')
  <script type="text/javascript">
    function showConfirmMessage() {
      swal({
          title: "Вы хотите удалить пользователя?",
          text: "Пользователь будет удален из системы без возможности восстановления!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Да, удалить!",
          cancelButtonText: 'Нет',
          closeOnConfirm: false
      }, function () {
          window.location.href = '{{route('users.delete', $user->id)}}';
      });
    }
  </script>
@endsection