@extends('layouts.app')
@section('title', $model->name . ' - Edit')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header text-md-center">{{ $model->name }}</div>
			<div class="card-body">
				<form action="{{ route('loan_types.update', [$model]) }}" method="POST">
					@method('PATCH')
					@csrf

					@include('partials.form', ['columns' => $columns, 'buttonText' => 'Save Changes'])
				</form>	
			</div>
		</div>
	</div>	
</div>
@endsection
