<?php $__env->startSection('title', 'Add Loan Type'); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header text-md-center">NEW LOAN TYPE</div>
			<div class="card-body">
				<form action="<?php echo e(route('loan_types.store')); ?>" method="POST">
					<?php echo $__env->make('partials.form', [compact('columns'), 'route' => 'loan_types.index', 'buttonText' => 'Add Loan Type'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</form>	
			</div>
		</div>
	</div>	
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/loan_types/create.blade.php ENDPATH**/ ?>