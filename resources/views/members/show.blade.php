@extends('layouts.app')
@section('title',  $member->full_name)

@section('content')
	<div class="form-group">
		<a href="{{ route('members.edit', [$member]) }}" class="btn btn-warning">Edit</a>
	</div>

	<div class="container">
		@foreach ($member->getAttributes() as $column => $value)
			<div class="row">
				<label>{{ $member->getColumnNameForView($column) }}</label>
				<label>{{ $value }}</label>
			</div>
		@endforeach
	</div>
@endsection