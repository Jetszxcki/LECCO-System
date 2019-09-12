<?php $__env->startSection('title', 'Loans'); ?>

<?php $__env->startSection('content'); ?>
	<div class="form-group d-flex flex-row justify-content-between align-items-center">
		<h2>Loans</h2>

		<?php if (\Illuminate\Support\Facades\Blade::check('accessright', 'loans_create')): ?>
			<a href="<?php echo e(route('loans.create')); ?>" class="btn btn-primary">Add Loan</a>
		<?php endif; ?>

		<?php echo $__env->make('partials.search_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>

	<?php echo $__env->make('partials.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<table class="container" id="main-table">
		<tr id="theader" class="d-flex p-1 mb-3 text-center">
			<?php if($loans->isEmpty()): ?>
				<th nosearch class="col text-center py-5">No loans added yet.</th>
			<?php else: ?>
				<th nosearch class="col-md-1">ID</th>
				<th nosearch class="col-md-2">Member</th>
				<th nosearch class="col-md-2">Loan Type</th>
				<th nosearch class="col-md-1">Amount</th>
				<th nosearch class="col-md-2">Start of Payment</th>
				<th nosearch class="col-md-1">Terms</th>
				<th nosearch class="col d-flex flex-row justify-content-center">Actions</th>
			<?php endif; ?>
		</tr>

		<?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr class="p-1 mb-2 text-center">
				<td nosearch class="col-md-1"><?php echo e($loan->id); ?></td>
				<td class="col-md-2"><?php echo e($loan->member->full_name); ?></td>
				<td class="col-md-2"><?php echo e($loan->loan_type); ?></td>
				<td class="col-md-1"><?php echo e($loan->amount); ?></td>
				<td class="col-md-2"><?php echo e($loan->start_of_payment); ?></td>
				<td class="col-md-1"><?php echo e($loan->term); ?></td>

				<td nosearch class="col d-flex flex-row align-items-center justify-content-center">
					<?php if (\Illuminate\Support\Facades\Blade::check('accessright', 'loans_view')): ?>
						<a href="<?php echo e(route('loans.show', [$loan])); ?>" class="btn btn-success mr-1">View</a>
					<?php endif; ?>

					<?php if (\Illuminate\Support\Facades\Blade::check('accessright', 'loans_edit')): ?>
						<a href="" class="btn btn-warning mr-1">Edit</a>
					<?php endif; ?>

					<?php if (\Illuminate\Support\Facades\Blade::check('accessright', 'loans_delete')): ?>
						<form action="" method="POST">
							<?php echo method_field('DELETE'); ?>
							<?php echo csrf_field(); ?>

							<button type="submit" class="btn btn-danger">Delete</button>
						</form>
					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		<?php echo $__env->make('partials.search_not_found', ['model' => $loans], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/loans/index.blade.php ENDPATH**/ ?>