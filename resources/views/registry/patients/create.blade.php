@extends('layouts.master')

@section('page_title', 'Регистрация пациента')

<!-- Top Bar Nav-->
@section('top_page_nav')
<ul class="nav navbar-nav top_page_nav">
    <li>
        <a href="#" class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Сохранить">
            <i class="material-icons">check</i>
        </a>        
    </li> 

   <li>
        <a href="{{ URL::previous() }}" class="btn btn-danger btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="bottom" title="Отмена" data-original-title="Отмена">
            <i class="material-icons">cancel</i>
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
                        РЕГИСТРАЦИОННАЯ КАРТА
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Сохранить</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    {!! Form::open(['route' => 'registry.patients.save' , 'id'=>'patient_form', 'name'=> 'patient_form']) !!}                    
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control">
                                        <label class="form-label">Email Address</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="password" class="form-control">
                                        <label class="form-label">Password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <input type="checkbox" id="remember_me_5" class="filled-in">
                                <label for="remember_me_5">Remember Me</label>
                                <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect">LOGIN</button>
                            </div>
                        </div>
                    {!! Form::close() !!}                    
                </div>
            </div>
        </div>
    </div>    
@endsection

@section('js')
<script>

</script>
@endsection


