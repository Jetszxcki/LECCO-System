@extends('layouts.app')
@section('title', 'Add Signatory')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header text-md-center">NEW SIGNATORY</div>
			<div class="card-body">
				<form action="{{ route('signatories.store') }}" method="POST">
					@csrf

					<div class="form-group row">
						<label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

						<div class="col-md-6">
							<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">

							@error('name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="form-group row">
						<label for="designation" class="col-md-4 col-form-label text-md-right">Designation</label>

						<div class="col-md-6">
							<input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror" value="{{ old('designation') }}">

							@error('designation')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="form-group row mb-0">
					    <div class="col-md-6 offset-md-4">
							<button type="submit" class="btn btn-primary">Add Signatory</button>
							<a href="{{ route('signatories.index') }}" class="btn btn-danger">Cancel</a>
						</div>
					</div>
				</form>	
			</div>
		</div>
	</div>	
</div>
@endsection
