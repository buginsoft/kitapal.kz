<div class="custom-file-container" data-upload-id="mySecondImage">
    <label>Галерея <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Удалить">x</a></label>
    <label class="custom-file-container__custom-file" >
        <input name="{{$name}}[]" id="chat-file" type="file" class="custom-file-container__custom-file__custom-file-input" multiple>
        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
        <span class="custom-file-container__custom-file__custom-file-control"></span>
    </label>
    <div class="custom-file-container__image-preview"></div>
</div>

<input type="file" id="files" name="files[]" multiple><br><br>

<script>
    
///var secondUpload = new FileUploadWithPreview('mySecondImage')
</script>
