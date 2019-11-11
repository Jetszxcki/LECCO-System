@extends('layouts.app')
@section('title', 'Shares')

@section('content')
	<div class="d-flex flex-row form-group align-items-center justify-content-between">
		<h2>Shares</h2>

		@accessright('shares_create')
			<a href="{{ route('shares.create') }}" class="btn btn-primary">Add Share</a>
		@endaccessright

		{{-- @include('partials.search_bar') --}}
	</div>
	
	@include('partials.flash')

	<table class="container" id="main-table">
		@if ($shares->isEmpty())
			<tr id="theader" class="d-flex p-1 mb-3 text-center">
				<th nosearch class="col text-center py-5">No shares added yet.</th>
			</tr>
		@else
			@foreach ($members as $member)
				<tr id="name-row" class="p-1 mb-2 text-center">
					<td class="col-md-12">{{ $member->full_name }}</td>
				</tr>

				<tr id="theader" class="d-flex p-1 mb-3 text-center">
					<th nosearch class="col-md-2">ID</th>
					<th nosearch class="col-md-3">Total</th>
					<th nosearch class="col-md-3">Price</th>
					<th nosearch class="col-md-4">Amount</th>
					<th class="col-md-1" style="display: none">{{ $member->full_name }}</th>
				</tr>

				@foreach($member->shares as $share)
					<tr id="header" class="p-1 mb-2 text-center">
						<td nosearch class="col-md-2">{{ $share->id }}</td>
						<td class="col-md-3">{{ $share->total }}</td>
						<td class="col-md-3">{{ $share->price }}</td>
						<td class="col-md-4">{{ $share->amount }}</td>
						<td class="col-md-1" style="display: none">{{ $member->full_name }}</th>
					</tr>
				@endforeach

				<tr id="theader" class="d-flex p-1 mb-4 text-center" style="background: white;">
					<th nosearch class="col-md-2 c-black">Total:</th>
					<th nosearch class="col-md-3 c-black">{{ $member->shares->sum('total') }}</th>
					<th nosearch class="col-md-3 c-black">{{ $member->shares->sum('price') }}</th>
					<th nosearch class="col-md-4 c-black">{{ $member->shares->sum('amount') }}</th>
					<th class="col-md-1" style="display: none">{{ $member->full_name }}</th>
				</tr>
			@endforeach
		@endif

		@include('partials.search_not_found', ['model' => $shares])
	</table>
@endsection

<style scoped>
	#name-row {
		background: #34495E;
		box-shadow: none;
		font-size: 1.9rem;
	}
</style>