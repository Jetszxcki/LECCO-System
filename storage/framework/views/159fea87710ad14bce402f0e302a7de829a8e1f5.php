<?php $__env->startSection('title', 'Shares'); ?>

<?php $__env->startSection('content'); ?>
	<div class="form-group d-flex flex-row justify-content-between align-items-center">
		<h2>Shares</h2>
		<a href="<?php echo e(route('shares.create')); ?>" class="btn btn-primary">Add Share</a>

		<?php echo $__env->make('partials.search_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>

	<table class="container" id="main-table">
		<tr id="theader" class="d-flex p-1 mb-3 text-center">
			<?php if($shares->isEmpty()): ?>
				<th nosearch class="col text-center py-5">No shares added yet.</th>
			<?php else: ?>
				<th nosearch class="col-md-1">ID</th>
				<th nosearch class="col-md-5">Member</th>
				<th nosearch class="col-md-2">Total</th>
				<th nosearch class="col-md-2">Amount</th>
				<th nosearch class="col-md-2">Price</th>
			<?php endif; ?>
		</tr>

		<?php $__currentLoopData = $shares; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $share): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr class="p-1 mb-2 text-center">
				<td nosearch class="col-md-1"><?php echo e($share->id); ?></td>
				<td class="col-md-5"><?php echo e($share->member->full_name); ?></td>
				<td class="col-md-2"><?php echo e($share->total); ?></td>
				<td class="col-md-2"><?php echo e($share->amount); ?></td>
				<td class="col-md-2"><?php echo e($share->price); ?></td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		<?php echo $__env->make('partials.not_found_alert', ['model' => $shares], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/shares/index.blade.php ENDPATH**/ ?>