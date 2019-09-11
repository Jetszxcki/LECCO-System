@extends('layouts.app')
@section('title', 'Shares')

@section('content')
	<div class="form-group d-flex flex-row justify-content-between align-items-center">
		<h2>Shares</h2>

		@accessright('shares_create')
			<a href="{{ route('shares.create') }}" class="btn btn-primary">Add Share</a>
		@endaccessright

		@include('partials.search_bar')
	</div>
	
	@include('partials.flash')

	<table class="container" id="main-table">
		<tr id="theader" class="d-flex p-1 mb-3 text-center">
			@if ($shares->isEmpty())
				<th nosearch class="col text-center py-5">No shares added yet.</th>
			@else
				<th nosearch class="col-md-1">ID</th>
				<th nosearch class="col-md-5">Member</th>
				<th nosearch class="col-md-2">Total</th>
				<th nosearch class="col-md-2">Price</th>
				<th nosearch class="col-md-2">Amount</th>
			@endif
		</tr>

		@foreach ($shares as $share)
			<tr class="p-1 mb-2 text-center">
				<td nosearch class="col-md-1">{{ $share->id }}</td>
				<td class="col-md-5">{{ $share->member->full_name }}</td>
				<td class="col-md-2">{{ $share->total }}</td>
				<td class="col-md-2">{{ $share->price }}</td>
				<td class="col-md-2">{{ $share->amount }}</td>
			</tr>
		@endforeach

		@include('partials.search_not_found', ['model' => $shares])
	</table>
@endsection