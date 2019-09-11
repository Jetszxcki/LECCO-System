<?php if(session('message')): ?>
	<div class="alert ls-1 <?php if(session('styles')): ?> <?php echo e(session('styles')); ?> <?php endif; ?>">
		<span><?php echo e(session('message')); ?></span>
		<button type="button" class="close" data-dismiss="alert">×</button>
	</div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/partials/flash.blade.php ENDPATH**/ ?>