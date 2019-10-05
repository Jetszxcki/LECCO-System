@extends('layouts.app')
@section('title', 'Loans')

@section('content')
	<div class="form-group d-flex flex-row justify-content-between align-items-center">
		<h2>Loans</h2>

		@accessright('loans_create')
			<a href="{{ route('loans.create') }}" class="btn btn-primary">Add Loan</a>
		@endaccessright

		@include('partials.search_bar')
	</div>

	@include('partials.flash')

	<table class="container" id="main-table">
		<tr id="theader" class="d-flex p-1 mb-3 text-center">
			@if ($loans->isEmpty())
				<th nosearch class="col text-center py-5">No loans added yet.</th>
			@else
				<th nosearch class="col-md-1">ID</th>
				<th nosearch class="col-md-2">Member</th>
				<th nosearch class="col-md-2">Loan Type</th>
				<th nosearch class="col-md-1">Amount</th>
				<th nosearch class="col-md-2">Start of Payment</th>
				<th nosearch class="col-md-1">Term</th>
				<th nosearch class="col d-flex flex-row justify-content-center">Actions</th>
			@endif
		</tr>

		@foreach ($loans as $loan)
			<tr class="p-1 mb-2 text-center">
				<td nosearch class="col-md-1">{{ $loan->id }}</td>
				<td class="col-md-2">{{ $loan->member->full_name }}</td>
				<td class="col-md-2">{{ $loan->loan_type_object->name}}</td>
				<td class="col-md-1">{{ $loan->amount }}</td>
				<td class="col-md-2">{{ $loan->start_of_payment }}</td>
				<td class="col-md-1">{{ $loan->term }}</td>

				<td nosearch class="col d-flex flex-row align-items-center justify-content-center">
					@accessright('loans_view')
						<a href="{{ route('loans.show', [$loan]) }}" class="btn btn-success mr-1">View</a>
					@endaccessright

					@accessright('loans_edit')
						<a href="{{ route('loans.edit', [$loan]) }}" class="btn btn-warning mr-1">Edit</a>
					@endaccessright

					@accessright('loans_delete')
						<form action="{{ route('loans.destroy', [$loan]) }}" method="POST">
							@method('DELETE')
							@csrf

							<button type="submit" class="btn btn-danger">Delete</button>
						</form>
					@endaccessright
				</td>
			</tr>
		@endforeach

		@include('partials.search_not_found', ['model' => $loans])
	</table>
@endsection