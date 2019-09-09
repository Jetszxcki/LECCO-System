<?php $__env->startSection('title', 'Add Share'); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header text-md-center">NEW SHARE</div>
			<div class="card-body">
				<form action="<?php echo e(route('shares.store')); ?>" method="POST">
					<?php echo $__env->make('partials.form', [compact('columns'), 'route' => 'shares.index', 'buttonText' => 'Add Share'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</form>	
			</div>
		</div>
	</div>	
</div>

<script>
	function calculateAmount() {
		var total= Number(document.getElementById('total').value);
		var price= Number(document.getElementById('price').value);
		var amount= total*price;
		var amount_field= document.getElementById('amount')
		amount_field.setAttribute('value', roundToPennies(amount));
	}
	
	function roundToPennies(n) {
		pennies = n * 100;
		
		pennies = Math.round(pennies);
		strPennies = "" + pennies;
		len = strPennies.length;
		
		return (pennies/100);
	}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/shares/create.blade.php ENDPATH**/ ?>