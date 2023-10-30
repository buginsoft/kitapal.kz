<div class="form-group">
    @if(isset($label))
        <label for="{{$name}}">{{$label}}</label>
    @endif
    <input type="{{$type}}" @if(isset($id)) id="{{$id}}" @endif class="form-control @if(isset($class)) {{$class}} @endif"
           name="{{$name}}" @if(isset($placeholder)) placeholder="{{$placeholder}}" @endif value="{{$value}}"/>
</div>
