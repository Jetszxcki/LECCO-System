@extends('layouts.app')
@section('title', 'Add Loan Type')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header text-md-center">NEW LOAN TYPE</div>
			<div class="card-body">
				<form action="{{ route('loan_types.store') }}" method="POST">
					@include('partials.form', ['columns' => $columns, 'buttonText' => 'Add Loan Type'])
				</form>	
			</div>
		</div>
	</div>	
</div>
@endsection
