@extends('layouts.app')
@section('title', $user->name . ' - Edit Privileges')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header text-md-center">{{ $user->name }}</div>
			<div class="card-body">
				<form action="{{ route('users.update_rights', [$user]) }}" method="POST">
					@method('PATCH')
					@csrf

					@include('partials.access_right_checkboxes', ['header' => 'USER'])
					@include('partials.access_right_checkboxes', ['header' => 'MEMBER'])
					@include('partials.access_right_checkboxes', ['header' => 'LOANS'])
					@include('partials.access_right_checkboxes', ['header' => 'LOAN TYPES'])
					@include('partials.access_right_checkboxes', ['header' => 'CHART OF ACCOUNTS'])
					@include('partials.access_right_checkboxes', ['header' => 'CHECK VOUCHERS'])
					@include('partials.access_right_checkboxes', ['header' => 'TRANSACTIONS'])
					@include('partials.access_right_checkboxes', ['header' => 'SHARES'])
					@include('partials.access_right_checkboxes', ['header' => 'SIGNATORIES'])

					<div class="form-group row mb-0">
					    <div class="col-md-6 offset-md-4">
							<button type="submit" class="btn btn-primary">Save Changes</button>
							<a href="{{ route('users.index') }}" class="btn btn-danger">Cancel</a>
						</div>
					</div>
				</form>	
			</div>
		</div>
	</div>	
</div>
@endsection
