@csrf

@foreach ($columns as $column_name => $column_data)
	@if ($column_name != 'id' && $column_name !='created_at' && $column_name != 'updated_at')
		<div class="form-group row">	
			@if ($column_name == 'member_id')
				<label for="member_id" class="col-md-4 col-form-label text-md-right">Member</label>
			@else
	 			<label for="{{ $cname = $model->getColumnNameForView($column_name) }}" class="col-md-4 col-form-label text-md-right">{{ $cname }}</label>
	 		@endif

			<div class="col-md-6">
				@if ($column_data['type'] == 'integer')
					@if ($column_data['choices'])
						<select name="member_id" id="member_id" class="form-control @error($column_name) is-invalid @enderror">
							@foreach ($column_data['choices'] as $key => $value)
								<option value="{{ $key }}">{{ $value }}</option>
							@endforeach
						</select>
					@elseif ($column_name == 'member_id')
						<select name="member_id" id="member_id" class="form-control @error($column_name) is-invalid @enderror">
							@foreach ($members as $member)
								<option value="{{ $member->id }}">{{ $member->full_name }}</option>
							@endforeach
						</select>
					@else
						<input type="number" name="{{ $column_name }}" class="form-control @error($column_name) is-invalid @enderror" value="{{ old($column_name) ?? $model[$column_name] }}" id="{{ $column_name }}" {{ $column_name == 'total' ? 'oninput=calculateAmount()' : '' }}>
					@endif
				@elseif ($column_data['type'] == 'string')
					@if ($column_data['choices'])
						<div class="row">
						@foreach ($column_data['choices'] as $choice)
							<div class="col">
							<input type="radio" name="{{ $column_name }}" class="@error($column_name) is-invalid @enderror" value="{{ $choice }}" @if (old($column_name) == $choice) checked @endif>{{$choice}}
							</div>
						@endforeach
						</div>
					@elseif ($column_name == 'profile_picture')
						<input type="file" name="{{ $column_name }}" class="form-control-file @error($column_name) is-invalid @enderror" value="{{ old($column_name) ?? $model[$column_name] }}" aria-describedby="fileHelp">
						<small id="fileHelp" class="form-text text-muted">Size of image should not be more than 2MB.</small>
					@else
						<input type="text" name="{{ $column_name }}" class="form-control @error($column_name) is-invalid @enderror" value="{{ old($column_name) ?? $model[$column_name] }}">
					@endif
				@elseif ($column_data['type'] == 'date')
					<input type="date" name="{{ $column_name }}" class="form-control @error($column_name) is-invalid @enderror" value="{{ old($column_name) ?? $model[$column_name] }}">
				@elseif ($column_data['type'] == 'decimal')
					<input type="number" name="{{ $column_name }}" class="form-control @error($column_name) is-invalid @enderror" value="{{ old($column_name) ?? $model[$column_name] }}" step="0.01" id="{{ $column_name }}" {{ $column_name == 'amount' ? 'readonly' : '' }} {{ $column_name == 'price' ? 'oninput=calculateAmount()' : '' }}>
				@elseif ($column_data['type'] == 'float')
					<input type="number" name="{{ $column_name }}" class="form-control @error($column_name) is-invalid @enderror" value="{{ old($column_name) ?? $model[$column_name] }}" step="any">
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
		@if ($route == 'previous')
			<a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>
		@else
			<a href="{{ route($route) }}" class="btn btn-danger">Cancel</a>
		@endif
	</div>
</div>
