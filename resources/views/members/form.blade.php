@csrf

@foreach ($columns as $column_name => $column_type)
	@if ($column_name != 'id' && $column_name !='created_at' && $column_name != 'updated_at')
		<div class="form-group row">	
	 		<label for="{{ $cname = $member->formColumnNameFormat($column_name) }}" class="col-md-4 col-form-label text-md-right">{{ $cname }}</label>

			<div class="col-md-6">
				@if ($column_type == 'integer')
						<input type="number" name="{{ $column_name }}" class="form-control @error($column_name) is-invalid @enderror" value="{{ old($column_name) }}">
				@elseif ($column_type == 'string')
					@if ($column_name == 'profile_picture')
						<input type="file" name="{{ $column_name }}" class="form-control-file @error($column_name) is-invalid @enderror" value="{{ old($column_name) }}">
					@else
						<input type="text" name="{{ $column_name }}" class="form-control @error($column_name) is-invalid @enderror" value="{{ old($column_name) }}">
					@endif
				@elseif ($column_type == 'date')
					<input type="date" name="{{ $column_name }}" class="form-control @error($column_name) is-invalid @enderror" value="{{ old($column_name) }}">
				@elseif ($column_type == 'decimal')
					<input type="number" name="{{ $column_name }}" class="form-control @error($column_name) is-invalid @enderror" value="{{ old($column_name) }}" step="0.01">
				@endif

				@error($column_name)
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div> 	
		</div>
	@endif
@endforeach	

<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
		<button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
	</div>
</div>