@extends('layouts.app')
@section('title', 'Restricted Access');

<style>
	.unauthorized-text {
		/*font-weight: bold; */
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
		You may not have the following privileges:
		<div>
			@foreach ($access_rights as $access_right)
				<div>
					<i>{{ $user->getColumnNameForView($access_right) }}</i>
				</div>
			@endforeach
		</div>
		<br> 
		<small>
			<b>Contact ADMIN if you are authorized to do such operations.</b>
		</small>
	</div>
</div>
@endsection