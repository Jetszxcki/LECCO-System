<?php $__env->startSection('title', 'Users'); ?>

<?php $__env->startSection('content'); ?>
	<div class="form-group d-flex flex-row justify-content-between align-items-center">
		<h2>Users</h2>
		
		<?php echo $__env->make('partials.search_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>

	<table class="container" id="main-table">
		<tr id="theader" class="d-flex p-1 mb-3 text-center">
			<?php if($users->isEmpty()): ?>
				<th nosearch class="col text-center py-5">No users made yet.</th>
			<?php else: ?>
				<th nosearch class="col-md-1">ID</th>
				<th nosearch class="col-md-2">Profile Pic</th>
				<th nosearch class="col-md-3">Name</th>
				<th nosearch class="col-md-3">Email</th>
				<th nosearch class="col d-flex flex-row justify-content-center">Actions</th>
			<?php endif; ?>
		</tr>

		<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr class="p-1 mb-2 text-center">
				<td nosearch class="col-md-1 align-self-center"><?php echo e($user->id); ?></td>

				<td nosearch class="col-md-2">
					<center>
						<img src="<?php echo e(asset('img/user.jpg')); ?>" style="display: block; height: auto; width: 100px;" />
					</center>
				</td>

				<td class="col-md-3 align-self-center"><?php echo e($user->name); ?></td>
				<td class="col-md-3 align-self-center"><?php echo e($user->email); ?></td>

				<td nosearch class="col d-flex flex-row align-items-center justify-content-center">
					<a href="<?php echo e(route('users.show_rights', [$user])); ?>" class="btn btn-warning mr-1">Edit Privileges</a>
					<form action="<?php echo e(route('users.destroy', [$user])); ?>" method="POST">
						<?php echo method_field('DELETE'); ?>
						<?php echo csrf_field(); ?>

						<button type="submit" class="btn btn-danger">Delete</button>
					</form>
				</td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		<?php echo $__env->make('partials.not_found_alert', ['model' => $users], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/users/index.blade.php ENDPATH**/ ?>