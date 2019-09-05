@extends('layouts.app')
@section('title',  $member->full_name)

@section('content')
	<div class="form-group">
		<a href="{{ route('members.edit', [$member]) }}" class="btn btn-warning">Edit</a>
	</div>

	<div class="form-group">
		<div class="row">
			<label><strong>Name:</strong>{{ $member->full_name }}</label>
		</div>
		<div class="row">
			<label><strong>TIN:</strong>{{ $member->TIN }}</label>
		</div>
	</div>
@endsection