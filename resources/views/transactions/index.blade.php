@extends('layouts.app')
@section('title', 'Transactions')

@section('content')
	<div class="form-group d-flex flex-row justify-content-between align-items-center">
		<h2>Transactions</h2>

		{{-- @accessright('member_create') --}}
			<a href="{{ route('transactions.create') }}" class="btn btn-primary">Add Transaction</a>
		{{-- @endaccessright --}}
	
		@include('partials.search_bar')
	</div>

	@include('partials.flash')

	<table class="container" id="main-table">
		<tr id="theader" class="d-flex p-1 mb-3 text-center">
			@if ($transactions->isEmpty())
				<th nosearch class="col text-center py-5">No transactions added yet.</th>
			@else
				<th nosearch class="col-md-1">ID</th>
				<th nosearch class="col-md-5">Journal</th>
				<th nosearch class="col-md-1">Journal ID</th>
				{{-- <th nosearch class="col d-flex flex-row justify-content-center">Actions</th> --}}
			@endif
		</tr>

		@foreach ($transactions as $transaction)
			<tr class="p-1 mb-2 text-center">
				<td nosearch class="col-md-1">{{ $transaction->id }}</td>
				<td class="col-md-4">{{ $transaction->transaction_code }}</td>
				<td class="col-md-2">{{ $transaction->transaction_code_id }}</td>
				<td nosearch class="col d-flex flex-row align-items-center justify-content-center">
					{{-- @accessright('member_delete') --}}
						<form action="{{ route('transactions.destroy', [$transaction]) }}" method="POST">
							@method('DELETE')
							@csrf

							<button type="submit" class="btn btn-danger">Delete</button>
						</form>
					{{-- @endaccessright --}}
				</td>
			</tr>
		@endforeach

		@include('partials.search_not_found', ['model' => $transactions])
	</table>
@endsection