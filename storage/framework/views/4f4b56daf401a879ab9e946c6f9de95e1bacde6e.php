<?php $__env->startSection('title', $signatory->name . ' - Edit Signatory'); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header text-md-center"><?php echo e($signatory->name); ?></div>
			<div class="card-body">
				<form action="<?php echo e(route('signatories.update', [$signatory])); ?>" method="POST">
					<?php echo method_field('PATCH'); ?>
					<?php echo csrf_field(); ?>

					<div class="form-group row">
						<label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

						<div class="col-md-6">
							<input type="text" name="name" class="form-control <?php if ($errors->has('name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('name'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old('name') ?? $signatory->name); ?>">

							<?php if ($errors->has('name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('name'); ?>
								<span class="invalid-feedback" role="alert">
									<strong><?php echo e($message); ?></strong>
								</span>
							<?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
						</div>
					</div>

					<div class="form-group row">
						<label for="designation" class="col-md-4 col-form-label text-md-right">Designation</label>

						<div class="col-md-6">
							<input type="text" name="designation" class="form-control <?php if ($errors->has('designation')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('designation'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old('designation') ?? $signatory->designation); ?>">

							<?php if ($errors->has('designation')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('designation'); ?>
								<span class="invalid-feedback" role="alert">
									<strong><?php echo e($message); ?></strong>
								</span>
							<?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
						</div>
					</div>

					<div class="form-group row mb-0">
					    <div class="col-md-6 offset-md-4">
							<button type="submit" class="btn btn-primary">Save Changes</button>
						</div>
					</div>
				</form>	
			</div>
		</div>
	</div>	
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/signatories/edit.blade.php ENDPATH**/ ?>