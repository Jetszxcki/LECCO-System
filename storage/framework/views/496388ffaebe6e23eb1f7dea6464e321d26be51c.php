<?php echo csrf_field(); ?>

<?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column_name => $column_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php if($column_name != 'id' && $column_name !='created_at' && $column_name != 'updated_at'): ?>
		<div class="form-group row">	
			<?php if($column_name == 'member_id'): ?>
				<label for="member_id" class="col-md-4 col-form-label text-md-right">Member</label>
			<?php elseif($column_name == 'user_id'): ?>
				<label for="user_id" class="col-md-4 col-form-label text-md-right">User ID</label>
			<?php else: ?>
	 			<label for="<?php echo e($cname = $model->getColumnNameForView($column_name)); ?>" class="col-md-4 col-form-label text-md-right"><?php echo e($cname); ?></label>
	 		<?php endif; ?>

			<div class="col-md-6">
				<?php if($column_type == 'integer'): ?>
					<?php if($column_name == 'member_id'): ?>
						<select name="member_id" id="member_id" class="form-control">
							<?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($member->id); ?>"><?php echo e($member->full_name); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					<?php elseif($column_name == 'user_id'): ?>
						<input type="text" name="<?php echo e($column_name); ?>" class="form-control text-center <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e($model->id); ?>" disabled>
					<?php else: ?>
						<input type="number" name="<?php echo e($column_name); ?>" class="form-control <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old($column_name) ?? $model[$column_name]); ?>" id="<?php echo e($column_name); ?>" <?php echo e($column_name == 'total' ? 'oninput=calculateAmount()' : ''); ?>>
					<?php endif; ?>
				<?php elseif($column_type == 'string'): ?>
					<?php if($column_name == 'profile_picture'): ?>
						<input type="file" name="<?php echo e($column_name); ?>" class="form-control-file <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old($column_name) ?? $model[$column_name]); ?>">
					<?php else: ?>
						<input type="text" name="<?php echo e($column_name); ?>" class="form-control <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old($column_name) ?? $model[$column_name]); ?>">
					<?php endif; ?>
				<?php elseif($column_type == 'date'): ?>
					<input type="date" name="<?php echo e($column_name); ?>" class="form-control <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old($column_name) ?? $model[$column_name]); ?>">
				<?php elseif($column_type == 'decimal'): ?>
					<input type="number" name="<?php echo e($column_name); ?>" class="form-control <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old($column_name) ?? $model[$column_name]); ?>" step="0.01" id="<?php echo e($column_name); ?>" <?php echo e($column_name == 'amount' ? 'readonly' : ''); ?> <?php echo e($column_name == 'price' ? 'oninput=calculateAmount()' : ''); ?>>
				<?php elseif($column_type == 'float'): ?>
					<input type="number" name="<?php echo e($column_name); ?>" class="form-control <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old($column_name) ?? $model[$column_name]); ?>" step="any">
				<?php elseif($column_type == 'boolean'): ?>
					<input type="checkbox" name="<?php echo e($column_name); ?>" class="form-control <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e($model->access_right[$column_name]); ?>" <?php echo e($model->access_right[$column_name] ? 'checked' : ''); ?>>
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
</div><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/partials/form.blade.php ENDPATH**/ ?>