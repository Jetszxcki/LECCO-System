<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>

    <div class="d-flex flex-wrap scrolling-wrapper">
        

        <?php if (\Illuminate\Support\Facades\Blade::check('accessright', 'user_view_list')): ?>
            <?php echo $__env->make('partials.home_panel', ['header' => 'USERS', 'href' => 'users.index', 'image' => 'user.jpg'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <?php if (\Illuminate\Support\Facades\Blade::check('accessright', 'member_view_list')): ?>
            <?php echo $__env->make('partials.home_panel', ['header' => 'MEMBERS', 'href' => 'members.index', 'image' => 'user.jpg'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        

        <?php if (\Illuminate\Support\Facades\Blade::check('accessright', 'loan_types_view_list')): ?>
            <?php echo $__env->make('partials.home_panel', ['header' => 'LOAN TYPES', 'href' => 'loan_types.index', 'image' => 'user.jpg'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <?php if (\Illuminate\Support\Facades\Blade::check('accessright', 'shares_view_list')): ?>
            <?php echo $__env->make('partials.home_panel', ['header' => 'SHARES', 'href' => 'shares.index', 'image' => 'user.jpg'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        

        <?php if (\Illuminate\Support\Facades\Blade::check('accessright', 'signatories_view_list')): ?>
            <?php echo $__env->make('partials.home_panel', ['header' => 'SIGNATORIES', 'href' => 'signatories.index', 'image' => 'user.jpg'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        
        




    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/home.blade.php ENDPATH**/ ?>