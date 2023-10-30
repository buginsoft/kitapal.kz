<div class="form-group">
    <label class="new-control new-checkbox checkbox-primary">
        <input @if(isset($id)) id="{{$id}}" @endif type="checkbox" class="new-control-input" value="1" name="{{$name}}"
               @if(isset($checked) && $checked) checked @endif>
        <span class="new-control-indicator"></span>{{$label}}
    </label>
</div>
