<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<title>{{ config('app.name', 'Laravel') }} | @yield('page_title')</title>
<!-- Favicon-->
<link rel="icon" href="favicon.ico" type="image/x-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

<!-- Bootstrap Core Css -->
<link href="{{ URL::asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

<!-- Bootstrap-fileinput -->
<link href="{{ URL::asset('plugins/bootstrap-fileinput/css/fileinput.min.css') }}" rel="stylesheet">

<!-- Waves Effect Css -->
<link href="{{ URL::asset('plugins/node-waves/waves.css') }}" rel="stylesheet" />

<!-- Animation Css -->
<link href="{{ URL::asset('plugins/animate-css/animate.css') }}" rel="stylesheet" />

<!-- Preloader Css -->
<link href="{{ URL::asset('plugins/material-design-preloader/md-preloader.css') }}" rel="stylesheet" />

<!-- Morris Chart Css-->
<link href="{{ URL::asset('plugins/morrisjs/morris.css') }}" rel="stylesheet" />

<!-- Sweetalert Css -->
<link href="{{ URL::asset('plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />

<!-- Bootstrap Select Css -->
<link href="{{ URL::asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

<!-- JQuery DataTable Css -->
<link href="{{ URL::asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

<!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
<link href="{{ URL::asset('css/themes/all-themes.css') }}" rel="stylesheet" />

<!-- Custom Css -->
<link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/custom.css') }}" rel="stylesheet">

@yield('css')

<!-- Custom User Css -->
@yield('head')
