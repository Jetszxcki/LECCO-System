<?php $__env->startSection('title',  $member->full_name); ?>

<?php $__env->startSection('content'); ?>
	<div class="form-group">
		<a href="<?php echo e(route('members.edit', [$member])); ?>" class="btn btn-warning">Edit</a>
	</div>

	<div class="container">
		<?php $__currentLoopData = $member->getAttributes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="row">
				<label><?php echo e($member->getColumnNameForView($column)); ?></label>
				<label><?php echo e($value); ?></label>
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/members/show.blade.php ENDPATH**/ ?>