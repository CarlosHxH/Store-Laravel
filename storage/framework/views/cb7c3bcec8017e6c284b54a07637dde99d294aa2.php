<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo e(asset('css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/shopping.css')); ?>">

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>
</head>

<body>

    <?php $__env->startComponent('layouts.navbar'); ?><?php echo $__env->renderComponent(); ?>
    <?php $__env->startComponent('layouts.carousel'); ?><?php echo $__env->renderComponent(); ?>

    <div class="container my-2 pt-3 align-text-bottom" style="background-color: #e9ecef;">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Produtos</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-3">
                <form class="row mb-2 g-3">
                    <div class="col-12">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search...">
                            <div class="input-group-text">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="card bg-light mb-3">
                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#categories" role="button" aria-expanded="false" aria-controls="categories">
                        <div class="card-header bg-primary text-white text-uppercase">
                            <i class="fa fa-list"></i>Categorias
                        </div>
                    </a>
                    <ul class="accordion-collapse collapse show list-group" id="categories">
                        <a class="list-group-item list-group-item-action" href="/">Todos os produtos</a>
                        <div id="cat">
                            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a class="list-group-item list-group-item-action" href="/view/<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <p class="text text-center"><?php echo e($category->links('layouts.paginate')); ?></p>
                    </ul>
                </div>
            </div>

            <div id="products" class="col">
                <div class="row">

                    <div class="d-flex justify-content-end">
                        <div class="mt-3"><?php echo e($product->links('pagination::bootstrap-4')); ?></div>
                    </div>

                    <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 col-sm-6 mb-2">
                            <div class="product-grid border border-light border-2 p-2">
                                <div class="product-image3">
                                    <a href="#">
                                        <img class="pic" src="<?php echo e($prod->file); ?>">
                                    </a>
                                    <ul class="social">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                    <span class="product-new-label">New</span>
                                </div>
                                <div class="product-content">
                                    <h3 class="title"><a href="<?php echo e($prod->id); ?>"><?php echo e($prod->name); ?></a></h3>
                                    <div class="price">
                                        R$ <?php echo e($prod->price); ?>

                                        <span></span>
                                    </div>
                                    <ul class="rating">
                                        <li class="fa fa-star <?php echo e($prod->star <= 0?'disable':''); ?>"></li>
                                        <li class="fa fa-star <?php echo e($prod->star <= 1?'disable':''); ?>"></li>
                                        <li class="fa fa-star <?php echo e($prod->star <= 2?'disable':''); ?>"></li>
                                        <li class="fa fa-star <?php echo e($prod->star <= 3?'disable':''); ?>"></li>
                                        <li class="fa fa-star <?php echo e($prod->star <= 4?'disable':''); ?>"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div class="d-flex justify-content-end">
                        <div class="mt-3"><?php echo e($product->links('pagination::bootstrap-4')); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->startComponent('layouts.footer'); ?><?php echo $__env->renderComponent(); ?>
</body>
</html>
<?php /**PATH C:\Users\Carlos\Desktop\site\shop-app\resources\views/product/index.blade.php ENDPATH**/ ?>