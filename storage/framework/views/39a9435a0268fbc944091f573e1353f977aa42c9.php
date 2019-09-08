<?php $__env->startSection('title',  $member->full_name); ?>

<?php $__env->startSection('content'); ?>
	<div class="d-flex flex-row justify-content-between">
		<div class="card" style="width: 25%">
			<div class="card-header">
				<img src="<?php echo e(asset('img/' . $member->profile_picture)); ?>" alt="Problem fetching image" />
			</div>
		</div>

		<div class="card" style="width: 72%">
			<div class="card-body">
				
			</div>
		</div>
	</div>

	<div class="container bg-dark mt-3">
		<a href="<?php echo e(route('members.edit', [$member])); ?>" class="btn btn-warning">Edit</a>
		<?php $__currentLoopData = $member->getAttributes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="row">
				<label><?php echo e($member->getColumnNameForView($column)); ?></label>
				<label><?php echo e($value); ?></label>
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<div class="row">
			<a href="<?php echo e(route('shares.show', [$member])); ?>">Shares</a>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/members/show.blade.php ENDPATH**/ ?>