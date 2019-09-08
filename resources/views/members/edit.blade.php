@extends('layouts.app')
@section('title', $model->full_name . ' - Edit Profile')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header text-md-center">{{ $model->full_name }}</div>
			<div class="card-body">
				<form action="{{ route('members.update', [$model]) }}" method="POST">
					@method('PATCH')
					@include('partials.form', ['columns' => $columns, 'route' => 'previous', 'buttonText' => 'Save Changes'])
				</form>	
			</div>
		</div>
	</div>	
</div>
@endsection
