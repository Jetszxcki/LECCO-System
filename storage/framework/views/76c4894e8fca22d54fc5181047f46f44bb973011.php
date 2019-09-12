<?php $__env->startSection('title', 'Add Loan'); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header text-md-center">NEW LOAN</div>
			<div class="card-body">
				<form action="<?php echo e(route('loans.store')); ?>" method="POST" enctype="multipart/form-data">
					<?php echo $__env->make('partials.form', [compact('columns'), 'route' => 'loans.index', 'buttonText' => 'Add Loan'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</form>	
			</div>
		</div>
	</div>	
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/loans/create.blade.php ENDPATH**/ ?>