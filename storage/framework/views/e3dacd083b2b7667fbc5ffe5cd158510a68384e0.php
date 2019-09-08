<?php $__env->startSection('title', 'Loan Types'); ?>

<?php $__env->startSection('content'); ?>
	<div class="form-group d-flex flex-row justify-content-between align-items-center">
		<h2>Loan Types</h2>

		<?php if (\Illuminate\Support\Facades\Blade::check('accessright', 'loan_types_create')): ?>
			<a href="<?php echo e(route('loan_types.create')); ?>" class="btn btn-primary">Add Loan Type</a>
		<?php endif; ?>

		<?php echo $__env->make('partials.search_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>

	<table class="container" id="main-table">
		<tr id="theader" class="d-flex p-1 mb-3 text-center">
			<?php if($loan_types->isEmpty()): ?>
				<th nosearch class="col text-center py-5">No loan types added yet.</th>
			<?php else: ?>
				<th nosearch class="col-md-1">ID</th>
				<th nosearch class="col-md-6">Name</th>
				<th nosearch class="col d-flex flex-row justify-content-center">Actions</th>
			<?php endif; ?>
		</tr>

		<?php $__currentLoopData = $loan_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr class="p-1 mb-2 text-center">
				<td nosearch class="col-md-1"><?php echo e($loan_type->id); ?></td>
				<td class="col-md-6"><?php echo e($loan_type->name); ?></td>
				<td nosearch class="col d-flex flex-row align-items-center justify-content-center">
					<?php if (\Illuminate\Support\Facades\Blade::check('accessright', 'loan_types_view')): ?>
						<a href="<?php echo e(route('loan_types.show', [$loan_type])); ?>" class="btn btn-success mr-1">View</a>
					<?php endif; ?>

					<?php if (\Illuminate\Support\Facades\Blade::check('accessright', 'loan_types_edit')): ?>
						<a href="<?php echo e(route('loan_types.edit', [$loan_type])); ?>" class="btn btn-warning mr-1">Edit</a>
					<?php endif; ?>

					<?php if (\Illuminate\Support\Facades\Blade::check('accessright', 'loan_types_delete')): ?>
						<form action="<?php echo e(route('loan_types.destroy', [$loan_type])); ?>" method="POST">
							<?php echo method_field('DELETE'); ?>
							<?php echo csrf_field(); ?>

							<button type="submit" class="btn btn-danger">Delete</button>
						</form>
					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		<?php echo $__env->make('partials.not_found_alert', ['model' => $loan_types], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/loan_types/index.blade.php ENDPATH**/ ?>