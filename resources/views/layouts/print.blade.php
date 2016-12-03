<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    @yield('head')
    <style>
      @yield('css')
    </style>
</head>

<body class="@yield('body-class')">
  @yield('body')

  @yield('link_js')
  <script type="text/javascript">
    @yield('js')
  </script>
</body>
</html>