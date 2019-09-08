@extends('layouts.app')
@section('title', 'Whoops!');

<style>
	.unauthorized-text {
		font-weight: bold; 
		font-size: 20px;
		letter-spacing: 2px;
		line-height: 40px;
	}

	.unauthorized-div {
		width: 100%;
		height: 65%;
	}
</style>

@section('content')
<div class="d-flex flex-column justify-content-center unauthorized-div">
	<div class="alert alert-warning py-5 text-center unauthorized-text">
		Operation unavailable for this user. <br>
		Contact ADMIN to enable privilege "<i>{{ $function->getColumnNameForView($operation) }}</i>".
	</div>
</div>
@endsection