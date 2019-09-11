<?php $__env->startSection('title', $user->name . ' - User Profile'); ?>
 
<?php $__env->startSection('content'); ?>
    <div class="d-flex flex-column align-items-center">

        <?php echo $__env->make('partials.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="card">
            <div class="card-header">
                <img class="static-img" src="<?php echo e(asset('images/' . $user->avatar)); ?>" />
            </div>

            <div class="card-body">
                <span class="font-weight-bold ls-1" style="font-size: 20px"><?php echo e($user->name); ?></span>

                <form action="<?php echo e(route('users.update_avatar', [$user])); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo method_field('PATCH'); ?>
                    <?php echo csrf_field(); ?>

                    <div class="form-group">
                        <input type="file" class="form-control-file <?php if ($errors->has('avatar')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('avatar'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                        <small id="fileHelp" class="form-text text-muted">Size of image should not be more than 2MB.</small>

                        <?php if ($errors->has('avatar')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('avatar'); ?>
                            <span class="invalid-feedback" role="alert"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/users/profile.blade.php ENDPATH**/ ?>