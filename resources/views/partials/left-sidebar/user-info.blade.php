<!-- User Info -->
<div class="user-info">
    
    <div class="info-container">
    <div class="image">
        <a href="{{ route('profile', Auth::user()->id) }}">
            <img src="{{ URL::asset('images/avatars/'.Auth::user()->profile->avatar) }}" width="80" height="80" alt="User" />
        </a>
    </div>
        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
        <div class="email">{{ Auth::user()->email }}</div>
        <div class="btn-group user-helper-dropdown">
            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
            <ul class="dropdown-menu pull-right">
                <li><a href="{{ route('profile', Auth::user()->id) }}"><i class="material-icons">person</i>Профиль</a></li>                
                <li role="seperator" class="divider"></li>
                <li><a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="material-icons">input</i>Выйти</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- #User Info -->