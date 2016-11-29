@extends('layouts.master')

@section('page_title', $research->name.' | Список анализов')

<!-- Top Bar Nav-->
@section('top_page_nav')
<ul class="nav navbar-nav top_page_nav">
    <li>
        <a href="#" id="add_analysis" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="bottom" title="Добавить" data-original-title="Добавить">
            <i class="material-icons">add</i>
        </a>
    </li>
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
                        {{ mb_strtoupper($research->name) }} | СПИСОК АНАЛИЗОВ
                    </h2>

                    {{-- <div class="pull-right">
                        <div class="action-btn-panel">
                            <a href="#" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="bottom" title="Добавить" data-original-title="Добавить">
                                <i class="material-icons">add</i>
                            </a>
                        </div>
                    </div> --}}

                </div>
                <div class="body">
                    <!-- Exportable Table -->
                    <table class="table table-bordered table-striped table-hover" width="100%" id="analyzes-table">
                        <thead>
                            <tr>
                                <th>Наименование</th>
                                <th>Eдиница измерения</th>
                                <th>Референсные значения</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Эстрадиол (ИФА)</td>
                                <td>нмоль/л</td>
                                <td>Мужчины 0.029 - 0.3</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- #END# Exportable Table -->
                </div>
            </div>
        </div>
    </div>
    {{ csrf_field() }}
    {{-- {{ Form::hidden('research_id', $research->id) }} --}}
    @include('modals.default', $modal_create)
@endsection

@section('js')
<script>
$(function() {
    // Инициализация переменных
    var research_id = $('input[name="research_id"]').val();
    var token = $('meta[name="_token"]').attr('content');

    // Клик по кнопке добавить
    $('#add_analysis').on('click', function(e){
        $('#modal_create').modal('show');
    });

    // Клик по кнопке Добавить
    $('#btn-save').on('click', function(e){
        add_analysis(research_id);
    });

    // Клик по строке таблицы
    $('#analyzes-table tbody').on('click', 'tr', function(e){
          var self = e.currentTarget;
          $('table tr.selected').removeClass('selected');
          $(self).addClass('selected');
    });

    // ============  ФУНКЦИИ ========================================
    function add_analysis(research_id)
    {
      console.log('Добавляем анализ к иссдедованию с ID: ' + research_id);
      var form = $('#add_analysis_form')[0];
      var formData = new FormData(form);

      $.ajax({
        url: '{{ route('reference.research.analysis.add') }}',
        headers: {'X-CSRF-TOKEN': token},
        processData: false,
        contentType: false,
        data: formData,
        type: 'POST',
        success: function (response) {
          console.log(response);

          clearForm();
          clearErrorMsg();
        },
        error: function(errors){
          clearErrorMsg();
          console.log(errors);
          showError(JSON.parse(errors.responseText));
        }
      });
    }

    // Очистить и скрыть модальную форму
    function clearForm()
    {
      $('#modal_create').modal('hide');
      $('#add_analysis_form').trigger("reset");
    }

    // Очистить сообщения об ощибках
    function clearErrorMsg()
    {
      $('#add_analysis_form').find('.error').removeClass('error');
      $('#add_analysis_form').find('label').remove();
    }

    // Вывести сообщение об ошибках заполнения формы
    function showError(error)
    {
      $.each(error, function(index, value) {
              var errMsg = '<label id="'+index+'-error" class="error" for="'+index+'">'+value+'</label>';
              $("#"+index+"").parent('div').addClass('error');
              $("#"+index+"").parent('div').after(errMsg);
      });
    }

});
</script>
@endsection
