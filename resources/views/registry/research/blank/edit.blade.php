@extends('layouts.master')

@section('page_title', 'Редактирование "'.$patient_research->research->name.'" - '.$patient->getFio().' | <small>Дата рождения: '.$patient->birth_date.'</small>')

<!-- Top Bar Nav-->
@section('top_page_nav')
<ul class="nav navbar-nav top_page_nav">
    <li>
        <a href="#" id="save_research" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="bottom" title="Сохранить исследование" data-original-title="Сохранить исследование">
            <i class="material-icons">done</i>
        </a>
    </li>
    <li>
        <a href="#" id="save_print_research" class="btn bg-deep-orange btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="bottom" title="Печать исследования" data-original-title="Печать исследования">
            <i class="material-icons">print</i>
        </a>
    </li>
    <li>
        <a href="{{ route('registry.patients.research.list', ['patient_id'=>$patient->id]) }}" class="btn btn-danger btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="bottom" title="Назад" data-original-title="Назад">
            <i class="material-icons">reply</i>
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
@include('partials.errors')

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{ mb_strtoupper($patient_research->research->name) }} №{{ $patient_research->id }} от {{$patient_research->create_date}}
                    </h2>
                </div>
                <div class="body">
                    {!! Form::open(['id'=>'patient_research_form', 'name'=> 'patient_research_form', 'method'=>'POST', 'route' => 'registry.patients.research.update']) !!}
                    {!! Form::hidden('patient_id', $patient->id ) !!}
                    {!! Form::hidden('research_id', $patient_research->research->id) !!}
                    {!! Form::hidden('patient_research_id', $patient_research->id) !!}
                    <div class="row clearfix">
                        <div class="col-md-6">
                             <ul class="list-group">
                                <li class="list-group-item"><b>Номер карты:</b> {{ $patient->card_number }} | <b>Дата карты:</b> {{ $patient->card_date }}</li>
                                <li class="list-group-item"><b>Пациент:</b> {{ $patient->getFio() }}</li>
                                <li class="list-group-item"><b>Пол:</b> {{ $patient->gender == 'male' ? 'Мужской':'Женский' }}</li>
                                <li class="list-group-item"><b>Дата рождения:</b> {{ $patient->birth_date }}</li>
                                <li class="list-group-item"><b>Телефон:</b> {{ $patient->phone }}</li>
                                <li class="list-group-item"><b>Электронная почта:</b> {{ $patient->email }}</li>
                                <li class="list-group-item"><b>Дополнительные сведения:</b><br> {{ $patient->more_inform }}</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group">
                                <li class="list-group-item"><b>Место забора анализа:</b> {{ Form::select('unit_id', App\Unit::getArray(), $patient_research->unit_id, ['data-width'=>'50%', 'class' => 'form-control show-tick', 'data-live-search' => 'true']) }}</li>
                                <li class="list-group-item"><b>Врач:</b> {{ Form::select('doctor_id', App\User::getArray(true), $patient_research->doctor->id, ['data-width'=>'50%', 'class' => 'form-control show-tick', 'data-live-search' => 'true']) }}</li>
                                <li class="list-group-item"><b>Дата исследования:</b> <input type="text" name="create_date" class="datepicker no-border" value="{{$patient_research->create_date}}"></li>
                                <li class="list-group-item">
                                    <b>Выдан:</b>
                                    <div class="switch" style="display: inline-block;">
                                        <label><input type="checkbox" name="status" {{$patient_research->status ? 'checked' : ''}}><span class="lever switch-col-green"></span></label>
                                        <input type="text" name="issue_date" class="datepicker no-border" placeholder="Дата выдачи" value="{{$patient_research->issue_date}}">
                                    </div>
                                 </li>
                                 <li class="list-group-item"><b>Комментарии:</b><br> {{ Form::textarea('comment', $patient_research->comment, ['class'=> 'form-control' , 'rows'=>'2']) }}</li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th width="30%">НАИМЕНОВАНИЕ ИССЛЕДОВАНИЯ</th>
                                <th width="15%">РЕЗУЛЬТАТ</th>
                                <th width="15%">ЕД. ИЗМ.</th>
                                <th width="30%">РЕФЕР. ЗНАЧЕНИЯ</th>
                                <th width="10%">ПЛАТНЫЕ</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($patient_research->results as $result)
                            <tr>
                                <td>{{ $result->analysis->name }}</td>
                                <td>
                                    <input name="analyzes[{{ $result->id }}]" value="{{ $result->result }}" id="analysis_{{ $result->analysis->id }}" type="text" class="form-control" placeholder="Введите результат">
                                </td>
                                <td>{{ $result->analysis->unit }}</td>
                                <td>{{ $result->analysis->r_range }}</td>
                                <td>
                                    <div class="switch" style="display: inline-block;">
                                        <label><input type="checkbox" name="pay[{{ $result->id }}]" {{$result->pay ? 'checked' : ''}}><span class="lever switch-col-green"></span></label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    {{ csrf_field() }}
@endsection

@section('js')
<script>
$(function() {
    // Клик по кнопке Печать исследования
    $('#save_print_research').on('click', function(e){
        // Инициализация переменных
        var patient_research_id = '{{ $patient_research->id }}';
        var print_href = '{{ route('print.research') }}/' + patient_research_id;
        console.log(print_href);
        // Переход на страницу печати
        //location.href = print_href;
        window.open(print_href);
    });
    // Клик по кнопке сохранить исследование
    $('#save_research').on('click', function(e){
        $('#patient_research_form').submit();
    });

    // Set Datepicker
    $(".datepicker").datepick({dateFormat: 'dd.mm.yyyy'});
    // Date
    $(".datepicker").inputmask('d.m.y');

    //================== ФУНКЦИИ ===================

});
</script>
@endsection
