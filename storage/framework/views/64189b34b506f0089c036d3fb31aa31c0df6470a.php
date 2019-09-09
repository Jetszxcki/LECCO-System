 <div class="col-md-4 mb-5">
    <div class="card">
        <div class="card-header text-center"><?php echo e($header); ?></div>

        <div class="card-body p-0">
            <?php if(session('status')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>

            <a href="<?php echo e(route($href)); ?>" class="d-flex flex-column align-items-stretch">
                <img src="<?php echo e(asset('img/' . $image)); ?>" alt="Error fetching image">
            </a>
        </div>

        
    </div>
</div><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/partials/home_panel.blade.php ENDPATH**/ ?>