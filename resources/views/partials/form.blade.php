@csrf

@foreach ($columns as $column_name => $column_type)
	@if ($column_name != 'id' && $column_name !='created_at' && $column_name != 'updated_at')
		<div class="form-group row">	
			@if ($column_name == 'member_id')
				<label for="member" class="col-md-4 col-form-label text-md-right">Member</label>
			@else
	 			<label for="{{ $cname = $model->getColumnNameForView($column_name) }}" class="col-md-4 col-form-label text-md-right">{{ $cname }}</label>
	 		@endif

			<div class="col-md-6">
				@if ($column_type == 'integer')
					@if ($column_name == 'member_id')
						<select name="member_id" id="member_id" class="form-control">
							@foreach ($members as $member)
								<option value="{{ $member->id }}">{{ $member->full_name }}</option>
							@endforeach
						</select>
					@else
						<input type="number" name="{{ $column_name }}" class="form-control @error($column_name) is-invalid @enderror" value="{{ old($column_name) ?? $model[$column_name] }}" id="{{ $column_name }}" {{ $column_name == 'total' ? 'oninput=calculateAmount()' : '' }}>
					@endif
				@elseif ($column_type == 'string')
					@if ($column_name == 'profile_picture')
						<input type="file" name="{{ $column_name }}" class="form-control-file @error($column_name) is-invalid @enderror" value="{{ old($column_name) ?? $model[$column_name] }}">
					@else
						<input type="text" name="{{ $column_name }}" class="form-control @error($column_name) is-invalid @enderror" value="{{ old($column_name) ?? $model[$column_name] }}">
					@endif
				@elseif ($column_type == 'date')
					<input type="date" name="{{ $column_name }}" class="form-control @error($column_name) is-invalid @enderror" value="{{ old($column_name) ?? $model[$column_name] }}">
				@elseif ($column_type == 'decimal')
					<input type="number" name="{{ $column_name }}" class="form-control @error($column_name) is-invalid @enderror" value="{{ old($column_name) ?? $model[$column_name] }}" step="0.01" id="{{ $column_name }}" {{ $column_name == 'amount' ? 'readonly' : '' }} {{ $column_name == 'price' ? 'oninput=calculateAmount()' : '' }}>
				@elseif ($column_type == 'float')
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
	</div>
</div>