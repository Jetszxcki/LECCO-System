<?php echo csrf_field(); ?>

<?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column_name => $column_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php if($column_name != 'id' && $column_name !='created_at' && $column_name != 'updated_at'): ?>
		<div class="form-group row">	
			<?php if($column_name == 'member_id'): ?>
				<label for="member_id" class="col-md-4 col-form-label text-md-right">Member</label>
			<?php else: ?>
	 			<label for="<?php echo e($cname = $model->getColumnNameForView($column_name)); ?>" class="col-md-4 col-form-label text-md-right"><?php echo e($cname); ?></label>
	 		<?php endif; ?>

			<div class="col-md-6">
				<?php if($column_data['type'] == 'integer' || $column_data['type'] == 'bigint'): ?>
					<?php if($column_data['choices']): ?>
						<select name="<?php echo e($column_name); ?>" id="<?php echo e($column_name); ?>" class="form-control <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>">
							<?php $__currentLoopData = $column_data['choices']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					<?php else: ?>
						<input type="number" name="<?php echo e($column_name); ?>" class="form-control <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old($column_name) ?? $model[$column_name]); ?>" id="<?php echo e($column_name); ?>" <?php echo e($column_name == 'total' ? 'oninput=calculateAmount()' : ''); ?>>
					<?php endif; ?>
				<?php elseif($column_data['type'] == 'string'): ?>
					<?php if($column_data['choices']): ?>
						<?php if(array_key_exists('select_box', $column_data)): ?>
							<select name="<?php echo e($column_name); ?>" id="<?php echo e($column_name); ?>" class="form-control <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>">
								<?php $__currentLoopData = $column_data['choices']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						<?php else: ?>
							<div class="table">
							<?php $__currentLoopData = $column_data['choices']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $choice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="row">
								<label><input type="radio" name="<?php echo e($column_name); ?>" class="<?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e($choice); ?>" <?php if(old($column_name) == $choice): ?> checked <?php endif; ?>><?php echo e($choice); ?></label>
								</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						<?php endif; ?>
					<?php elseif($column_name == 'profile_picture'): ?>
						<input type="file" name="<?php echo e($column_name); ?>" class="form-control-file <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old($column_name) ?? $model[$column_name]); ?>" aria-describedby="fileHelp">
						<small id="fileHelp" class="form-text text-muted">Size of image should not be more than 2MB.</small>
					<?php else: ?>
						<input type="text" name="<?php echo e($column_name); ?>" class="form-control <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old($column_name) ?? $model[$column_name]); ?>">
					<?php endif; ?>
				<?php elseif($column_data['type'] == 'date'): ?>
					<input type="date" name="<?php echo e($column_name); ?>" class="form-control <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old($column_name) ?? $model[$column_name]); ?>">
				<?php elseif($column_data['type'] == 'decimal'): ?>
					<input 
						type="number" 
						name="<?php echo e($column_name); ?>" 
						class="form-control <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" 
						value="<?php echo e(old($column_name) ?? $model[$column_name]); ?>" 
						step="0.01" 
						id="<?php echo e($column_name); ?>" 
						<?php if(array_key_exists('disabled', $column_data)): ?>
							<?php echo e($column_data['disabled'] ? 'readonly' : ''); ?>

						<?php endif; ?>
						<?php echo e($column_name == 'price' ? 'oninput=calculateAmount()' : ''); ?>

						>
				<?php elseif($column_data['type'] == 'float'): ?>
					<input type="number" name="<?php echo e($column_name); ?>" class="form-control <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old($column_name) ?? $model[$column_name]); ?>" step="any">
				<?php else: ?>
					<input type="text" name="<?php echo e($column_name); ?>" class="form-control <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old($column_name) ?? $model[$column_name]); ?>">
					<small id="fileHelp" class="form-text text-muted">Can't process field type, this is the default inputfield</small>
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
		<?php if($route == 'previous'): ?>
			<a href="<?php echo e(url()->previous()); ?>" class="btn btn-danger">Cancel</a>
		<?php else: ?>
			<a href="<?php echo e(route($route)); ?>" class="btn btn-danger">Cancel</a>
		<?php endif; ?>
	</div>
</div>
<?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/partials/form.blade.php ENDPATH**/ ?>