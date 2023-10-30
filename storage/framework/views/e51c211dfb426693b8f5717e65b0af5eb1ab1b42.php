<?php $__env->startSection('breadcrumb',$title); ?>
<?php $__env->startSection('page_level_css'); ?>
    <link href="<?php echo e(asset('/css/tagify.css')); ?>" rel="stylesheet" type="text/css">
    <link href="/plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css">
    <style>
        .tags-look .tagify__dropdown__item{
            display: inline-block;
            border-radius: 3px;
            padding: .3em .5em;
            border: 1px solid #CCC;
            background: #F3F3F3;
            margin: .2em;
            font-size: .85em;
            color: black;
            transition: 0s;
        }
        .tags-look .tagify__dropdown__item--active{
            color: black;
        }
        .tags-look .tagify__dropdown__item:hover{
            background: lightyellow;
            border-color: gold;
        }
        .disabled{
            pointer-events:none;
        }
    </style>
    <link href="/css/jqueryfilter/jquery.filer.css" rel="stylesheet">
    <link href="/css/jqueryfilter/jquery-filer.css" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('form_title' ,$title); ?>
<?php $__env->startSection('previews_button'); ?>
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/book" class="btn btn-danger">Назад</a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('form'); ?>
    <form  id="bookform" action="<?php echo e($action); ?>" method="POST" enctype="multipart/form-data">
        <?php if(!empty($book)): ?>
            <?php echo method_field('PUT'); ?>
        <?php endif; ?>
        <?php echo csrf_field(); ?>

        <div class="widget-content widget-content-area simple-pills">
            <div class="box-body">
                <div class="form-group">
                    <label>Название</label>
                    <input type="text" class="form-control" name="book_name"
                           value="<?php echo e(!empty($book) ? $book->book_name : old('book_name')); ?>" />
                </div>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <a id="audio"  data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-music"></i> Аудио
                        </a>
                    </div>
                    <input id="thumbnail" class="form-control" type="text" name="audio_file" value="<?php echo e(!empty($book) ? $book->audio_file:''); ?>">
                </div>


                <img id="holder" style="margin-top:15px;max-height:100px;">


                <div class="input-group">
                    <div class="input-group-prepend">
                        <a id="lfm" data-input="thumbnail1" data-preview="holder" class="btn btn-primary" type="button"><i class="fa fa-file"></i> Фрагмент</a>
                    </div>
                    <input id="thumbnail1" class="form-control" type="text" name="fragment" value="<?php echo e(!empty($book) ? $book->fragment_path:''); ?>">
                </div>
                <img id="holder" style="margin-top:15px;max-height:100px;">


                <div class="input-group">
                    <div class="input-group-prepend">
                        <a id="ebook_loader" data-input="thumbnail2" data-preview="holder" class="btn btn-primary" >
                            <i class="fa fa-book"></i> Электронный
                        </a>
                    </div>
                    <input id="thumbnail2" class="form-control" type="text" name="ebook" value="<?php echo e(!empty($book) ? $book->ebook_path:''); ?>">
                </div>
                <img id="holder" style="margin-top:15px;max-height:100px;">

                <div class="form-group">
                    <label>Аннотация</label>
                    <textarea name="book_description" id="editor1" class="form-control"><?php echo e(!empty($book) ? $book->book_description : old('book_description')); ?></textarea>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Издатель</label>
                            <select name="publisher_id" class="form-control">
                                <?php $__currentLoopData = $publishers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>" <?php echo e((!empty($book) && $book->publisher_id==$item->id)? 'selected':''); ?>><?php echo e($item->name_kz); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Обложка</label><br>
                            <select name="cover" id="cover" class="form-control">
                                <option <?php echo e(!empty($book) && $book->cover=='hard' ? 'selected': ''); ?> value="hard">Твердая</option>
                                <option <?php echo e(!empty($book) && $book->cover=='soft' ? 'selected': ''); ?> value="soft">Мягкая</option>
                                <option <?php echo e(!empty($book) && $book->cover=='integral' ? 'selected': ''); ?> value="integral">Интеграл</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Автор</label>
                    <input type="text" class="form-control" name="author"
                           value="<?php if(!empty($book)): ?>
                           <?php $__currentLoopData = $book->authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <?php echo e($loop->last?$item->name_kz:$item->name_kz.','); ?>

                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           <?php else: ?> <?php echo e(old('author')); ?> <?php endif; ?>" />
                </div>
                <div class="form-group">
                    <label>Переводчик</label>
                    <input type="text" class="form-control" name="translator"
                           value="<?php if(!empty($book)): ?>
                           <?php $__currentLoopData = $book->translators; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <?php echo e($loop->last?$item->name_kz:$item->name_kz.','); ?>

                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           <?php else: ?> <?php echo e(old('translator')); ?> <?php endif; ?>" />
                </div>



                <?php echo $__env->make('admin.includes.form.checkbox',['name'=>'available','label'=>'Имеется','checked'=>(!empty($book) && $book->available)?true:false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('admin.includes.form.checkbox',['id'=>'subscribable','name'=>'subscribable','label'=>'По подписке','checked'=>(!empty($book) && $book->subscribable)?true:false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('admin.includes.form.checkbox',['name'=>'free','label'=>'Бесплатно','checked'=>(!empty($book) && $book->free)?true:false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('admin.includes.form.checkbox',['name'=>'free_delivery','label'=>'Бесплатная доставка','checked'=>(!empty($book) && $book->free_delivery)?true:false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label>ISBN</label>
                            <input type="text" class="form-control" name="isbn"
                                   value="<?php echo e(!empty($book) ? $book->isbn : old('isbn')); ?>" />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label>Год выпуска</label>
                            <input type="number" class="form-control" name="year"
                                   value="<?php echo e(!empty($book) ? $book->year : old('year')); ?>" />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label>Количество страниц</label>
                            <input type="number" class="form-control" name="page_quanity"
                                   value="<?php echo e(!empty($book) ? $book->page_quanity : old('year')); ?>" />
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label>Цена бумажной версий</label>
                            <input id="paperbook_price" type="number" class="form-control" name="paperbook_price"
                                   value="<?php echo e(!empty($book) ? $book->paperbook_price : old('year')); ?>" />
                        </div>

                        <div class="form-group">
                            <label  for="is_has_sale" class="new-control new-checkbox checkbox-primary">
                                <input value="1" name="has_sale" id="is_has_sale" type="checkbox" class="new-control-input"
                                       <?php if(!empty($book) && $book->sale_percentage>0): ?> checked <?php endif; ?>>
                                <span class="new-control-indicator"></span>Есть скидка
                            </label>
                        </div>

                        <div id="sale_percentage" class="form-group" style="display: none">
                            <label>Скидка</label>
                            <input  type="number" class="form-control" name="sale_percentage" onchange="calculate(this.id)"
                                    value="<?php echo e(!empty($book) ? $book->sale_percentage : 0); ?>" />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4" id="ebook_price_wrapper">
                        <div class="form-group">
                            <label>Цена электронной версий</label>
                            <input id="ebook_price" type="number" class="form-control" name="ebook_price"
                                   value="<?php echo e(!empty($book) ? $book->ebook_price : old('year')); ?>" />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label>Цена аудиокниги</label>
                            <input id="audiobook_price" type="number" class="form-control" name="audio_price"
                                   value="<?php echo e(!empty($book) ? $book->audio_price : old('year')); ?>" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Жанр</label><br>
                    <input type="text" class="form-control" name="genre"
                           value="<?php if(!empty($book)): ?>
                           <?php $__currentLoopData = $book->genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <?php echo e($loop->last?$item->genre_name_ru:$item->genre_name_ru.','); ?>

                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           <?php else: ?> <?php echo e(old('genre')); ?> <?php endif; ?>" />
                </div>

                <div class="form-group">
                    <label>Язык</label><br>
                    <input type="radio" name="book_lang" value="ru"
                           id="is_show_yes" <?php echo e((!empty($book) && $book->book_lang == "ru") ? "checked" : "checked"); ?>>
                    <label  for="is_show_yes">Русс</label>
                    <input type="radio"  name="book_lang" value="kz"
                           id="is_show_no" <?php echo e((!empty($book) && $book->book_lang == "kz") ? "checked" : ""); ?>>
                    <label for="is_show_no">Каз</label>
                </div>
                <div class="form-group">
                    <label>К подборке</label>
                    <select name="book_collection_id" class="form-control">
                        <?php echo $__env->make('admin.layouts.collection', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="new-control new-checkbox checkbox-primary">
                        <input type="checkbox" class="new-control-input" value="1" name="send_push">
                        <span class="new-control-indicator"></span>Отправить уведомление
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label>Главная обложка</label>
                    <div class="custom-file-container" data-upload-id="myFirstImage">
                        <label>Upload (Single File) <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                        <label class="custom-file-container__custom-file" >
                            <input type="file" class="custom-file-container__custom-file__custom-file-input" name="mainimg" accept="image/*" <?php if(empty($book)): ?> required <?php endif; ?>>
                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                        </label>
                        <div class="custom-file-container__image-preview"></div>
                    </div>
                </div>

                <div class="col-6">
                    <label>Картинки</label>
                    <input type="file" name="book_image[]" id="filer_input" multiple="multiple">
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-12 text-right">
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('page_level_js'); ?>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script> $('#lfm').filemanager('file');</script>
    <script> $('#ebook_loader').filemanager('file');</script>
    <script> $('#audio').filemanager('file');</script>

    <script src="/js/fileupload.js"></script>
    <script src="<?php echo e(asset('/js/jQuery.tagify.min.js')); ?>"></script>


    <script src="/js/jqueryfilter/jquery.filer.js?v=2.123" type="text/javascript"></script>
    <script src="/js/jqueryfilter/custom.js" type="text/javascript"></script>
    <script src="/plugins/file-upload/file-upload-with-preview.min.js"></script>
    <script>
        var firstUpload = new FileUploadWithPreview('myFirstImage')
    </script>
    <?php if(isset($book)): ?>
        <script>
            $('.custom-file-container__image-preview').css('background-image','url("<?php echo e($book->images->where('is_main',1)->first()->path); ?>")');
        </script>
    <?php endif; ?>
    <script>

        $(document).ready(function(){
            $('#filer_input').filer({
                showThumbs: true,
                addMore: true,
                //templates: filer_default_opts.templates,
                allowDuplicates: false,
                <?php if(!empty($book)): ?>
                files:[
                        <?php $__currentLoopData = $book->images->where('is_main',0); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    {
                        <?php $path_parts = pathinfo($item->path); ?>
                        name: "<?php echo e($path_parts['filename'].'.'.$path_parts['extension']); ?>",
                        size: <?php echo e($item->id); ?>,
                        type: "image/jpg",
                        file: "<?php echo e($item->path); ?>",
                        url: "<?php echo e(url('/').$item->path); ?>",
                        ide: <?php echo e($item->id); ?>

                    },
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ]
                <?php endif; ?>
            });
        });

        function deleteimage(name){
            $('#bookform').append('<input  type="hidden" name="deletedimage[]" value="'+name+'" />');
        }


        $("#files1").fileUploader(filesToUpload);

        let authors=[];
        let genres=[];
        let translator=[];

        <?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        authors.push("<?php echo e($item); ?>");
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php $__currentLoopData = $genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        genres.push("<?php echo e($item); ?>");
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php $__currentLoopData = $translator; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        translator.push("<?php echo e($item); ?>");
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        $(document).ready(function() {
            $('[name=author]').tagify({
                delimiters: ",",
                pattern: null,
                maxTags: Infinity,
                callbacks: {},
                addTagOnBlur: true,
                duplicates: false,
                whitelist: authors,
                blacklist: [],
                enforceWhitelist: true,
                autoComplete: true,
                dropdown: {
                    maxItems: false,           // <- mixumum allowed rendered suggestions
                    classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
                    enabled: 0,             // <- show suggestions on focus
                    closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
                }
            });

            $('[name=genre]').tagify({
                delimiters: ",",
                pattern: null,
                maxTags: Infinity,
                callbacks: {},
                addTagOnBlur: true,
                duplicates: false,
                whitelist: genres,
                blacklist: [],
                enforceWhitelist: true,
                autoComplete: true,
                dropdown: {
                    maxItems: false,           // <- mixumum allowed rendered suggestions
                    classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
                    enabled: 0,             // <- show suggestions on focus
                    closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
                }
            });

            $('[name=translator]').tagify({
                delimiters: ",",
                pattern: null,
                maxTags: Infinity,
                callbacks: {},
                addTagOnBlur: true,
                duplicates: false,
                whitelist: translator,
                blacklist: [],
                enforceWhitelist: true,
                autoComplete: true,
                dropdown: {
                    maxItems: false,           // <- mixumum allowed rendered suggestions
                    classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
                    enabled: 0,             // <- show suggestions on focus
                    closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
                }
            });


        });
    </script>
    <script>
        $( document ).ready(function() {
            if($('#is_has_sale').is(":checked")) {
                $("#sale_percentage").show()
            }
            else{
                $("#sale_percentage").hide()
            }

            /*if($('#subscribable').is(":checked")) {
                $("#ebook_price_wrapper").hide()
            }
            else{
                $("#ebook_price_wrapper").show()
            }*/
        });

        $("#is_has_sale").change(function() {
            if(this.checked) {
                $("#sale_percentage").show()
            }
            else{
                $("#sale_percentage").hide()
            }
        });

      /*  $("#subscribable").change(function() {
            if(this.checked) {
                $("#ebook_price_wrapper").hide()
            }
            else{
                $("#ebook_price_wrapper").show()
            }
        });*/

        initSample();
    </script>

    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.config.extraPlugins = 'uploadimage';
        CKEDITOR.replace("editor1");
        CKEDITOR.config.filebrowserUploadUrl = '<?php echo e(route('ckeditor.upload', ['_token' => csrf_token() ])); ?>';
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/book/form.blade.php ENDPATH**/ ?>