<!DOCTYPE html>
<html>

<head>
    @include('partials.head')
</head>

<body class="@yield('page-class', 'theme-green')">
    <!-- Page Loader -->
    @include('partials.page-loader')
    <!-- #END# Page Loader -->

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    @yield('body')

    <!-- Search Bar -->
    {{-- @include('partials.search-bar') --}}
    <!-- #END# Search Bar -->

    <!-- Top Bar -->
    {{-- @include('partials.top-bar') --}}
    <!-- #Top Bar -->

    <section>
        @yield('sidebars')
        {{-- @include('partials.left-sidebar') --}}

        {{-- @include('partials.right-sidebar') --}}
    </section>

    <section class="content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </section>
    @include('auth.logout-form')
    @include('partials.js')
</body>
</html>