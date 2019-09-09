@extends('layouts.app')
@section('title', 'Add Share')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header text-md-center">NEW SHARE</div>
			<div class="card-body">
				<form action="{{ route('shares.store') }}" method="POST">
					@include('partials.form', [compact('columns'), 'route' => 'shares.index', 'buttonText' => 'Add Share'])
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
@endsection
