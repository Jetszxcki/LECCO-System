<h5 style="letter-spacing: 2px;"><?php echo e($header); ?></h5>

<div class="custom-control custom-checkbox d-flex flex-wrap align-items-center alert alert-info mb-4">
	<?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if(($user->access_right->hasPrefix($header, $column) && $column != 'user_id')
			|| ($user->access_right->hasPrefix($header, 'user') && $column == 'invoke_rights')): ?>

			<div class="d-flex flex-row col-md-3 align-items-center py-2">
				<input type="checkbox" id="<?php echo e($column); ?>" name="<?php echo e($column); ?>" value="<?php echo e($user->access_right[$column]); ?>" class="custom-control-input" <?php echo e($user->access_right[$column] ? 'checked' : ''); ?>>

				<label class="custom-control-label" for="<?php echo e($column); ?>"><?php echo e($user->access_right->toSuffix($column)); ?></label>
			</div>

		<?php endif; ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/partials/access_right_checkboxes.blade.php ENDPATH**/ ?>