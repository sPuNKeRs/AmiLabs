<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    @include('partials.left-sidebar.user-info')
    <!-- #User Info -->
    @include('partials.left-sidebar.menu', ['menu' => $menu_main->roots()])
    <!-- Menu -->
    
    <!-- #Menu -->
    <!-- Footer -->
    @include('partials.left-sidebar.footer')
    <!-- #Footer -->
</aside>
<!-- #END# Left Sidebar -->