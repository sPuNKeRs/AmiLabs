@extends('layouts.master')

@section('page_title', 'Список анализов')

<!-- Top Bar Nav-->
@section('top_page_nav')
<ul class="nav navbar-nav top_page_nav">
    <li>
        <a href="{{ route('reference') }}" class="btn btn-danger btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="bottom" title="Назад" data-original-title="Назад">
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
                        СПИСОК АНАЛИЗОВ
                    </h2>
                </div>
                <div class="body">
                    <!-- Exportable Table -->
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable" width="100%" id="patients-table">
                        <thead>
                            <tr>
                                <th>№ Исследования</th>
                                <th>Тип исследования</th>
                                <th>Дата</th>
                                <th>Статус</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                    </table>
                    <!-- #END# Exportable Table -->
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
