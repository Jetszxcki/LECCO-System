<?php $__env->startSection('title', 'Signatories'); ?>

<?php $__env->startSection('content'); ?>
	<div class="form-group d-flex flex-row justify-content-between align-items-center">
		<h2>Signatories</h2>

		<?php if (\Illuminate\Support\Facades\Blade::check('accessright', 'signatories_create')): ?>
			<a href="<?php echo e(route('signatories.create')); ?>" class="btn btn-primary">Add Signatory</a>
		<?php endif; ?>

		<?php echo $__env->make('partials.search_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>

	<?php echo $__env->make('partials.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<table class="container" id="main-table">
		<tr id="theader" class="d-flex p-1 mb-3 text-center">
			<?php if($signatories->isEmpty()): ?>
				<th nosearch class="col text-center py-5">No signatories added yet.</th>
			<?php else: ?>
				<th nosearch class="col-md-1">ID</th>
				<th nosearch class="col-md-4">Name</th>
				<th nosearch class="col-md-4">Designation</th>
				<th nosearch class="col-md-3 d-flex flex-row justify-content-center">Actions</th>
			<?php endif; ?>
		</tr>

		<?php $__currentLoopData = $signatories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $signatory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr class="p-1 mb-2 text-center">
				<td nosearch class="col-md-1"><?php echo e($signatory->id); ?></td>
				<td class="col-md-4"><?php echo e($signatory->name); ?></td>
				<td class="col-md-4"><?php echo e($signatory->designation); ?></td>
				<td nosearch class="col-md-3 d-flex flex-row align-items-center justify-content-center">

				<?php if (\Illuminate\Support\Facades\Blade::check('accessright', 'signatories_edit')): ?>
					<a href="<?php echo e(route('signatories.edit', [$signatory])); ?>" class="btn btn-warning mr-1">Edit</a>
				<?php endif; ?>

				<?php if (\Illuminate\Support\Facades\Blade::check('accessright', 'signatories_delete')): ?>
					<form action="<?php echo e(route('signatories.destroy', [$signatory])); ?>" method="POST">
						<?php echo method_field('DELETE'); ?>
						<?php echo csrf_field(); ?>

						<button type="submit" class="btn btn-danger">Delete</button>
					</form>
				<?php endif; ?>

				</td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		<?php echo $__env->make('partials.search_not_found', ['model' => $signatories], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/signatories/index.blade.php ENDPATH**/ ?>