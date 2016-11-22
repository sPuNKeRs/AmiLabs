@extends('layouts.master')

@section('page_title', 'Регистратура')

<!-- Top Bar Nav-->
@section('top_page_nav')
<ul class="nav navbar-nav top_page_nav">
    <li>
        <a href="{{ route('registry.patients.create') }}" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Добавить пациента">
            <i class="material-icons">control_point</i>
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
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        СПИСОК ПАЦИЕНТОВ
                    </h2>
                    {{-- <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                            </ul>
                        </li>
                    </ul> --}}
                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable" width="100%" id="users-table">
                        <thead>
                            <tr>
                                <th>№ Карты</th>
                                <th>Создан</th>
                                <th>Фамилия</th>
                                <th>Имя</th>
                                <th>Отчество</th>
                                <th>Дата рождения</th>
                            </tr>
                        </thead>                                                                
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->
@endsection

@section('js')
<script>
$(function() {

    //Tooltip
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });

    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('registry.data') !!}',
        columns: [
            { data: 'card_number', name: 'card_number' },
            { data: 'card_date', name: 'card_date' },
            { data: 'surname', name: 'surname' },
            { data: 'firstname', name: 'firstname' },
            { data: 'lastname', name: 'lastname' },
            { data: 'birth_date', name: 'birth_date' }
        ],
        language: {
          url: '{{ URL::asset('plugins/jquery-datatable/lang/Russia.json') }}'
        },        
        stateSave: true
    });
});
</script>
@endsection


