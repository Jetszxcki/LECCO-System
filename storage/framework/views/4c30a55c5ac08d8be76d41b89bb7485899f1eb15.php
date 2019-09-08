<?php $__env->startSection('title', $share->member->full_name . ' - Shares'); ?>

<?php $__env->startSection('content'); ?>
	<div class="form-group text-center">
		<h3 style="color: white"><?php echo e('Shares of ' . $share->member->full_name); ?></h3>
	</div>

	<table class="container" id="main-table">
		<tr id="theader" class="d-flex p-1 mb-3 text-center">
			<?php if($shares->isEmpty()): ?>
				<th nosearch class="col text-center py-5">No shares yet.</th>
			<?php else: ?>
				<th nosearch class="col-md-2">Month</th>
				<th nosearch class="col-md-1">Year</th>
				<th nosearch class="col-md-3">Total No. of Shares</th>
				<th nosearch class="col-md-3">Total Price</th>
				<th nosearch class="col-md-3">Total Amount</th>
			<?php endif; ?>
		</tr>

		<?php $__currentLoopData = $shares; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $share): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr class="p-1 mb-2 text-center">
				<td class="col-md-2"><?php echo e(DateTime::createFromFormat('!m', $share->month)->format('F')); ?></td>
				<td class="col-md-1"><?php echo e($share->year); ?></td>
				<td class="col-md-3"><?php echo e($share->total_no_shares); ?></td>
				<td class="col-md-3"><?php echo e($share->total_price); ?></td>
				<td class="col-md-3"><?php echo e($share->total_amount); ?></td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		<tr id="theader" class="d-flex p-1 text-center" style="background: white;">
			<th nosearch class="col-md-3 c-black">Total:</th>
			<th nosearch class="col-md-3 c-black"><?php echo e($totals[0]); ?></th>
			<th nosearch class="col-md-3 c-black"><?php echo e($totals[1]); ?></th>
			<th nosearch class="col-md-3 c-black"><?php echo e($totals[2]); ?></th>
		</tr>

		<?php echo $__env->make('partials.not_found_alert', ['model' => $shares], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/shares/show.blade.php ENDPATH**/ ?>