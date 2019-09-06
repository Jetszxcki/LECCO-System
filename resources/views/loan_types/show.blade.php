@extends('layouts.app')
@section('title',  $loan_type->name)

@section('content')
	<div class="form-group">
		<a href="{{ route('loan_types.edit', [$loan_type]) }}" class="btn btn-warning">Edit</a>
	</div>

	<div class="container">
		@foreach ($loan_type->getAttributes() as $column => $value)
			<div class="row">
				<label>{{ $loan_type->getColumnNameForView($column) }}</label>
				<label>{{ $value }}</label>
			</div>
		@endforeach
	</div>
@endsection