@extends('layouts.print')

@section('head')
  <title>Печать бланка исследования</title>
  {{-- Подключаем css --}}
  <!-- Bootstrap Core Css -->
  <link href="{{ URL::asset('plugins/bootstrap/css/bootstrap-grid.min.css') }}" rel="stylesheet">
  @endsection

@section('css')
  {{-- * {
    font-family: 'dejavu sans';
  } --}}

 .print-wrap {
    width: 755px;
    height: auto;
    margin: 0 auto;
  }

 .gray-back{
    background-color: #ccc;
    border-bottom: 2px solid black;
    text-transform: uppercase;
 }

 td {
   padding: 10px;
 }

 thead tr th {
   text-align: center;
   text-transform: uppercase;
   padding: 10px;
 }
@endsection

@section('body')
  <div class="print-wrap container">

    <div class="row">
      <div class="col-md-12" style="text-align: center;">
        <strong>Управление здравоохранения администрации г. Сочи<br>
        Муниципальное бюджетное учреждение здравоохранения г. Сочи<br>
        "Городская поликлиника №1"</strong>
        <hr>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-5">
        <b>Юридический адрес:</b><br>
        354000, г. Сочи, ул. Конституции, 24<br><br>
        <b>Место забора анализа:</b><br>
        {{ $patient_research->unit->address }}

      </div>
      <div class="col-xs-3"></div>
      <div class="col-xs-4">
        <div class="row">
          <div class="col-xs-12">Телефон: {{$patient_research->patient->phone}}</div>
        </div>
        <div class="row">
          <div class="col-xs-12">Email: {{$patient_research->patient->email}}</div>
        </div>
        <div class="row">
          <div class="col-xs-12">Номер карты: {{$patient_research->patient->card_number}}</div>
        </div>
        <div class="row">
          <div class="col-xs-12">Дата карты: {{$patient_research->patient->card_date}}</div>
        </div>
        <div class="row">
          <div class="col-xs-12">Забор анализа: {{$patient_research->create_date}}</div>
        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-xs-12 text-center gray-back" ><h4>{{$patient_research->research->name}}</h4></div>
    </div>
    <br>
    <div class="row">
      <div class="col-xs-3"><b>Пациент:</b></div>
      <div class="col-xs-6">{{$patient_research->patient->getFio()}}</div>
    </div>
    <div class="row">
      <div class="col-xs-3"><b>Пол:</b></div>
      <div class="col-xs-6">{{$patient_research->patient->gender == 'male' ? 'Мужской':'Женский'}}</div>
    </div>
    <div class="row">
      <div class="col-xs-3"><b>Год рождения:</b></div>
      <div class="col-xs-6">{{$patient_research->patient->birth_date}}</div>
    </div>
    <div class="row">
      <div class="col-xs-3"><b>Врач:</b></div>
      <div class="col-xs-6">{{ $patient_research->doctor->getFullName() }}</div>
    </div>
    <div class="row">
      <div class="col-xs-4"><b>Дополнительные сведения:</b></div>
      <div class="col-xs-8">{{$patient_research->patient->more_inform}}</div>
    </div>
    <hr>
    <div class="row">
      <div class="col-xs-12">
        <table class="table table-bordered" cellspacing="5" cellpadding="10" border="1" width="100%">
          <thead>
            <tr>
              <th style="vertical-align: middle;">Наименование исследования</th>
              <th style="vertical-align: middle;">Результат</th>
              <th style="vertical-align: middle;">Ед. изм.</th>
              <th style="vertical-align: middle;">Реф. значения</th>
            </tr>
          </thead>
          <tbody>
              @foreach($patient_research->results as $result)
              @if($result->result == '')
                @continue
              @endif
              <tr>
                <td style="vertical-align: middle;">{{ $result->analysis->name }}</td>
                <td style="vertical-align: middle;">{{ $result->result }}</td>
                <td style="vertical-align: middle;">{{ $result->analysis->unit }}</td>
                <td style="vertical-align: middle;">{!! nl2br($result->analysis->r_range) !!}</td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <p><b>Комментарии: </b> {{ $patient_research->comment }}</p>
      </div>
    </div>

    <br>
    <div class="row">
      <div class="col-xs-3"><b>Заведующая КДЛ</b></div>
      <div class="col-xs-7 text-right"><b>_______________ {{ SettingsHelper::get()->doctor->getFullName() }}</b></div>
    </div>
    <br>
    {{-- <div class="row">
      <div class="col-xs-3 col-xs-offset-7 text-right"><b>{{ isset($patient_research->issue_date) ? $patient_research->issue_date : '' }}</b></div>
    </div> --}}
  </div>
@endsection

@section('link_js')
  <!-- Jquery Core Js -->
  <script src="{{ URL::asset('plugins/jquery/jquery.min.js') }}"></script>

  <!-- Bootstrap Core Js -->
  <script src="{{ URL::asset('plugins/bootstrap/js/bootstrap.js') }}"></script>
@endsection

@section('js')
  $(document).ready(function(){
     window.print();
  });
@endsection

