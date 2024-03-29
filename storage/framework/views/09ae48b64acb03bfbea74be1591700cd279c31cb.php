<?php $__env->startSection('title',  $loan_type->name); ?>

<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('partials.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<div class="form-group">
		<?php if (\Illuminate\Support\Facades\Blade::check('accessright', 'loan_types_edit')): ?>
			<a href="<?php echo e(route('loan_types.edit', [$loan_type])); ?>" class="btn btn-warning">Edit</a>
		<?php endif; ?>

		<?php if (\Illuminate\Support\Facades\Blade::check('accessright', 'loan_types_delete')): ?>
			<form action="<?php echo e(route('loan_types.destroy', [$loan_type])); ?>" method="POST">
				<?php echo method_field('DELETE'); ?>
				<?php echo csrf_field(); ?>

				<button type="submit" class="btn btn-danger">Delete</button>
			</form>
		<?php endif; ?>
	</div>

	<div class="container">
		<?php $__currentLoopData = $loan_type->getAttributes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="row">
				<label><?php echo e($loan_type->getColumnNameForView($column)); ?></label>
				<label><?php echo e($value); ?></label>
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/loan_types/show.blade.php ENDPATH**/ ?>