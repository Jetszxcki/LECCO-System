@extends('layouts.app')
@section('title', 'Loan Types')

@section('content')
	<div class="form-group d-flex flex-row justify-content-between align-items-center">
		<h2>Loan Types</h2>

		@accessright('loan_types_create')
			<a href="{{ route('loan_types.create') }}" class="btn btn-primary">Add Loan Type</a>
		@endaccessright

		@include('partials.search_bar')
	</div>

	@include('partials.flash')

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
					@accessright('loan_types_view')
						<a href="{{ route('loan_types.show', [$loan_type]) }}" class="btn btn-success mr-1">View</a>
					@endaccessright

					@accessright('loan_types_edit')
						<a href="{{ route('loan_types.edit', [$loan_type]) }}" class="btn btn-warning mr-1">Edit</a>
					@endaccessright

					@accessright('loan_types_delete')
						<form action="{{ route('loan_types.destroy', [$loan_type]) }}" method="POST">
							@method('DELETE')
							@csrf

							<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this loan type?')">Delete</button>
						</form>
					@endaccessright
				</td>
			</tr>
		@endforeach

		@include('partials.search_not_found', ['model' => $loan_types])
	</table>
@endsection