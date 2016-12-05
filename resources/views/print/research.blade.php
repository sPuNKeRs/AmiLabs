@extends('layouts.print')

@section('head')
  <title>Печать бланка исследования</title>
  {{-- Подключаем css --}}
  <!-- Bootstrap Core Css -->
  <link href="{{ URL::asset('plugins/bootstrap/css/bootstrap-grid.min.css') }}" rel="stylesheet">
  @endsection

@section('css')
 .print-wrap {
    width: 755px;
    height: auto;
    margin: 0 auto;
  }

 .gray-back{
    background-color: #ccc;
    border-bottom: 2px solid black;
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
        354000, г. Сочи, ул. Конституции, 24<br>
        г. Сочи, ул. Конституции, 24<br>
        г. Сочи, ул. Пирогова, 10<br>
        г. Сочи, ул. Абрикосовая, 21А<br>
        г. Сочи, ул. Донская, 62
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
    <div class="row">
      <div class="col-xs-12 text-center gray-back" ><h4>{{$patient_research->research->name}}</h4></div>
    </div>
    <div class="row">
      <div class="col-xs-4"><b>Пациент:</b></div>
      <div class="col-xs-8">{{$patient_research->patient->getFio()}}</div>
    </div>
    <div class="row">
      <div class="col-xs-4"><b>Пол:</b></div>
      <div class="col-xs-8">{{$patient_research->patient->gender == 'male' ? 'Мужской':'Женский'}}</div>
    </div>
    <div class="row">
      <div class="col-xs-4"><b>Год рождения:</b></div>
      <div class="col-xs-8">{{$patient_research->patient->birth_date}}</div>
    </div>
    <div class="row">
      <div class="col-xs-4"><b>Врач:</b></div>
      <div class="col-xs-8">Н. Б. Быкова</div>
    </div>
    <div class="row">
      <div class="col-xs-4"><b>Дополнительные сведения:</b></div>
      <div class="col-xs-8">{{$patient_research->patient->more_inform}}</div>
    </div>
    <hr>
    <div class="row">
      <div class="col-xs-12">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Наименование исследования</th>
              <th>Результат</th>
              <th>Ед. изм.</th>
              <th>Реф. значения</th>
            </tr>
          </thead>
          <tbody>
              @foreach($patient_research->results as $result)
              @if($result->result == '')
                @continue
              @endif
              <tr>
                <td>{{ $result->analysis->name }}</td>
                <td>{{ $result->result }}</td>
                <td>{{ $result->analysis->unit }}</td>
                <td>{{ $result->analysis->r_range }}</td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <br>

    <br>
    <div class="row">
      <div class="col-xs-6"><b>Заведующая КДЛ</b></div>
      <div class="col-xs-6"><b>_______________ Н.Б. Быкова</b></div>
    </div>
    <br>
    <div class="row">
      <div class="col-xs-4 col-xs-offset-8"><b>22.10.2016</b></div>
    </div>
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
     //window.print();
  });
@endsection

