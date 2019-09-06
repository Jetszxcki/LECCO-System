@extends('layouts.app')
@section('title', 'Add Member')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header text-md-center">Add New Member</div>
			<div class="card-body">
				<form action="{{ route('members.store') }}" method="POST">
					@include('partials.form', ['columns' => $columns, 'buttonText' => 'Add Member'])
				</form>	
			</div>
		</div>
	</div>	
</div>
@endsection
