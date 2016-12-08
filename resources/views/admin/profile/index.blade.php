@extends('layouts.master')
@section('page_title', 'Профиль')
@section('css')
<!-- some CSS styling changes and overrides -->
<style>
.kv-avatar .file-preview-frame,.kv-avatar .file-preview-frame:hover {
    margin: 0;
    padding: 0;
    border: none;
    box-shadow: none;
    text-align: center;
}
.kv-avatar .file-input {
    display: table-cell;
    max-width: 220px;
}

.kv-avatar .remove-avatar {
  width: 100%;
}

.kv-avatar .file-thumbnail-footer {
  display: none;
}

.kv-avatar .file-preview {
  width: 163px;
}


</style>
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
    {!! Form::model($profile, ['route' => ['profile'], 'id'=>'profile_form', 'files' => true])!!}

    <div class="card">
      <div class="header">
        <h2>
        ПРОФИЛЬ
        <small>Ваши персональные данные</small>
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
        <h2 class="card-inside-title">Общая информация</h2>
        <hr>
        <div class="row clearfix">
        <div class="col-sm-9">
          <div class="row clearfix">
            <div class="col-sm-4">
              <b>Фамилия</b>
              <div class="form-group">
                <div class="form-line {{ $errors->has('last_name') ? ' error' : '' }}">
                  {{ Form::text('last_name', null,['class'=>'form-control' , 'placeholder' => 'Иванов' ]) }}
                </div>
                @if ($errors->has('last_name'))
                    <label id="last_name-error" class="error" for="last_name">{{ $errors->first('last_name') }}</label>
                @endif
              </div>
            </div>

            <div class="col-sm-4">
              <b>Имя</b>
              <div class="form-group">
                <div class="form-line {{ $errors->has('first_name') ? ' error' : '' }}">
                  {{ Form::text('first_name', null,['class'=>'form-control' , 'placeholder' => 'Иван' ]) }}
                </div>
                @if ($errors->has('first_name'))
                    <label id="first_name-error" class="error" for="first_name">{{ $errors->first('first_name') }}</label>
                @endif
              </div>
            </div>
            <div class="col-sm-4">
              <b>Отчество</b>
              <div class="form-group">
                <div class="form-line {{ $errors->has('second_name') ? ' error' : '' }}">
                  {{ Form::text('second_name', null,['class'=>'form-control' , 'placeholder' => 'Иванович' ]) }}
                </div>
                @if ($errors->has('second_name'))
                    <label id="second_name-error" class="error" for="second_name">{{ $errors->first('second_name') }}</label>
                @endif
              </div>
            </div>
          </div>
          <div class="row clearfix">
            <div class="col-sm-6">
              <b>Телефон</b>
              <div class="form-group">
                <div class="form-line {{ $errors->has('phone') ? ' error' : '' }}">
                  {{ Form::text('phone', null,['class'=>'form-control' , 'placeholder' => '8 (xxx) xxx xxxx' ]) }}
                </div>
                @if ($errors->has('phone'))
                  <label id="phone-error" class="error" for="phone">{{ $errors->first('phone') }}</label>
                @endif
              </div>
            </div>
            <div class="col-sm-6">
              <b>Электронная почта</b>
              <div class="form-group">
                <div class="form-line {{ $errors->has('email') ? ' error' : '' }}">
                  {{ Form::text('email', null,['class'=>'form-control' , 'placeholder' => 'email@domain.ru' ]) }}
                </div>
                @if ($errors->has('email'))
                  <label id="email-error" class="error" for="email">{{ $errors->first('email') }}</label>
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="row">
            <div class="col-sm-12">
              {{-- <div class="image text-center">
                <a href="#">
                    <img src="{{ URL::asset('images/avatars/'.Auth::user()->profile->avatar) }}" width="150" alt="User" />
                </a>
              </div>  --}}
              <!-- the avatar markup -->
              <div id="kv-avatar-errors-2" class="center-block" style="width:800px;display:none"></div>
              {{-- <form class="text-center" action="/avatar_upload.php" method="post" enctype="multipart/form-data"> --}}
                  <div class="kv-avatar center-block" style="width:200px">
                      <input id="user-avatar" name="avatar" type="file" class="file-loading">
                  </div>
                  <!-- include other inputs if needed and include a form submit (save) button -->
              {{-- </form> --}}
            </div>
          </div>
        </div>
        </div>

        <div class="row clearfix">
          <div class="col-sm-12">
            <b>Адрес</b>
            <div class="form-group">
              <div class="form-line {{ $errors->has('address') ? ' error' : '' }}">
                {{ Form::text('address', null,['class'=>'form-control' , 'placeholder' => 'Адрес' ]) }}
              </div>
              @if ($errors->has('address'))
                  <label id="address-error" class="error" for="address">{{ $errors->first('address') }}</label>
              @endif
            </div>
          </div>
        </div>
        <div class="row clearfix">
          <div class="col-sm-12">
            <b>Тип пользователя</b>
            <p>{{ $user->role->description }}</p>
            {{-- {{ Form::select('user_type_id', $user_types, $user->role->id, ['class' => 'form-control show-tick', 'data-live-search' => 'true']) }} --}}
            {{-- @if ($errors->has('specialty_id'))
              <label id="specialty_id-error" class="error" for="specialty_id">{{ $errors->first('specialty_id') }}</label>
            @endif --}}

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
  <script type="text/javascript">
    $(document).ready(function(){
      $("#user-avatar").fileinput({
          overwriteInitial: true,
          'language': 'ru',
          maxFileSize: 1500,
          showClose: false,
          showCaption: false,
          showBrowse: false,
          browseOnZoneClick: true,
          removeLabel: '',
          removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
          removeClass: 'remove-avatar',
          removeTitle: 'Cбросить изменения',
          elErrorContainer: '#kv-avatar-errors-2',
          msgErrorClass: 'alert alert-block alert-danger',
          defaultPreviewContent: '<img src="{{ URL::asset('images/avatars/'.(isset(Auth::user()->profile->avatar) ? Auth::user()->profile->avatar : 'default_user.jpg' )) }}" alt="ФОТО" style="width:150px">',
          layoutTemplates: {main2: '{preview} {remove}'},
          allowedFileExtensions: ["jpg", "png", "gif"]
      });
    });
  </script>
@endsection