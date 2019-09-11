@extends('layouts.app')
@section('title', 'Members')

@section('content')
	<div class="form-group d-flex flex-row justify-content-between align-items-center">
		<h2>Members</h2>

		@accessright('member_create')
			<a href="{{ route('members.create') }}" class="btn btn-primary">Add Member</a>
		@endaccessright
	
		@include('partials.search_bar')
	</div>

	@include('partials.flash')

	<table class="container" id="main-table">
		<tr id="theader" class="d-flex p-1 mb-3 text-center">
			@if ($members->isEmpty())
				<th nosearch class="col text-center py-5">No members added yet.</th>
			@else
				<th nosearch class="col-md-1">ID</th>
				<th nosearch class="col-md-5">Name</th>
				<th nosearch class="col d-flex flex-row justify-content-center">Actions</th>
			@endif
		</tr>

		@foreach ($members as $member)
			<tr class="p-1 mb-2 text-center">
				<td nosearch class="col-md-1">{{ $member->id }}</td>
				<td class="col-md-5">{{ $member->full_name }}</td>
				<td nosearch class="col d-flex flex-row align-items-center justify-content-center">
					@accessright('member_view')
						<a href="{{ route('members.show', [$member]) }}" class="btn btn-success mr-1">View</a>
					@endaccessright

					@accessright('member_edit')
						<a href="{{ route('members.edit', [$member]) }}" class="btn btn-warning mr-1">Edit</a>
					@endaccessright

					@accessright('member_delete')
						<form action="{{ route('members.destroy', [$member]) }}" method="POST">
							@method('DELETE')
							@csrf

							<button type="submit" class="btn btn-danger">Delete</button>
						</form>
					@endaccessright
				</td>
			</tr>
		@endforeach

		@include('partials.search_not_found', ['model' => $members])
	</table>
@endsection