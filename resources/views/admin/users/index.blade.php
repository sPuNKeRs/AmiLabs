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
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ФИО</th>
                                        <th>Электронная почта</th>
                                        <th>Тип пользователя</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($users as $user)
                                    <tr data-user-id="{{ $user->id }}">
                                        <th scope="row">{{ $user->id }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->user_type_id }}</td>
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
  <!-- Bootstrap Notify Plugin Js -->
  {{-- <script src="{{URL::asset('plugins/bootstrap-notify/bootstrap-notify.js')}}"></script> --}}  

  <script type="text/javascript">
    $(document).ready(function(){
      // При двойном нажатии открыть форму редактирования
      $('tr').on('dblclick', function(e){
        var userid = $(this).data('user-id');
        if (userid) {
          window.location = '{{route('users.edit')}}/' + userid;
        }
      });
    });
  </script>
@endsection


