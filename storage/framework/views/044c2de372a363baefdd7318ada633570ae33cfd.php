<?php $__env->startSection('title', 'Add Member'); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header text-md-center">NEW MEMBER</div>
			<div class="card-body">
				<form action="<?php echo e(route('members.store')); ?>" method="POST">
					<?php echo $__env->make('partials.form', [compact('columns'), 'route' => 'members.index', 'buttonText' => 'Add Member'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</form>	
			</div>
		</div>
	</div>	
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/members/create.blade.php ENDPATH**/ ?>