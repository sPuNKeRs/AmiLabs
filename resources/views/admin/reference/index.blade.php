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
            @foreach($analysisTypes as $type)
                <tr>
                    <td>{{ $type->name }}</td>
                    <td>{{ $type->description }}</td>
                    <td>@mdo</td>
                </tr>
            @endforeach
            </tbody>
        </table>
      </div>
  </div>

  <meta name="_token" content="{!! csrf_token() !!}" />

  @include('modals.default', $modal)

@endsection
@section('js')
  <script type="text/javascript">
    $(document).ready(function(){

      //Добавить вид анализов
      $('#add_type').on('click', function(e){
        $('#defaultModal').modal('show'); 
      });

      // Отправка данных на сервер
      $('#btn-save').on('click', function(e){
        // Инициализация переменных
        var token = $('meta[name="_token"]').attr('content');
        var form = $('#add_types_form')[0];
        var formData = new FormData(form);

        $.ajax({
          url: '{{ route('reference.analyzistype.add') }}',
          headers: {'X-CSRF-TOKEN': token},
          processData: false,
          contentType: false,
          data: formData,
          type: 'POST',
          success: function (response) {
              console.log(response);

              var html ='<tr><<td>'+response.name+'</td><td>'+response.description+'</td><td>@mdo</td></tr>';
              $('#type_table tbody').append(html);

              $('#defaultModal').modal('hide');
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
    });
  </script>
@endsection


