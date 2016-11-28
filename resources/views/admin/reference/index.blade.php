@extends('layouts.master')

@section('page_title', 'Справочники')

@section('body')
  <!-- Search Bar -->
  @include('partials.search-bar')
  <!-- #END# Search Bar -->

  <!-- Top Bar -->
  @include('partials.top-bar')
  <!-- #Top Bar -->
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
  <div class="card">
      <div class="header">
        <h2>
            ВИДЫ ИССЛЕДОВАНИЙ
            <small>Работа со справочниками видов исследований</small>
        </h2>
        <ul class="header-dropdown m-r--5">
            <li class="dropdown">
                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">more_vert</i>
                </a>
                <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);" id="add_type" class=" waves-effect waves-block">Добавить</a></li>
                </ul>
            </li>
        </ul>
      </div>
      <div class="body table-responsive">
        <table id="type_table" class="table table-hover">
            <thead>
                <tr>
                    <th>НАИМЕНОВАНИЕ ВИДА ИССЛЕДОВАНИЯ</th>
                    <th>ОПИСАНИЕ</th>
                    <th>ДЕЙСТВИЯ</th>
                </tr>
            </thead>
            <tbody>
            @foreach($researchTypes as $type)
                <tr id="type_{{$type->id}}" data-typeid="{{ $type->id }}">
                    <td>{{ $type->name }}</td>
                    <td>{{ $type->description }}</td>
                    <td>
                        <a href="#" data-typeid="{{ $type->id }}" data-toggle="tooltip" data-placement="bottom" data-original-title="Редактировать" class="btn action-btn edit-type btn-warning waves-effect">
                          <i class="material-icons">mode_edit</i>
                        </a>

                        <a href="#" data-typeid="{{ $type->id }}" data-toggle="tooltip" data-placement="bottom" data-original-title="Настройка" class="btn action-btn options-type bg-blue waves-effect">
                          <i class="material-icons">assignment</i>
                        </a>

                        <a href="#" data-typeid="{{ $type->id }}" data-toggle="tooltip" data-placement="bottom" data-original-title="Удалить" class="btn action-btn delete-type btn-danger waves-effect">
                          <i class="material-icons">delete</i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
      </div>
  </div>

  <meta name="_token" content="{!! csrf_token() !!}" />

  @include('modals.default', $modal_create)
  @include('modals.default', $modal_edit)

