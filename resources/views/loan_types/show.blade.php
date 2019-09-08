@extends('layouts.app')
@section('title',  $loan_type->name)

@section('content')
	<div class="form-group">
		@accessright('loan_types_edit')
			<a href="{{ route('loan_types.edit', [$loan_type]) }}" class="btn btn-warning">Edit</a>
		@endaccessright

		@accessright('loan_types_delete')
			<form action="{{ route('loan_types.destroy', [$loan_type]) }}" method="POST">
				@method('DELETE')
				@csrf

				<button type="submit" class="btn btn-danger">Delete</button>
			</form>
		@endaccessright
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