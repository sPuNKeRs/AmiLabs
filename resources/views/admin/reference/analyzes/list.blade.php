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
                                <th>#</th>
                                <th>Наименование</th>
                                <th>Eдиница измерения</th>
                                <th>Референсные значения</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($analyzes as $analysis)
                            <tr id="analysis-{{ $analysis->id }}" data-iteration="{{ $loop->iteration }}" data-analysis-id="{{ $analysis->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $analysis->name }}</td>
                                <td>{{ $analysis->unit }}</td>
                                <td>{{ $analysis->r_range }}</td>
                                <td>
                                    <a href="#" data-analysis-id="{{ $analysis->id }}" data-toggle="tooltip" data-placement="bottom" data-original-title="Редактировать" class="btn action-btn edit-analysis btn-warning waves-effect">
                                        <i class="material-icons">mode_edit</i>
                                    </a>

                                    <a href="#" data-analysis-id="{{ $analysis->id }}" data-toggle="tooltip" data-placement="bottom" data-original-title="Удалить" class="btn action-btn delete-analysis btn-danger waves-effect">
                                        <i class="material-icons">delete</i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
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
    @include('modals.default', $modal_edit)
@endsection

@section('js')
<script>
$(function() {
    // Инициализация переменных
    var research_id = $('input[name="research_id"]').val();
    var token = $('input[name="_token"]').val();
    var selected_analysis = '';

    // Клик по кнопке добавить
    $('#add_analysis').on('click', function(e){
        $('#modal_create').modal('show');
    });

    // Клик по кнопке Добавить (Сохранить)
    $('#btn-save').on('click', function(e){
        add_analysis(research_id);
    });

    // Клик по кнопку Сохранить (Обновить)
    $('#btn-update').on('click', function(e){
        update_analysis(selected_analysis);
    });

    // Клик по кнопке Удалить
    $('#analyzes-table').on('click', '.delete-analysis', function(e){
        var self = e.currentTarget;
        selected_analysis = $(self).data('analysis-id');
        showConfirmMessage(selected_analysis);
    });

    // Клик по кнопке редактировать
    $('#analyzes-table').on('click', '.edit-analysis', function(e){
        var self = e.currentTarget;
        selected_analysis = $(self).data('analysis-id');
        edit_analysis(selected_analysis);
    });

    // Клик по строке таблицы
    $('#analyzes-table tbody').on('click', 'tr', function(e){
          var self = e.currentTarget;
          $('table tr.selected').removeClass('selected');
          $(self).addClass('selected');
    });

    // ============  ФУНКЦИИ ========================================
    // Обновить анализ
    function update_analysis(analysis_id)
    {
        console.log('Сохраняем изменения анализа ID: ' + analysis_id);

        var form = $('#modal_edit #add_analysis_form')[0];
        var formData = new FormData(form);

        $.ajax({
            url: '{{ route('reference.research.analysis.update') }}',
            headers: {'X-CSRF-TOKEN': token},
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            success: function (response) {
               console.log(response);
               $('#analysis-' + analysis_id).after(response);
               $('#analysis-' + analysis_id).remove();

               clearForm();
               clearErrorMsg();
               $("[data-toggle='tooltip']").tooltip();
               $('#modal_edit').modal('hide');
            },
            error: function(errors){
                clearErrorMsg();
                console.log(errors);
                showError(JSON.parse(errors.responseText));
            }
        });
    }

    // Окно редактирование анализа
    function edit_analysis(analysis_id)
    {
        console.log('Редактируем анализ ID:' + analysis_id);

        $('#modal_edit #add_analysis_form #iteration').val($('#analysis-' + analysis_id).data('iteration'));

        var input_id = $('#modal_edit #add_analysis_form #analysis_id');
        var input_name = $('#modal_edit #add_analysis_form #name');
        var input_unit = $('#modal_edit #add_analysis_form #unit');
        var input_r_range = $('#modal_edit #add_analysis_form #r_range');

        $.ajax({
            url: '{{ route('reference.research.analysis.get') }}',
            type: 'POST',
            headers: {'X-CSRF-TOKEN': token},
            data: {analysis_id: analysis_id},
            success: function (response) {
                console.log(response);
                input_id.val(response.id);
                input_name.val(response.name);
                input_unit.val(response.unit);
                input_r_range.val(response.r_range);
                $('#modal_edit').modal('show');
            },
            error: function(errors){
                console.log(errors);
            }
        });

    }

    // Подтверждение удаления вида исследования
    function showConfirmMessage(analysis_id) {
        swal({
            title: "Вы хотите удалить выбранный анализ?",
            text: "Внимание! Будьте осторожны при удалении, возможно есть связанные данные!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Да, удалить!",
            cancelButtonText: 'Нет',
            closeOnConfirm: true
        }, function () {
            delete_analysis(selected_analysis);
        });
    }

    // Удаление анализа
    function delete_analysis(analysis_id)
    {
        console.log('Удаляем анализ ID: '+ analysis_id);

        $.ajax({
            url: '{{ route('reference.research.analysis.delete') }}',
            type: 'POST',
            headers: {'X-CSRF-TOKEN': token},
            data: {analysis_id: analysis_id},
            success: function (response) {
                console.log(response);
                $("[data-toggle='tooltip']").tooltip('hide');
                $('#analysis-' + analysis_id).remove();
            },
            error: function(errors){
                console.log(errors);
            }
        });
    }

    function add_analysis(research_id)
    {
      console.log('Добавляем анализ к иссдедованию с ID: ' + research_id);
      var form = $('#modal_create #add_analysis_form')[0];
      var formData = new FormData(form);

      $.ajax({
        url: '{{ route('reference.research.analysis.add') }}',
        headers: {'X-CSRF-TOKEN': token},
        processData: false,
        contentType: false,
        data: formData,
        type: 'POST',
        success: function (response) {
          $('#analyzes-table tbody').append(response);
          clearForm();
          clearErrorMsg();
          $("[data-toggle='tooltip']").tooltip();
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
      $('#modal_create #add_analysis_form').trigger("reset");
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
