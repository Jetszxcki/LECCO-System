<?php echo csrf_field(); ?>

<?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column_name => $column_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php if($column_name != 'id' && $column_name !='created_at' && $column_name != 'updated_at'): ?>
		<div class="form-group row">	
			<?php if($column_name == 'member_id'): ?>
				<label for="member_id" class="col-md-4 col-form-label text-md-right">Member</label>
			<?php else: ?>
	 			<label for="<?php echo e($cname = $model->getColumnNameForView($column_name)); ?>" class="col-md-4 col-form-label text-md-right"><?php echo e($cname); ?></label>
	 		<?php endif; ?>

			<div class="col-md-6">

				

				<?php if (strpos($column_type, 'choices') !== false) { ?>
					<select name="<?php echo e($column_name); ?>" id="<?php echo e($column_name); ?>" class="form-control <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>">
						<?php $__currentLoopData = $withChoices[$withChoices[0]++]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>

				<?php } else if (strpos($column_type, 'integer') !== false || strpos($column_type, 'bigint')) { ?>
					
					<input type="number" name="<?php echo e($column_name); ?>" class="form-control <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old($column_name) ?? $model[$column_name]); ?>" id="<?php echo e($column_name); ?>" <?php echo e($column_name == 'total' ? 'oninput=calculateAmount()' : ''); ?> <?php if (\Illuminate\Support\Facades\Blade::check('disabled', $column_type)): ?> readonly <?php endif; ?>>
					
				<?php } else if (strpos($column_type, 'string') !== false) { ?>
					
					<?php if($column_name == 'profile_picture'): ?>
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
endif; ?>" value="<?php echo e(old($column_name) ?? $model[$column_name]); ?>" <?php if (\Illuminate\Support\Facades\Blade::check('disabled', $column_type)): ?> readonly <?php endif; ?>>
					<?php endif; ?>

				<?php } else if (strpos($column_type, 'date') !== false) { ?>
					<input type="date" name="<?php echo e($column_name); ?>" class="form-control <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old($column_name) ?? $model[$column_name]); ?>" <?php if (\Illuminate\Support\Facades\Blade::check('disabled', $column_type)): ?> readonly <?php endif; ?>>

				<?php } else if (strpos($column_type, 'decimal') !== false) { ?>
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
						<?php if (\Illuminate\Support\Facades\Blade::check('disabled', $column_type)): ?> readonly <?php endif; ?>
						<?php echo e($column_name == 'price' ? 'oninput=calculateAmount()' : ''); ?>

						>
				<?php } else if (strpos($column_type, 'float') !== false) { ?>
					<input type="number" name="<?php echo e($column_name); ?>" class="form-control <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old($column_name) ?? $model[$column_name]); ?>" step="any" <?php if (\Illuminate\Support\Facades\Blade::check('disabled', $column_type)): ?> readonly <?php endif; ?>>

				<?php } else { ?>
					<input type="text" name="<?php echo e($column_name); ?>" class="form-control <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old($column_name) ?? $model[$column_name]); ?>" <?php if (\Illuminate\Support\Facades\Blade::check('disabled', $column_type)): ?> readonly <?php endif; ?>>
					<small id="fileHelp" class="form-text text-muted">Can't process field type, this is the default inputfield</small>
				<?php } ?>

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
		
		<a href="<?php echo e($route == 'previous' ? url()->previous() : route($route)); ?>" class="btn btn-danger">Cancel</a>
	</div>
</div>
<?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/partials/form.blade.php ENDPATH**/ ?>