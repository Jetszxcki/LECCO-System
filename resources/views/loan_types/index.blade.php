@extends('layouts.app')
@section('title', 'Loan Types')

@section('content')
	<div class="form-group d-flex flex-row justify-content-between align-items-center">
		<h2>Loan Types</h2>
		<a href="{{ route('loan_types.create') }}" class="btn btn-primary">Add Loan Type</a>

		@include('partials.search_bar')
	</div>

	<table class="container" id="main-table">
		<tr id="theader" class="d-flex p-1 mb-3 text-center">
			@if ($loan_types->isEmpty())
				<th nosearch class="col text-center py-5">No loan types added yet.</th>
			@else
				<th nosearch class="col-md-1">ID</th>
				<th nosearch class="col-md-6">Name</th>
				<th nosearch class="col d-flex flex-row justify-content-center">Actions</th>
			@endif
		</tr>

		@foreach ($loan_types as $loan_type)
			<tr class="p-1 mb-2 text-center">
				<td nosearch class="col-md-1">{{ $loan_type->id }}</td>
				<td class="col-md-6">{{ $loan_type->name }}</td>
				<td nosearch class="col d-flex flex-row align-items-center justify-content-center">
					<a href="{{ route('loan_types.show', [$loan_type]) }}" class="btn btn-success mr-1">View</a>
					<a href="{{ route('loan_types.edit', [$loan_type]) }}" class="btn btn-warning mr-1">Edit</a>

					<form action="{{ route('loan_types.destroy', [$loan_type]) }}" method="POST">
						@method('DELETE')
						@csrf

						<button type="submit" class="btn btn-danger">Delete</button>
					</form>
				</td>
			</tr>
		@endforeach

		@include('partials.not_found_alert', ['model' => $loan_types])
	</table>
@endsection