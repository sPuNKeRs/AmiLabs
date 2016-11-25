@extends('layouts.master')

@section('page_title', 'Список исследований - '.$patient->getFio().' | <small>Дата рождения: '.$patient->birth_date.'</small>')

<!-- Top Bar Nav-->
@section('top_page_nav')
<ul class="nav navbar-nav top_page_nav">
    <li>
        <a href="{{ route('registry') }}" class="btn btn-danger btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="bottom" title="Назад" data-original-title="Назад">
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
                        СПИСОК ИССЛЕДОВАНИЙ - {{ $patient->getFio(true) }}
                    </h2>
                    <small>Дата рождения: {{ $patient->birth_date }}</small>
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

    // // Инициализиция переменных
    // var selectedRow = '';

    // //Tooltip
    // $('[data-toggle="tooltip"]').tooltip({
    //     container: 'body'
    // });

    // $('#patients-table').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     ajax: '{!! route('registry.data') !!}',
    //     columns: [
    //         { width: '10%', data: 'card_number', name: 'card_number' },
    //         { data: 'surname', name: 'surname' },
    //         { data: 'firstname', name: 'firstname' },
    //         { data: 'lastname', name: 'lastname' },
    //         { width: '15%', data: 'birth_date', name: 'birth_date' },
    //         { width: '15%', data: 'card_date', name: 'card_date' },
    //         { width: '5%', data: 'action', name: 'action', orderable: false, searchable: false }
    //     ],        
    //     language: {
    //       url: '{{ URL::asset('plugins/jquery-datatable/lang/Russia.json') }}'
    //     },
    //     stateSave: true
    // });

    // // Клик по строке
    // $('#patients-table').on('click', 'tr', function(e){
    //     var self = e.currentTarget;
    //     $('table tr.selected').removeClass('selected');
    //     selectedRow = $(self).data('patient_id');        
    //     $(self).addClass('selected');
    // });

    // // Двойной клик по строке
    // $('#patients-table').on('dblclick', 'tr', function(e){
    //     var self = e.currentTarget;
    //     editPatient($(self).data('patient_id'));
    //     console.log($(self).data());
    // });

    // // Функция отправки формы приказа
    // function editPatient(patient_id)
    // {
    //     var editLink = '{{ route('registry.patients.edit')}}/' + patient_id;
    //     window.location.href = editLink;
    // }
});
</script>
@endsection
