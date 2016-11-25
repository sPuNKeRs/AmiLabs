@extends('layouts.master')

@section('page_title', 'Редактирование пациента: '.$patient->surname. ' '.$patient->firstname.' '.$patient->lastname)

<!-- Top Bar Nav-->
@section('top_page_nav')
<ul class="nav navbar-nav top_page_nav">
    <li>
        <a href="#" id="save_btn" class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Сохранить">
            <i class="material-icons">check</i>
        </a>
    </li>

   <li>
        <a href="{{ route('registry') }}" class="btn btn-danger btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="bottom" title="Отмена" data-original-title="Отмена">
            <i class="material-icons">cancel</i>
        </a>
    </li>
</ul>
@endsection
<!-- #Top Bar Nav-->

@section('body')
  <!-- Search Bar -->
  @include('partials.search-bar')
  <!-- #END# Search Bar -->
@endsection

<!-- Menu -->
@section('left_menu')
  @include('partials.left-sidebar.menu', ['menu' => $menu_main->roots()])
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
                        РЕГИСТРАЦИОННАЯ КАРТА №{{$patient->card_number}}
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Сохранить</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    {!! Form::model($patient, ['route' => 'registry.patients.save' , 'id'=>'patient_form', 'name'=> 'patient_form']) !!}
                        {!! Form::hidden('patient_id', $patient->id) !!}
                        {{-- Первая строка - начало --}}
                        <div class="row clearfix">
                            {{-- Номер карты --}}
                            <div class="col-sm-3 col-md-offset-6">
                                <b>Номер карты</b>
                                <div class="form-group">
                                    <div class="form-line {{ $errors->has('card_number') ? ' error' : '' }}">
                                        {{ Form::text('card_number', null,['class'=>'form-control']) }}
                                    </div>
                                    @if ($errors->has('card_number'))
                                        <label id="card_number-error" class="error" for="card_number">{{ $errors->first('card_number') }}</label>
                                    @endif
                                </div>
                            </div>
                            {{-- #Номер карты --}}
                            {{-- Дата создания --}}
                            <div class="col-sm-3">
                                <b>Дата создания</b>
                                <div class="form-group">
                                    <div class="form-line {{ $errors->has('card_date') ? ' error' : '' }}">
                                        {{ Form::text('card_date', null, ['class'=>'form-control datepicker']) }}
                                    </div>
                                    @if ($errors->has('card_date'))
                                        <label id="card_date-error" class="error" for="card_date">{{ $errors->first('card_date') }}</label>
                                    @endif
                                </div>
                            </div>
                            {{-- #Дата создания --}}
                        </div>
                        {{-- Первая строка - Конец --}}

                        {{-- Вторая строка - начало --}}
                        <div class="row clearfix">
                            {{-- Фамилия --}}
                            <div class="col-sm-3">
                                <b>Фамилия</b>
                                <div class="form-group">
                                    <div class="form-line {{ $errors->has('surname') ? ' error' : '' }}">
                                        {{ Form::text('surname', null,['class'=>'form-control']) }}
                                    </div>
                                    @if ($errors->has('surname'))
                                        <label id="surname-error" class="error" for="surname">{{ $errors->first('surname') }}</label>
                                    @endif
                                </div>
                            </div>
                            {{-- #Фамилия --}}

                            {{-- Имя --}}
                            <div class="col-sm-3">
                                <b>Имя</b>
                                <div class="form-group">
                                    <div class="form-line {{ $errors->has('firstname') ? ' error' : '' }}">
                                        {{ Form::text('firstname', null,['class'=>'form-control']) }}
                                    </div>
                                    @if ($errors->has('firstname'))
                                        <label id="firstname-error" class="error" for="firstname">{{ $errors->first('firstname') }}</label>
                                    @endif
                                </div>
                            </div>
                            {{-- #Имя --}}

                            {{-- Отчество --}}
                            <div class="col-sm-3">
                                <b>Отчество</b>
                                <div class="form-group">
                                    <div class="form-line {{ $errors->has('lastname') ? ' error' : '' }}">
                                        {{ Form::text('lastname', null,['class'=>'form-control']) }}
                                    </div>
                                    @if ($errors->has('lastname'))
                                        <label id="lastname-error" class="error" for="lastname">{{ $errors->first('lastname') }}</label>
                                    @endif
                                </div>
                            </div>
                            {{-- #Отчество --}}

                            {{-- Пол --}}
                            <div class="col-sm-1">
                                <b>Пол</b>
                                <div class="form-group">
                                    <div class="form-line {{ $errors->has('gender') ? ' error' : '' }}">
                                        {{ Form::select('gender', ['male'=>'М', 'female'=>'Ж'], null, ['class' => 'form-control show-tick', 'data-live-search' => 'false']) }}
                                    </div>
                                    @if ($errors->has('gender'))
                                        <label id="gender-error" class="error" for="gender">{{ $errors->first('gender') }}</label>
                                    @endif
                                </div>
                            </div>
                            {{-- #Пол --}}

                            {{-- Дата рождения --}}
                            <div class="col-sm-2">
                                <b>Дата рождения</b>
                                <div class="form-group">
                                    <div class="form-line {{ $errors->has('birth_date') ? ' error' : '' }}">
                                        {{ Form::text('birth_date', null,['class'=>'form-control datepicker']) }}
                                    </div>
                                    @if ($errors->has('birth_date'))
                                        <label id="birth_date-error" class="error" for="birth_date">{{ $errors->first('birth_date') }}</label>
                                    @endif
                                </div>
                            </div>
                            {{-- #Дата рождения --}}

                        </div>
                        {{-- Вторая строка - Конец --}}

                        {{-- Третья строка - начало --}}
                        <div class="row clearfix">
                            {{-- Адрес --}}
                            <div class="col-sm-12">
                                <b>Адрес</b>
                                <div class="form-group">
                                    <div class="form-line {{ $errors->has('address') ? ' error' : '' }}">
                                        {{ Form::text('address', null,['class'=>'form-control']) }}
                                    </div>
                                    @if ($errors->has('address'))
                                        <label id="address-error" class="error" for="address">{{ $errors->first('address') }}</label>
                                    @endif
                                </div>
                            </div>
                            {{-- #Адрес --}}
                        </div>
                        {{-- Третья строка - Конец --}}

                        {{-- Четвертая строка - начало --}}
                        <div class="row clearfix">
                            {{-- Телефон --}}
                            <div class="col-md-6">
                                <b>Телефон</b>
                                <div class="form-group">
                                    <div class="form-line {{ $errors->has('phone') ? ' error' : '' }}">
                                        {{ Form::text('phone', null,['class'=>'form-control phone-number']) }}
                                    </div>
                                    @if ($errors->has('phone'))
                                        <label id="phone-error" class="error" for="phone">{{ $errors->first('phone') }}</label>
                                    @endif
                                </div>
                            </div>
                            {{-- #Телефон --}}

                            {{-- Электронная почта --}}
                            <div class="col-md-6">
                                <b>Электронная почта</b>
                                <div class="form-group">
                                    <div class="form-line {{ $errors->has('email') ? ' error' : '' }}">
                                        {{ Form::text('email', null,['class'=>'form-control email']) }}
                                    </div>
                                    @if ($errors->has('email'))
                                        <label id="email-error" class="error" for="email">{{ $errors->first('email') }}</label>
                                    @endif
                                </div>
                            </div>
                            {{-- #Электронная почта --}}
                        </div>
                        {{-- Четвертая строка - конец --}}

                        {{-- Пятая строка - начало --}}
                        <div class="row clearfix">
                            {{-- Дополнительная информация --}}
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line {{ $errors->has('more_inform') ? ' error' : '' }}">
                                        <b>Дополнительная информация</b>
                                        {{ Form::textarea('more_inform', null,['class'=>'form-control no-resize', 'rows' => 4]) }}
                                    </div>
                                    @if ($errors->has('more_inform'))
                                        <label id="more_inform-error" class="error" for="more_inform">{{ $errors->first('more_inform') }}</label>
                                    @endif
                                </div>
                            </div>
                            {{-- #Дополнительная информация --}}
                        </div>
                        {{-- Пятая строка - конец --}}

                        {{-- Шестая строка - начало --}}
                        <div class="row clearfix">
                            <div class="col-md-3 col-md-offset-9 text-right">
                            {{-- Кнопка сохранить --}}
                            <button type="submit" class="btn btn-primary waves-effect">СОХРАНИТЬ</button>
                            {{-- #Кнопка сохранить --}}

                            {{-- Кнопка отмена --}}
                            <a href="{{ route('registry') }}" class="btn btn-danger waves-effect">ОТМЕНИТЬ</a>
                            {{-- #Кнопка отмена --}}
                            </div>
                        </div>
                        {{-- Шестая строка - конец --}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
      $('#save_btn').on('click', function(){
        $('#patient_form').submit();
      });

      $(".datepicker").datepick({dateFormat: 'dd.mm.yyyy'});

      // Date
      $(".datepicker").inputmask('d.m.y');
      //Phone Number
      $('.phone-number').inputmask('+9 (999) 999-99-99');
    });
</script>
@endsection
