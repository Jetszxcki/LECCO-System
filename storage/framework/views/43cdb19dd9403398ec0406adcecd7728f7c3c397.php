<?php $__env->startSection('title', 'Restricted Access'); ?>;

<style>
	.unauthorized-text {
		/*font-weight: bold; */
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
		You may not have the following privileges:
		<div>
			<?php $__currentLoopData = $access_rights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $access_right): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div>
					<i><?php echo e($user->getColumnNameForView($access_right)); ?></i>
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
		<br> 
		<small>
			<b>Contact ADMIN if you are authorized to do such operations.</b>
		</small>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/unauthorized.blade.php ENDPATH**/ ?>