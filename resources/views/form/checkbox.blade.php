<div class="form-group">
    <label  for="is_has_sale" class="new-control new-checkbox checkbox-primary">
        <input value="1" name="has_sale" id="is_has_sale" type="checkbox" class="new-control-input"
               @if(!empty($book) && $book->sale_percentage>0) checked @endif>
        <span class="new-control-indicator"></span>Есть скидка
    </label>
</div>
