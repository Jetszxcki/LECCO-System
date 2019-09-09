<?php $__env->startSection('title', $user->name . ' - Edit Privileges'); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header text-md-center"><?php echo e($user->name); ?></div>
			<div class="card-body">
				<form action="<?php echo e(route('users.update_rights', [$user])); ?>" method="POST">
					<?php echo method_field('PATCH'); ?>
					<?php echo csrf_field(); ?>

					

					<?php echo $__env->make('partials.access_right_checkboxes', ['header' => 'USER'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					<?php echo $__env->make('partials.access_right_checkboxes', ['header' => 'MEMBER'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					<?php echo $__env->make('partials.access_right_checkboxes', ['header' => 'LOAN TYPES'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					<?php echo $__env->make('partials.access_right_checkboxes', ['header' => 'SHARES'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					<?php echo $__env->make('partials.access_right_checkboxes', ['header' => 'SIGNATORIES'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

					<div class="form-group row mb-0">
					    <div class="col-md-6 offset-md-4">
							<button type="submit" class="btn btn-primary">Save Changes</button>
							<a href="<?php echo e(route('users.index')); ?>" class="btn btn-danger">Cancel</a>
						</div>
					</div>
				</form>	
			</div>
		</div>
	</div>	
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/users/show_rights.blade.php ENDPATH**/ ?>