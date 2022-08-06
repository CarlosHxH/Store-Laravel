<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="/">Simple Ecommerce</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbars"
            aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbars">
            <ul class="navbar-nav m-auto">
                <li class="nav-item active"><a class="nav-link" href="<?php echo e(route('product.index')); ?>">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo e(route('product.index')); ?>">Product</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo e(route('category.index')); ?>">Categorias</a></li>
            </ul>

            <div class="row">

                <?php if(Route::has('login')): ?>
                    <?php if(auth()->guard()->check()): ?>
                        <div class="col-auto">
                            <div class="col-auto">
                                <a class="btn btn-success btn-sm mt-1 ml-3" href="cart.html">
                                    <i class="fa fa-shopping-cart"></i> Cart
                                    <span class="badge badge-light">0</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-auto ml-3">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle text-light" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa fa-user-circle" style="font-size: 22px"></i>
                                    <span class="badge badge-light">3</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="#">profile</a></li>
                                    <li><a class="dropdown-item" href="#">Carrinho</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <form action="<?php echo e(route('logout')); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <li><button type="submit" class="dropdown-item">Logout</button></li>
                                    </form>
                                </ul>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="col-auto ml-3 btn-group">
                            <a href="<?php echo e(route('login')); ?>" class="btn btn-dark" type="button">Log in</a>
                            <?php if(Route::has('register')): ?>
                                <a href="<?php echo e(route('register')); ?>" class="btn btn-dark" type="button">Register</a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

        </div>
    </div>
</nav>
<?php /**PATH C:\Users\Carlos\Desktop\site\shop-app\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>