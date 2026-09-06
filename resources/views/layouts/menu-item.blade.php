@if ($item["submenu"] == [])
<div class="menu-item {{($item['padre']) ? 'active closed' : 'closed'}}">
    <a href="{{url($item['url'])}}" class="menu-link">
        <div class="menu-icon">
            <i class="{{$item['icono']}}"></i>
        </div>
        <div class="menu-text">{{$item['nombre']}}</div>
        <!--<div class="menu-caret"></div>-->
    </a>
</div>
@else
<div class="menu-item {{($item['padre']) ? 'has-sub active expand' : 'has-sub closed'}}">
    <a href="#" class="menu-link">
        <div class="menu-icon">
            <i class="{{$item['icono']}}"></i>
        </div>
        <div class="menu-text">{{$item['nombre']}}</div>
        <div class="menu-caret"></div>
    </a>
    <div class="menu-submenu">
        @foreach ($item['submenu'] as $submenu)
        @if($submenu["submenu"] == [])
        <div class="menu-item {{($submenu['hijo']) ? 'active' : ''}}">
            <a href="{{$submenu['url']}}" class="menu-link">
                <div class="menu-text">{{$submenu['nombre']}}
                    <i class="{{$submenu['icono']}} text-theme"></i>
                </div>
            </a>
        </div>
        @else
        @foreach ($submenu as $submenu2)
        <div class="menu-item {{($submenu2['hijo']) ? 'active' : ''}}">
            <a href="{{$submenu['url']}}" class="menu-link">
                <div class="menu-text">{{$submenu2['nombre']}}
                    <i class="{{$submenu2['icono']}} text-theme"></i>
                </div>
            </a>
        </div>
        @endforeach
        @endif
        @endforeach
    </div>
</div>
@endif