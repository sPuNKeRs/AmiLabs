@extends('layouts.print')

@section('head')
  <title>Печать бланка исследования</title>
  {{-- Подключаем css --}}
  <!-- Bootstrap Core Css -->
  <link href="{{ URL::asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
  @endsection

@section('css')
  body{

  }
@endsection

@section('body')
  <p>Выводим на печать</p>
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

