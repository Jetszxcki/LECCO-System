@extends('layouts.app')
@section('title',  $member->full_name)

@section('content')
	@include('partials.flash')

	<div class="d-flex flex-row justify-content-between">
		<div class="card" style="width:30%">
			<div class="card-header d-flex flex-row justify-content-center">
				<img class="static-img" src="{{ asset('images/' . $member->profile_picture) }}" />
			</div>
		</div>

		<div class="card" style="width: 68%">
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">{{ $member->full_name }}</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container bg-dark mt-3">
		@accessright('member_edit')
			<a href="{{ route('members.edit', [$member]) }}" class="btn btn-warning">Edit</a>
		@endaccessright
		
		@accessright('member_delete')
			<form action="{{ route('members.destroy', [$member]) }}" method="POST">
				@method('DELETE')
				@csrf

				<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this member?')">Delete</button>
			</form>
		@endaccessright

		@foreach ($member->getAttributes() as $column => $value)
			<div class="row">
				@if($column != 'profile_picture')
					<label>{{ $member->getColumnNameForView($column) }}</label>
					@if($column == 'no_of_subscribed_shares')
						@accessright('shares_view')
							<a href="{{ route('shares.show', ['member' => $member]) }}" class="btn btn-primary">View Shares</a>
						@endaccessright
					@else
						<label>{{ $value }}</label>
					@endif
				@endif
			</div>
		@endforeach
	</div>
@endsection