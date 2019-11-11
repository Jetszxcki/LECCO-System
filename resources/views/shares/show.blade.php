@extends('layouts.app')
@section('title', $member->full_name . ' - Shares')

@section('content')
	<div class="form-group text-center">
		<h3 style="color: white">{{ 'Shares of ' . $member->full_name }}</h3>
	</div>

	<table class="container" id="main-table">
		<tr id="theader" class="d-flex p-1 mb-3 text-center">
			@if ($shares->isEmpty())
				<th nosearch class="col text-center py-5">No shares yet.</th>
			@else
				<th nosearch class="col-md-2">Month</th>
				<th nosearch class="col-md-1">Year</th>
				<th nosearch class="col-md-3">Total No. of Shares</th>
				<th nosearch class="col-md-3">Total Price</th>
				<th nosearch class="col-md-3">Total Amount</th>
			@endif
		</tr>

		@foreach ($shares as $share)
			<tr class="p-1 mb-2 text-center">
				<td class="col-md-2">{{ DateTime::createFromFormat('!m', $share->month)->format('F') }}</td>
				<td class="col-md-1">{{ $share->year }}</td>
				<td class="col-md-3">{{ $share->total_no_shares }}</td>
				<td class="col-md-3">{{ $share->total_price }}</td>
				<td class="col-md-3">{{ $share->total_amount }}</td>
			</tr>
		@endforeach
		
		@if (! $shares->isEmpty())
			<tr id="theader" class="d-flex p-1 text-center" style="background: white;">
				<th nosearch class="col-md-3 c-black">Total:</th>
				<th nosearch class="col-md-3 c-black">{{ $totals[0] }}</th>
				<th nosearch class="col-md-3 c-black">{{ $totals[1] }}</th>
				<th nosearch class="col-md-3 c-black">{{ $totals[2] }}</th>
			</tr>
		@endif

		@include('partials.search_not_found', ['model' => $shares])
	</table>
@endsection