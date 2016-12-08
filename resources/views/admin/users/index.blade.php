@extends('layouts.master')

@section('page_title', 'Пользователи')

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

  <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                @if(session('status'))
                <div class="alert bg-green alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                {{ session('status') }}
                </div>
                @endif

                    <div class="card">
                        <div class="header">
                            <h2>
                                ПОЛЬЗОВАТЕЛИ
                                <small>Список пользователей системы.</small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="{{ route('users.create') }}" class=" waves-effect waves-block">Создать</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body table-responsive">
                            <table id="users-table" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ФИО</th>
                                        <th>Электронная почта</th>
                                        <th>Тип пользователя</th>
                                        <th>Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($users as $user)
                                    <tr data-user-id="{{ $user->id }}">
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @foreach($user->roles as $role)
                                                {{ $role->description }}
                                            @endforeach
                                        </td>
                                        <td>
                                            <a data-user-id="{{ $user->id }}" data-toggle="tooltip" data-placement="bottom" data-original-title="Редактировать" class="btn action-btn user-edit btn-warning waves-effect">
                                                <i class="material-icons">mode_edit</i>
                                            </a>
                                            <a data-user-id="{{ $user->id }}" data-toggle="tooltip" data-placement="bottom" data-original-title="Удалить" class="btn action-btn user-delete btn-danger waves-effect">
                                                <i class="material-icons">delete</i>
                                            </a>
                                        </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
@endsection

@section('css')

@endsection

@section('js')
<script>
$(function() {

    // Инициализиция переменных
    var selectedRow = '';

    // Клик по строке
    $('#users-table').on('click', 'tr', function(e){
        var self = e.currentTarget;
        $('table tr.selected').removeClass('selected');
        selectedRow = $(self).data('patient_id');
        $(self).addClass('selected');
    });

    // Удалить пользователя
    $('#users-table').on('click', '.user-delete', function(e){
        showConfirmMessage();
    });

    // Редактировать пользователя
    $('#users-table').on('click', '.user-edit', function(e){
        var userid = $(this).data('user-id');
        editUser(userid);
    });

    // При двойном нажатии открыть форму редактирования
    $('tr').on('dblclick', function(e){
        var userid = $(this).data('user-id');
        editUser(userid);
    });

    // Функция отправки формы приказа
    function editPatient(patient_id)
    {
        var editLink = '{{ route('registry.patients.edit')}}/' + patient_id;
        window.location.href = editLink;
    }
    //============ ФУНКЦИИ ==========
    // Редактировать пользователя
    function editUser(userid){
        if (userid) {
            window.location = '{{route('users.edit')}}/' + userid;
        }
    }

    // Вопрос на удаление пользователя
    function showConfirmMessage() {
        swal({
            title: "Вы хотите удалить пользователя?",
            text: "Пользователь будет удален из системы без возможности восстановления!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Да, удалить!",
            cancelButtonText: 'Нет',
            closeOnConfirm: false
        }, function () {
            window.location.href = '{{route('users.delete', $user->id)}}';
        });
    }
});
</script>
@endsection


