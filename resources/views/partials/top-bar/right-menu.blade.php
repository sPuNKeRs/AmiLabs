<!-- Right menu -->
<li class="dropdown">
  <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
    <i class="material-icons">more_vert</i>
  </a>
  <ul class="dropdown-menu pull-right">
    <li><a href="javascript:void(0);" class=" waves-effect waves-block">Профиль</a></li>
    <li><a href="javascript:void(0);" class=" waves-effect waves-block">Настройки</a></li>
    <li><a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class=" waves-effect waves-block">Выход</a></li>
  </ul>
</li>
<!-- #Right menu -->