<?php $__env->startSection('title', $model->name . ' - Edit'); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header text-md-center"><?php echo e($model->name); ?></div>
			<div class="card-body">
				<form action="<?php echo e(route('loan_types.update', [$model])); ?>" method="POST">
					<?php echo method_field('PATCH'); ?>
					<?php echo csrf_field(); ?>

					<?php echo $__env->make('partials.form', ['columns' => $columns, 'route' => 'previous', 'buttonText' => 'Save Changes'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</form>	
			</div>
		</div>
	</div>	
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/loan_types/edit.blade.php ENDPATH**/ ?>