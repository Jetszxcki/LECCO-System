@extends('layouts.app')
@section('title', 'Shares')

@section('content')
	<div class="form-group d-flex flex-row justify-content-between">
		<a href="{{ route('shares.create') }}" class="btn btn-primary">Add Share</a>

		@include('partials.search_bar')
	</div>

	<table class="container" id="main-table">
		<tr id="theader" class="d-flex p-1 mb-2 text-center">
			@if ($shares->isEmpty())
				<th nosearch class="col text-center py-5">No shares added yet.</th>
			@else
				<th nosearch class="col-md-1">ID</th>
				<th nosearch class="col">Member</th>
				<th nosearch class="col-md-1">Total</th>
				<th nosearch class="col-md-1">Amount</th>
				<th nosearch class="col-md-1">Price</th>
				<th nosearch class="col d-flex flex-row justify-content-center">Actions</th>
			@endif
		</tr>

		@foreach ($shares as $share)
			<tr class="p-1 mb-2 text-center">
				<td nosearch class="col-md-1">{{ $share->id }}</td>
				<td class="col">{{ $share->member->full_name }}</td>
				<td class="col-md-1">{{ $share->total }}</td>
				<td class="col-md-1">{{ $share->amount }}</td>
				<td class="col-md-1">{{ $share->price }}</td>
				<td nosearch class="col d-flex flex-row align-items-center justify-content-center">
					<a href="{{ route('shares.show', [$share]) }}" class="btn btn-success">View</a>
				</td>
			</tr>
		@endforeach

		@include('partials.not_found_alert', ['model' => $shares])
	</table>
@endsection