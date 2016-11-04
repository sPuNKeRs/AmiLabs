<!-- Menu -->
<div class="menu">
    <ul class="list">

        {{-- <li class="header">НАВИГАЦИЯ</li> --}}
        @foreach($menu as $item)
            @if(!$item->hasChildren())
                @if($item->link)
                    <li {!! $item->attributes() !!}>
                        <a href="{!! $item->url() !!}">
                            <i class="material-icons">{!! $item->icon !!}</i>
                            <span>{{$item->titles}}</span>
                        </a>
                    </li>
                @else
                    {!! $item->titles !!}
                @endif
            @else
            @if($item->link)
                <li {!! $item->attributes() !!}>
                    <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                        <i class="material-icons">{!! $item->icon !!}</i>
                        <span>{!! $item->titles !!}</span>
                    </a>
                    <ul class="ml-menu">
                         @foreach($item->children() as $child)
                            @if($child->link)
                                <li {!! $item->attributes() !!}>
                                    <a href="{{ $item->url() }}" class="{{($child->hasChildren()) ? 'menu-toggle' : ''}} waves-effect waves-block">
                                        <span>{!! $child->titles !!}</span>
                                    </a>
                                </li>
                                @else
                                    {!! $child->titles !!}
                                @endif
                        @endforeach
                    </ul>
                </li>
                @else
                    {!! $item->titles !!}
                @endif
            @endif
        @endforeach
    </ul>
</div>
<!-- #Menu -->