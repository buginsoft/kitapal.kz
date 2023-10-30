<div class="form-group">
    @if(isset($label))
        <label for="{{$name}}">{{$label}}</label>
    @endif
    <textarea name="{{$name}}" @if(isset($id)) id="{{$id}}" @endif class="form-control @if(isset($class)) {{$class}} @endif">{{ $value }}</textarea>
</div>
