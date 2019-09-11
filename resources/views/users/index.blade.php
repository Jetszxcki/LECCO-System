@extends('layouts.app')
@section('title', 'Users')

@section('content')

	<div class="form-group d-flex flex-row justify-content-between align-items-center">
		<h2>Users</h2>
		
		@include('partials.search_bar')
	</div>

	@include('partials.flash')

	<table class="container" id="main-table">
		<tr id="theader" class="d-flex p-1 mb-3 text-center">
			@if ($users->isEmpty())
				<th nosearch class="col text-center py-5">No users made yet.</th>
			@else
				<th nosearch class="col-md-1">ID</th>
				<th nosearch class="col-md-2">Profile Pic</th>
				<th nosearch class="col-md-3">Name</th>
				<th nosearch class="col-md-3">Email</th>

				<th nosearch class="col d-flex flex-row justify-content-center">Actions</th>
			@endif
		</tr>

		@foreach ($users as $user)
			<tr class="p-1 mb-2 text-center">
				<td nosearch class="col-md-1 align-self-center">{{ $user->id }}</td>

				<td nosearch class="col-md-2">
					<center>
						<img src="{{ asset('images/' . $user->avatar) }}" style="display: block; height: 100px; width: 100px;" />
					</center>
				</td>

				<td class="col-md-3 align-self-center">{{ $user->name }}</td>
				<td class="col-md-3 align-self-center">{{ $user->email }}</td>

				<td nosearch class="col d-flex flex-row align-items-center justify-content-center">
					@accessright('invoke_rights')
						<a href="{{ route('users.show_rights', [$user]) }}" class="btn btn-warning mr-1">Edit Privileges</a>
					@endaccessright

					@accessright('user_delete')
						<form action="{{ route('users.destroy', [$user]) }}" method="POST">
							@method('DELETE')
							@csrf

							<button type="submit" class="btn btn-danger">Delete</button>
						</form>
					@endaccessright
				</td>
			</tr>
		@endforeach

		@include('partials.search_not_found', ['model' => $users])
	</table>
@endsection