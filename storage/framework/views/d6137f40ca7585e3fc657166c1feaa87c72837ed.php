<input type="<?php echo e($type); ?>" name="<?php echo e($column_name); ?>" class="form-control <?php if ($errors->has($column_name)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($column_name); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old($column_name)); ?>"><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/partials/input.blade.php ENDPATH**/ ?>