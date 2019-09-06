<?php $__env->startSection('title', 'Signatories'); ?>

<?php $__env->startSection('content'); ?>
	<div class="form-group d-flex flex-row justify-content-between">
		<a href="<?php echo e(route('signatories.create')); ?>" class="btn btn-primary">Add Signatory</a>

		<?php echo $__env->make('partials.search_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>

	<table class="container" id="main-table">
		<tr id="theader" class="d-flex p-1 mb-2">
			<?php if($signatories->isEmpty()): ?>
				<th nosearch class="col text-center py-5">No record of signatories yet.</th>
			<?php else: ?>
				<th nosearch class="col-md-1">ID</th>
				<th nosearch class="col-md-4">Name</th>
				<th nosearch class="col-md-4">Designation</th>
				<th nosearch class="col-md-3 d-flex flex-row justify-content-center">Actions</th>
			<?php endif; ?>
		</tr>

		<?php $__currentLoopData = $signatories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $signatory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr class="p-1 mb-2">
				<td nosearch class="col-md-1"><?php echo e($signatory->id); ?></td>
				<td class="col-md-4"><?php echo e($signatory->name); ?></td>
				<td class="col-md-4"><?php echo e($signatory->designation); ?></td>
				<td nosearch class="col-md-3 d-flex flex-row align-items-center justify-content-center">
					<a href="<?php echo e(route('signatories.edit', [$signatory])); ?>" class="btn btn-warning mr-1">Edit</a>
					<form action="<?php echo e(route('signatories.destroy', [$signatory])); ?>" method="POST">
						<?php echo method_field('DELETE'); ?>
						<?php echo csrf_field(); ?>

						<button type="submit" class="btn btn-danger">Delete</button>
					</form>
				</td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		<?php if(! $signatories->isEmpty()): ?>
			<tr id="no-record" class="col text-center py-5" style="display: none">
				<th nosearch class="col text-center">No record</th>
			</tr>
		<?php endif; ?>
	</table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/signatories/index.blade.php ENDPATH**/ ?>