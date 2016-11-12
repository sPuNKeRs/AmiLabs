<!-- Right menu -->
<li class="dropdown">
  <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
    <i class="material-icons">more_vert</i>
  </a>
  <ul class="dropdown-menu pull-right">
    <li><a href="{{ route('profile', Auth::user()->id) }}" class=" waves-effect waves-block">Профиль</a></li>
    
    @if(Auth::user()->hasRole('admin'))
        <li><a href="{{ route('settings') }}" class=" waves-effect waves-block">Настройки</a></li>
    @endif
    
    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class=" waves-effect waves-block">Выход</a></li>
  </ul>
</li>
<!-- #Right menu -->