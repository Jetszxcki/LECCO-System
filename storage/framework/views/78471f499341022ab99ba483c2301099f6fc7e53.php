<?php echo csrf_field(); ?>

<?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column_name => $column_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php if($column_name != 'id' && $column_name !='created_at' && $column_name != 'updated_at'): ?>
		<div class="form-group row">	
	 		<label for="<?php echo e($cname = $member->getColumnNameForView($column_name)); ?>" class="col-md-4 col-form-label text-md-right"><?php echo e($cname); ?></label>

			<div class="col-md-6">
				<?php if($column_type == 'integer'): ?>
						<input type="number" name="<?php echo e($column_name); ?>" class="form-control <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old($column_name) ?? $member[$column_name]); ?>">
				<?php elseif($column_type == 'string'): ?>
					<?php if($column_name == 'profile_picture'): ?>
						<input type="file" name="<?php echo e($column_name); ?>" class="form-control-file <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old($column_name) ?? $member[$column_name]); ?>">
					<?php else: ?>
						<input type="text" name="<?php echo e($column_name); ?>" class="form-control <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old($column_name) ?? $member[$column_name]); ?>">
					<?php endif; ?>
				<?php elseif($column_type == 'date'): ?>
					<input type="date" name="<?php echo e($column_name); ?>" class="form-control <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old($column_name) ?? $member[$column_name]); ?>">
				<?php elseif($column_type == 'decimal'): ?>
					<input type="number" name="<?php echo e($column_name); ?>" class="form-control <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old($column_name) ?? $member[$column_name]); ?>" step="0.01">
				<?php endif; ?>

				<?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?>
					<span class="invalid-feedback" role="alert">
						<strong><?php echo e($message); ?></strong>
					</span>
				<?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
			</div> 	
		</div>
	<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	

<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
		<button type="submit" class="btn btn-primary"><?php echo e($buttonText); ?></button>
	</div>
</div><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/members/form.blade.php ENDPATH**/ ?>