@extends('layouts.app')
@section('title', 'Add Transaction')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header text-md-center">NEW TRANSACTION</div>
			<div class="card-body">
				<form action="{{ route('transactions.store') }}" method="POST" enctype="multipart/form-data">
					@include('partials.form', [compact('columns'), 'route' => 'transactions.index', 'buttonText' => 'Add Transaction'])
				</form>	
			</div>
		</div>
	</div>	
</div>
@endsection
