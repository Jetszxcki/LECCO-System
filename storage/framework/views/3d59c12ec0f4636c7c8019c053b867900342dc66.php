<?php $__env->startSection('title', 'Members'); ?>

<?php $__env->startSection('content'); ?>
	<div class="form-group d-flex flex-row justify-content-between">
		<a href="<?php echo e(route('members.create')); ?>" class="btn btn-primary">Add Member</a>

		<?php echo $__env->make('partials.search_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>

	<table class="container" id="main-table">
		<tr id="theader" class="d-flex p-1 mb-2">
			<?php if($members->isEmpty()): ?>
				<th nosearch class="col text-center py-5">No record of members yet.</th>
			<?php else: ?>
				<th nosearch class="col-md-1">ID</th>
				<th nosearch class="col-md-5">Name</th>
				<th nosearch class="col d-flex flex-row justify-content-center">Actions</th>
			<?php endif; ?>
		</tr>

		<?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr class="p-1 mb-2">
				<td nosearch class="col-md-1"><?php echo e($member->id); ?></td>
				<td class="col-md-5"><?php echo e($member->full_name); ?></td>
				<td nosearch class="col d-flex flex-row align-items-center justify-content-center">
					<a href="<?php echo e(route('members.show', [$member])); ?>" class="btn btn-primary">View</a>
				</td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		<?php if(! $members->isEmpty()): ?>
			<tr id="no-record" class="col text-center py-5" style="display: none">
				<th nosearch class="col text-center">No record</th>
			</tr>
		<?php endif; ?>
	</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/members/index.blade.php ENDPATH**/ ?>