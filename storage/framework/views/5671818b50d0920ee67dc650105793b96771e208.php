<?php if($paginator->hasPages()): ?>
    <nav class="text-center m-auto">
        <ul class="pagination">
            
            <?php if($paginator->onFirstPage()): ?>
                <li class="page-item active">
                    <button class="page-link">
                        <i class="fa-solid fa-arrow-left-long"></i>
                    </button>
                </li>
            <?php else: ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev">
                        <i class="fa-solid fa-arrow-left-long"></i>
                    </a>
                </li>
            <?php endif; ?>

            
            <?php if($paginator->hasMorePages()): ?>
            <li class="page-item">
                <a class="page-link"  href="<?php echo e($paginator->nextPageUrl()); ?>">
                    <i class="fa-solid fa-arrow-right-long"></i>
                </a>
            </li>
            <?php else: ?>
                <li class="page-item active">
                    <button class="page-link" rel="next">
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </button>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>
<?php /**PATH C:\Users\Carlos\Desktop\site\shop-app\resources\views/layouts/paginate.blade.php ENDPATH**/ ?>