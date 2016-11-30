@extends('layouts.master')

@section('page_title', 'Список исследований - '.$patient->getFio().' | <small>Дата рождения: '.$patient->birth_date.'</small>')

<!-- Top Bar Nav-->
@section('top_page_nav')
<ul class="nav navbar-nav top_page_nav">
    <li>
        <a href="#" id="add_research" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="bottom" title="Добавить исследование" data-original-title="Добавить исследование">
            <i class="material-icons">add</i>
        </a>
    </li>
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
                    <table class="table table-bordered table-striped table-hover" width="100%" id="researches-table">
                        <thead>
                            <tr>
                                <th>№ Исследования</th>
                                <th>Вид исследования</th>
                                <th>Дата</th>
                                <th>Статус</th>
                            </tr>
                        </thead>
                    </table>
                    <!-- #END# Exportable Table -->
                </div>
            </div>
        </div>
    </div>
    {{ csrf_field() }}
    @include('modals.default', $modal_choose_research)
@endsection

@section('js')
<script>
$(function() {
    // Инициализация переменных
    var patient_id = '{{$patient->id}}';

    // Клик по кнопке добавить исследование
    $('#add_research').on('click', function(e){
        chooseResearchModal();
    });

    // Клик по кнопке Добавить модального окна
     $('#btn-save').on('click', function(e){
         $('#choose_research_form').submit();
     });

    //======================= ФУНКЦИИ ======================
    function chooseResearchModal()
    {
        $('#modal_choose_research').modal('show');
    }
    //======================= DATATABLES ======================
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });

    $('#researches-table').DataTable({
        processing: true,
        serverSide: true,
         ajax: {
            url: '{{ route('registry.patients.research.get') }}',
            method: 'POST',
            data: {patient_id: patient_id}
        },
        columns: [
            { width: '10%',data: 'id', name: 'id' },
            { data: 'research_id', name: 'research_id' },
            { data: 'create_date', name: 'create_date' },
            { data: 'status', name: 'status' },

            {{-- { width: '5%', data: 'action', name: 'action', orderable: false, searchable: false } --}}
        ],
        language: {
          url: '{{ URL::asset('plugins/jquery-datatable/lang/Russia.json') }}'
        },
        stateSave: true,
        initComplete: function () {
            $('[data-toggle="tooltip"]').tooltip({
                container: 'body'
            });
        }
    });
});
</script>
@endsection
