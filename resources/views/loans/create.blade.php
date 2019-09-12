@extends('layouts.app')
@section('title', 'Add Loan')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header text-md-center">NEW LOAN</div>
			<div class="card-body">
				<form action="{{ route('loans.store') }}" method="POST" enctype="multipart/form-data">
					@include('partials.form', [compact('columns'), 'route' => 'loans.index', 'buttonText' => 'Add Loan'])
				</form>	
			</div>
		</div>
	</div>	
</div>
@endsection
