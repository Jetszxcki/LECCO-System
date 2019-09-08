@extends('layouts.app')
@section('title',  $member->full_name)

@section('content')
	<div class="d-flex flex-row justify-content-between">
		<div class="card" style="width: 25%">
			<div class="card-header">
				<img src="{{ asset('img/' . $member->profile_picture) }}" alt="Problem fetching image" />
			</div>
		</div>

		<div class="card" style="width: 72%">
			<div class="card-body">
				
			</div>
		</div>
	</div>

	<div class="container bg-dark mt-3">
		<a href="{{ route('members.edit', [$member]) }}" class="btn btn-warning">Edit</a>
		@foreach ($member->getAttributes() as $column => $value)
			<div class="row">
				<label>{{ $member->getColumnNameForView($column) }}</label>
				<label>{{ $value }}</label>
			</div>
		@endforeach
		<div class="row">
			<a href="{{ route('shares.show', [$member]) }}">Shares</a>
		</div>
	</div>
@endsection