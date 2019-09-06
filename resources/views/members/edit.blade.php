@extends('layouts.app')
@section('title', $member->full_name . ' - Edit Profile')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header text-md-center">{{ $member->full_name }}</div>
			<div class="card-body">
				<form action="{{ route('members.update', [$member]) }}" method="POST">
					@method('PATCH')
					@include('members.form', ['columns' => $columns, 'buttonText' => 'Save Changes'])
				</form>	
			</div>
		</div>
	</div>	
</div>
@endsection
