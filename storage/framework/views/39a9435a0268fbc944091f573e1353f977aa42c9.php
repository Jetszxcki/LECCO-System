<?php $__env->startSection('title',  $member->full_name); ?>

<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('partials.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<div class="d-flex flex-row justify-content-between">
		<div class="card" style="width: 25%">
			<div class="card-header">
				<img class="static-img" src="<?php echo e(asset('images/' . $member->profile_picture)); ?>" />
			</div>
		</div>

		<div class="card" style="width: 72%">
			<div class="card-body">
				
			</div>
		</div>
	</div>

	<div class="container bg-dark mt-3">
		<?php if (\Illuminate\Support\Facades\Blade::check('accessright', 'member_edit')): ?>
			<a href="<?php echo e(route('members.edit', [$member])); ?>" class="btn btn-warning">Edit</a>
		<?php endif; ?>
		
		<?php if (\Illuminate\Support\Facades\Blade::check('accessright', 'member_delete')): ?>
			<form action="<?php echo e(route('members.destroy', [$member])); ?>" method="POST">
				<?php echo method_field('DELETE'); ?>
				<?php echo csrf_field(); ?>

				<button type="submit" class="btn btn-danger">Delete</button>
			</form>
		<?php endif; ?>

		<?php $__currentLoopData = $member->getAttributes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="row">
				<label><?php echo e($member->getColumnNameForView($column)); ?></label>
				<label><?php echo e($value); ?></label>
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<div class="row">
			<?php if (\Illuminate\Support\Facades\Blade::check('accessright', 'shares_view')): ?>
				<a href="<?php echo e(route('shares.show', ['member' => $member])); ?>" class="btn btn-primary">Shares</a>
			<?php endif; ?>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/members/show.blade.php ENDPATH**/ ?>