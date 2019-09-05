<?php $__env->startSection('title',  $member->full_name); ?>

<?php $__env->startSection('content'); ?>
	<div class="form-group">
		<a href="<?php echo e(route('members.edit', [$member])); ?>" class="btn btn-warning">Edit</a>
	</div>

	<div class="form-group">
		<div class="row">
			<label><strong>Name:</strong><?php echo e($member->full_name); ?></label>
		</div>
		<div class="row">
			<label><strong>TIN:</strong><?php echo e($member->TIN); ?></label>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/members/show.blade.php ENDPATH**/ ?>