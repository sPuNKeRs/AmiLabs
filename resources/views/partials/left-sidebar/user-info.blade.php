<!-- User Info -->
<div class="user-info">
    <div class="image">
        <img src="images/user.png" width="48" height="48" alt="User" />
    </div>
    <div class="info-container">
        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Иванов И. И.</div>
        <div class="email">john.doe@example.com</div>
        <div class="btn-group user-helper-dropdown">
            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
            <ul class="dropdown-menu pull-right">
                <li><a href="javascript:void(0);"><i class="material-icons">person</i>Профиль</a></li>                
                <li role="seperator" class="divider"></li>
                <li><a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="material-icons">input</i>Выйти</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- #User Info -->