@extends('layouts.app')
@section('title',  $member->full_name)

@section('content')
	@include('partials.flash')

	<div class="d-flex flex-row justify-content-between">
		<div class="card" style="width: 25%">
			<div class="card-header">
				<img class="static-img" src="{{ asset('images/' . $member->profile_picture) }}" />
			</div>
		</div>

		<div class="card" style="width: 72%">
			<div class="card-body">
				
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

				<button type="submit" class="btn btn-danger">Delete</button>
			</form>
		@endaccessright

		@foreach ($member->getAttributes() as $column => $value)
			<div class="row">
				@if($column != 'profile_picture')
					<label>{{ $member->getColumnNameForView($column) }}</label>
					<label>{{ $value }}</label>
				@endif
			</div>
		@endforeach
		<div class="row">
			@accessright('shares_view')
				<a href="{{ route('shares.show', ['member' => $member]) }}" class="btn btn-primary">Shares</a>
			@endaccessright
		</div>
	</div>
@endsection