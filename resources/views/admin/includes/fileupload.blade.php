<div class="custom-file-container" data-upload-id="myFirstImage">
    <label>Картинка
        <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">
            x
        </a>
    </label>
    <label class="custom-file-container__custom-file" >
        <input name="{{$name}}" type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
        <span class="custom-file-container__custom-file__custom-file-control"></span>
    </label>
    <div class="custom-file-container__image-preview"></div>
</div>