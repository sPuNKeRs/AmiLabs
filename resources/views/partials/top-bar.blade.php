<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a href="javascript:void(0);" class="button-bars"></a>
            <a class="navbar-brand" href="{{url('/')}}">{{ config('app.name', 'Laravel') }} | @yield('page_title')</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- Call Search -->
                <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                <!-- #END# Call Search -->

                <!-- Notifications -->
                {{-- @include('partials.top-bar.notifications') --}}
                <!-- #END# Notifications -->

                <!-- Tasks -->
                {{-- @include('partials.top-bar.tasks') --}}
                <!-- #END# Tasks -->

                <!-- Right menu -->
                @include('partials.top-bar.right-menu')
                <!-- #Right menu -->
                 {{-- <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li> --}}
            </ul>

        </div>
    </div>
</nav>
<!-- #Top Bar -->