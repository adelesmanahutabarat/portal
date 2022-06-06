@props(["route"=>"", "icon"=>"fas fa-plus-circle", "title", "small"=>"", "class"=>"", "id"=>""])

@if($route)
<a href='{{$route}}'
    class='btn btn-primary {{($small=='true')? 'btn-sm' : ''}} {{$class}}'
    id='{{$id}}'
    data-toggle="tooltip"
    title="{{ $title }}">
    <i class="{{$icon}}"></i>
    {{ $slot }}
</a>
@else
<button type="submit"
    class='btn btn-primary {{($small=='true')? 'btn-sm' : ''}} {{$class}}'
    id='{{$id}}'
    data-toggle="tooltip"
    title="{{ $title }}">
    <i class="{{$icon}}"></i>
    {{ $slot }}
</button>
@endif
