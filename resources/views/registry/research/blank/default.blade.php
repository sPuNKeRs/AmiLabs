@extends('layouts.master')

@section('page_title', 'Бланк "'.$research->name.'" - '.$patient->getFio().' | <small>Дата рождения: '.$patient->birth_date.'</small>')

<!-- Top Bar Nav-->
@section('top_page_nav')
<ul class="nav navbar-nav top_page_nav">
    {{-- <li>
        <a href="#" id="add_research" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="bottom" title="Добавить исследование" data-original-title="Добавить исследование">
            <i class="material-icons">add</i>
        </a>
    </li> --}}
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
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        "{{ mb_strtoupper($research->name) }}" - {{ $patient->getFio(true) }}
                    </h2>
                    <small>Дата рождения: {{ $patient->birth_date }}</small>
                </div>
                <div class="body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, magnam odit voluptate error laborum consequuntur velit, unde recusandae fuga aliquid ad consectetur quidem vel magni accusamus voluptatum illum nam est.</p>
                </div>
            </div>
        </div>
    </div>
    {{ csrf_field() }}
@endsection

@section('js')
<script>
$(function() {

});
</script>
@endsection