@endsection
@section('js')
  <script type="text/javascript">
    $(document).ready(function(){
      // Инициализация переменных
      var selectedType = '';

      // Клик по строке
      $('#type_table').on('click', 'tr', function(e){
          var self = e.currentTarget;
          $('table tr.selected').removeClass('selected');
          //selectedType = $(self).data('typeid');
          $(self).addClass('selected');
      });

      // Клик по кнопке удалить
      $('#type_table').on('click', '.delete-type', function(e){
        var self = e.currentTarget;
        selectedType = $(self).data('typeid');
        showConfirmMessage(selectedType);
      });

      // Редактировать вид исследования
      $('#type_table').on('click', '.edit-type', function(e){
        var self = e.currentTarget;
        selectedType = $(self).data('typeid');
        console.log(selectedType);
        getResearchTypeById(selectedType);
      });

      // Клик по кнопке Сохранить
      $("#btn-update").on('click', function(e){
         var type_id = $('#modal_edit input[name="type_id"]').val();
         updateResearchTypeById(type_id);
      });

      //Добавить вид исследования
      $('#add_type').on('click', function(e){
        $('#modal_create').modal('show');
      });

      // Отправка данных на сервер
      $('#btn-save').on('click', function(e){
        // Инициализация переменных
        var token = $('meta[name="_token"]').attr('content');
        var form = $('#add_types_form')[0];
        var formData = new FormData(form);


        //TODO: Вынести отправку данных на сервер в отдельную функцию

        $.ajax({
          url: '{{ route('reference.researchtype.add') }}',
          headers: {'X-CSRF-TOKEN': token},
          processData: false,
          contentType: false,
          data: formData,
          type: 'POST',
          success: function (response) {
            //TODO: Переработать код (возможно компилировать вывод на стороне сервера...)
            var action = '<a href="#" data-typeid="'+response.id+'" data-toggle="tooltip" data-placement="bottom" data-original-title="Редактировать" class="btn action-btn edit-type btn-warning waves-effect"><i class="material-icons">mode_edit</i></a>  <a href="#" data-typeid="'+response.id+'" data-toggle="tooltip" data-placement="bottom" data-original-title="Настройка" class="btn action-btn options-type bg-blue waves-effect"><i class="material-icons">assignment</i></a>  <a href="#" data-typeid="'+response.id+'" data-toggle="tooltip" data-placement="bottom" data-original-title="Удалить" class="btn action-btn delete-type btn-danger waves-effect"><i class="material-icons">delete</i></a>';

            var html ='<tr id="type_'+response.id+'" data-typeid="'+response.id+'"><td>'+response.name+'</td><td>' + response.description + '</td><td>' + action + '</td></tr>';
            $('#type_table tbody').append(html);

            $('#modal_create').modal('hide');
            $('#add_types_form').trigger("reset");
            $('#add_types_form').find('.error').removeClass('error');
            $('#add_types_form').find('label').remove();
          },
          error: function(errors){
            var err = JSON.parse(errors.responseText);

            $.each(err, function(index, value) {
                var errMsg = '<label id="'+index+'-error" class="error" for="'+index+'">'+value+'</label>';
                $("#"+index+"").parent('div').addClass('error');
                $("#"+index+"").parent('div').after(errMsg);
            });

          }
        });
      });


// ============================= ФУНКЦИИ ===================================
  // Подтверждение удаления вида исследования
  function showConfirmMessage(type_id) {
    swal({
        title: "Вы хотите удалить вид исследования?",
        text: "Внимание! Будьте осторожны при удалении, возможно есть связанные данные!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Да, удалить!",
        cancelButtonText: 'Нет',
        closeOnConfirm: true
    }, function () {
        deleteResearchTypeById(type_id);
    });
  }

  // Удалить вид исследования по ID
  function deleteResearchTypeById(type_id)
  {
    // Инициализация переменных
    var token = $('meta[name="_token"]').attr('content');

    console.log('DELETE: '+ type_id);

    $.ajax({
      url: '{{ route('reference.researchtype.delete') }}',
      type: 'POST',
      headers: {'X-CSRF-TOKEN': token},
      data: {type_id: type_id},
      success: function (response) {
        //console.log(response);
        $('#type_' + type_id).remove();
      },
      error: function(errors){
        console.log(errors);
      }
    });
  }

  // Получить данные вида исследования по ID
  function getResearchTypeById(type_id)
  {
    // Инициализация переменных
    var modal = $('#modal_edit');
    var input_typeid = $('#modal_edit #add_types_form input[name="type_id"]');
    var input_name = $('#modal_edit #add_types_form #name');
    var input_description = $('#modal_edit #add_types_form #description');

    $.ajax({
      url: '{{ route('reference.researchtype.edit') }}/' + type_id,
      type: 'GET',
      success: function (response) {
        input_typeid.val(response.id);
        input_name.val(response.name);
        input_description.val(response.description);

        modal.modal('show');
        console.log(response);
      },
      error: function(errors){
        //TODO: Добавить обработку ошибок
        console.log(errors);
      }
    });
  }

  // Сохранить изменения вида исследовния
  function updateResearchTypeById(type_id)
  {
    // Инициализация переменных
    var token = $('meta[name="_token"]').attr('content');
    var form = $('#modal_edit #add_types_form')[0];
    var formData = new FormData(form);

    $.ajax({
      url: '{{ route('reference.researchtype.update') }}',
      headers: {'X-CSRF-TOKEN': token},
      processData: false,
      contentType: false,
      data: formData,
      type: 'POST',
      success: function (response) {
        //TODO: Переработать код (возможно компилировать вывод на стороне сервера...)
        var action = '<a href="#" data-typeid="'+response.id+'" data-toggle="tooltip" data-placement="bottom" data-original-title="Редактировать" class="btn action-btn edit-type btn-warning waves-effect"><i class="material-icons">mode_edit</i></a>  <a href="#" data-typeid="'+response.id+'" data-toggle="tooltip" data-placement="bottom" data-original-title="Настройка" class="btn action-btn options-type bg-blue waves-effect"><i class="material-icons">assignment</i></a>  <a href="#" data-typeid="'+response.id+'" data-toggle="tooltip" data-placement="bottom" data-original-title="Удалить" class="btn action-btn delete-type btn-danger waves-effect"><i class="material-icons">delete</i></a>';

        var html ='<tr id="type_'+response.id+'" data-typeid="'+response.id+'"><td>'+response.name+'</td><td>' + response.description + '</td><td>' + action + '</td></tr>';
        $('#type_' + type_id).after(html);
        $('#type_' + type_id).remove();

        $('#modal_edit').modal('hide');
        $('#modal_edit #add_types_form').trigger("reset");
        $('#modal_edit #add_types_form').find('.error').removeClass('error');
        $('#modal_edit #add_types_form').find('label').remove();
      },
      error: function(errors){
        var err = JSON.parse(errors.responseText);

        $.each(err, function(index, value) {
            var errMsg = '<label id="'+index+'-error" class="error" for="'+index+'">'+value+'</label>';
            $("#"+index+"").parent('div').addClass('error');
            $("#"+index+"").parent('div').after(errMsg);
        });

      }
    });
  }

});
  </script>
@endsection


