@extends('layouts.app')
@section('title', 'Members')

@section('content')
	<div class="form-group d-flex flex-row justify-content-between">
		<a href="{{ route('members.create') }}" class="btn btn-primary">Add Member</a>

		@include('partials.search_bar')
	</div>

	<table class="container" id="main-table">
		<tr id="theader" class="d-flex p-1 mb-2">
			@if ($members->isEmpty())
				<th nosearch class="col text-center py-5">No record of members yet.</th>
			@else
				<th nosearch class="col-md-1">ID</th>
				<th nosearch class="col-md-5">Name</th>
				<th nosearch class="col d-flex flex-row justify-content-center">Actions</th>
			@endif
		</tr>

		@foreach ($members as $member)
			<tr class="p-1 mb-2">
				<td nosearch class="col-md-1">{{ $member->id }}</td>
				<td class="col-md-5">{{ $member->full_name }}</td>
				<td nosearch class="col d-flex flex-row align-items-center justify-content-center">
					<a href="{{ route('members.show', [$member]) }}" class="btn btn-primary">View</a>
				</td>
			</tr>
		@endforeach

		@if (! $members->isEmpty())
			<tr id="no-record" class="col text-center py-5" style="display: none">
				<th nosearch class="col text-center">No record</th>
			</tr>
		@endif
	</table>
@endsection