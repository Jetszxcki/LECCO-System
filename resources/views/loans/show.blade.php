@extends('layouts.app')
@section('title',  "Loan")

@section('content')
	@include('partials.flash')

	<div class="container bg-dark mt-3">
		@accessright('loan_edit')
			<a href="{{--{{ route('loans.edit', [$loan]) }}--}}" class="btn btn-warning">Edit</a>
		@endaccessright
		
		@accessright('loan_delete')
			<form action="{{ route('loans.destroy', [$loan]) }}" method="POST">
				@method('DELETE')
				@csrf

				<button type="submit" class="btn btn-danger">Delete</button>
			</form>
		@endaccessright

		@foreach ($loan->getAttributes() as $column => $value)
			<div class="row">
				@if($column != 'profile_picture')
					<label>{{ $loan->getColumnNameForView($column) }}</label>
					<label>{{ $value }}</label>
				@endif
			</div>
		@endforeach
	</div>
@endsection