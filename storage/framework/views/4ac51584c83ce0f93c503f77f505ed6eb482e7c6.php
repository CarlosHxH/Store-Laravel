<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/create.css')); ?>">

    <div class="container">
        <section class="main-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="content-box">
                            <h2 class="text-center">Adicionar Produto</h2>

                            <form id="file_form" class="form-signin" method="post" enctype="multipart/form-data">

                                <div class="form-inline form-control form-label-group">
                                    <input id="files" type="file" class="" name="files" hidden>
                                    <label id="video_image_label" for="files"
                                        class="form-control"><i class="fas fa-image"></i> Select Image </label>
                                </div>

                                <section class="file-area mt-3 mb-1">
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-lg-12 text-center">
                                                <ul class="image-list mb-1"></ul>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <ul id="status" class="text-center"></ul>

                                <div class="row">
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="mb-3">
                                            <label for="product" class="form-label">Produto</label>
                                            <input type="text" value="Camisa" class="form-control" id="product"
                                                placeholder="Produto" aria-label="Produto">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <label for="product" class="form-label">Preço</label>
                                        <input type="number" id="price" class="form-control" placeholder="Preço"
                                            aria-label="Preço">
                                    </div>

                                    <div class="col-lg-3 col-sm-6">
                                        <label for="stock" class="form-label">Estoque</label>
                                        <input type="number" id="stock" class="form-control" placeholder="Estoque"
                                            aria-label="stock">
                                    </div>

                                    <div class="col-lg-3 col-sm-6">
                                        <label for="category" class="form-label">Categoria</label>
                                        <select id="category" class="form-select">
                                            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-2">
                                            <label for="description" class="form-label">Descrição</label>
                                            <textarea class="form-control" id="description" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-inline form-control">
                                    <button id="generate" type="submit" class="btn btn-search">
                                        <i class="fas fa-cloud-upload-alt"></i> Upload
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function() {
            var selected_files = [];
            if (window.File && window.FileList && window.FileReader) {
                $(document).on("change", "#files", function(e) {
                    $('#status').html('');
                    if (e.target.value != '') $('.file-area').css('display', 'block');
                    var image_list = $(".image-list");
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        selected_files.splice(i, 1);
                        selected_files.push(f)
                        var fileReader = new FileReader();
                        fileReader.fileName = f.name;
                        fileReader.onload = (function(e) {
                            single_image =
                            $("<li class='single_image'>" +
                                "<img class='image_thumb' src='" + e.target.result +"' title='" + e.target.fileName + "'/>" +
                                    "<span data-file_name='" + e.target.fileName +"' class='remove_image'>"+
                                        "<i class='far fa-trash-alt'></i>"+
                                    "</span>" +
                                "</li>");
                            image_list.html(single_image);
                        });
                        fileReader.readAsDataURL(f);
                    }
                });

            } else {
                alert("Your browser doesn't support to File API")
            }

            $(document).on('click', '.remove_image', function() {
                remove_file = $(this).data('file_name');
                for (var i = 0; i < selected_files.length; i++) {
                    if (selected_files[i].name === remove_file) {
                        selected_files.splice(i, 1);
                        break;
                    }
                }
                $(this).parent(".single_image").remove();
            });

            $(document).ready(function() {
                $("form").submit(function(e) {
                    e.preventDefault();

                    file_area = $('.file-area');
                    progressbar = $('.progress-bar');
                    status_bar = $('#status');
                    image_list = $(".image-list");
                    status_bar.css('display', 'block');
                    status_bar.html('<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>');
                    if (selected_files.length < 1) {
                        status_bar.html('<li class="error">Please select file</li>');
                    } else {
                        var formData = new FormData();
                        for (var i = 0, len = selected_files.length; i < len; i++) {
                            formData.append('all_files[]', selected_files[i]);
                        }
                        formData.append("name", $("#product").val());
                        formData.append("price", $("#price").val());
                        formData.append("stock", $("#stock").val());
                        formData.append("category", $("#category").val());
                        formData.append("description", $("#description").val());
                        formData.append("_token", "<?php echo e(csrf_token()); ?>");
                        fiel_feild = $('#files');

                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '<?php echo e(route('product.store')); ?>',
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            cache: false,
                            processData: false,
                            encode: true,
                            success: function(result) {
                                if (result) {
                                    selected_files = [];
                                    image_list.html('');
                                    file_area.css('display', 'none');
                                    status_bar.html('<li class="success">File uploaded successfully.</li>');
                                } else {
                                    status_bar.html('Erro ao enviar.');
                                }
                            }
                        });
                        return false;
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Carlos\Desktop\site\shop-app\resources\views/product/create.blade.php ENDPATH**/ ?>