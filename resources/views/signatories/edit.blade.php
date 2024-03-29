@extends('layouts.app')
@section('title', $signatory->name . ' - Edit Signatory')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header text-md-center">{{ $signatory->name }}</div>
			<div class="card-body">
				<form action="{{ route('signatories.update', [$signatory]) }}" method="POST">
					@method('PATCH')
					@csrf

					<div class="form-group row">
						<label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

						<div class="col-md-6">
							<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $signatory->name }}">

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
							<input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror" value="{{ old('designation') ?? $signatory->designation }}">

							@error('designation')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="form-group row mb-0">
					    <div class="col-md-6 offset-md-4">
							<button type="submit" class="btn btn-primary">Save Changes</button>
							<a href="{{ route('signatories.index') }}" class="btn btn-danger">Cancel</a>
						</div>
					</div>
				</form>	
			</div>
		</div>
	</div>	
</div>
@endsection
