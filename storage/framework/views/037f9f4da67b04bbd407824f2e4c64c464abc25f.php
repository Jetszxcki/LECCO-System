<?php if(session('message')): ?>
	<div class="alert ls-1 <?php if(session('styles')): ?> <?php echo e(session('styles')); ?> <?php endif; ?>">
		<?php echo e(session('message')); ?>

	</div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/partials/success.blade.php ENDPATH**/ ?>