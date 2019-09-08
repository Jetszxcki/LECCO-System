<?php $__env->startSection('title', 'Whoops!'); ?>;

<style>
	.unauthorized-text {
		font-weight: bold; 
		font-size: 20px;
		letter-spacing: 2px;
		line-height: 40px;
	}

	.unauthorized-div {
		width: 100%;
		height: 65%;
	}
</style>

<?php $__env->startSection('content'); ?>
<div class="d-flex flex-column justify-content-center unauthorized-div">
	<div class="alert alert-warning py-5 text-center unauthorized-text">
		Operation unavailable for this user. <br>
		Contact ADMIN to enable privilege "<i><?php echo e($function->getColumnNameForView($operation)); ?></i>".
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/unauthorized.blade.php ENDPATH**/ ?>