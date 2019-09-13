@csrf

@foreach ($columns as $column_name => $column_type)
	@if ($column_name != 'id' && $column_name !='created_at' && $column_name != 'updated_at')
		<div class="form-group row">	
			@if ($column_name == 'member_id')
				<label for="member_id" class="col-md-4 col-form-label text-md-right">Member</label>
			@else
	 			<label for="{{ $cname = $model->getColumnNameForView($column_name) }}" class="col-md-4 col-form-label text-md-right">{{ $cname }}</label>
	 		@endif

			<div class="col-md-6">

				{{-- if you want to add more blade directives (@isField/@elseifField), go to App\Providers\AppServiceProvider.php --}}

				@isChoices($column_type)
					<select name="{{ $column_name }}" id="{{ $column_name }}" class="form-control @error($column_name) is-invalid @enderror">
						@foreach ($choices[$choices[0]++] as $key => $value)
							<option value="{{ $key }}">{{ $value }}</option>
						@endforeach
					</select>

				@elseifInteger($column_type)
					{{-- @if ($column_data['choices'])
						<select name="{{ $column_name }}" id="{{ $column_name }}" class="form-control @error($column_name) is-invalid @enderror">
							@foreach ($column_data['choices'] as $key => $value)
								<option value="{{ $key }}">{{ $value }}</option>
							@endforeach
						</select>
					@else --}}
					<input type="number" name="{{ $column_name }}" class="form-control @error($column_name) is-invalid @enderror" value="{{ old($column_name) ?? $model[$column_name] }}" id="{{ $column_name }}" {{ $column_name == 'total' ? 'oninput=calculateAmount()' : '' }} @disabled($column_type) readonly @enddisabled>
					{{-- @endif --}}
				@elseifString($column_type)
					{{-- @if ($column_data['choices'])
						@if (array_key_exists('select_box', $column_data))
							<select name="{{ $column_name }}" id="{{ $column_name }}" class="form-control @error($column_name) is-invalid @enderror">
								@foreach ($column_data['choices'] as $key => $value)
									<option value="{{ $key }}">{{ $value }}</option>
								@endforeach
							</select>
						@else
							<div class="table">
							@foreach ($column_data['choices'] as $choice)
								<div class="row">
								<label><input type="radio" name="{{ $column_name }}" class="@error($column_name) is-invalid @enderror" value="{{ $choice }}" @if (old($column_name) == $choice) checked @endif>{{$choice}}</label>
								</div>
							@endforeach
							</div>
						@endif --}}
					@if ($column_name == 'profile_picture')
						<input type="file" name="{{ $column_name }}" class="form-control-file @error($column_name) is-invalid @enderror" value="{{ old($column_name) ?? $model[$column_name] }}" aria-describedby="fileHelp">
						<small id="fileHelp" class="form-text text-muted">Size of image should not be more than 2MB.</small>
					@else
						<input type="text" name="{{ $column_name }}" class="form-control @error($column_name) is-invalid @enderror" value="{{ old($column_name) ?? $model[$column_name] }}" @disabled($column_type) readonly @enddisabled>
					@endif

				@elseifDate($column_type)
					<input type="date" name="{{ $column_name }}" class="form-control @error($column_name) is-invalid @enderror" value="{{ old($column_name) ?? $model[$column_name] }}" @disabled($column_type) readonly @enddisabled>

				@elseifDecimal($column_type)
					<input 
						type="number" 
						name="{{ $column_name }}" 
						class="form-control @error($column_name) is-invalid @enderror" 
						value="{{ old($column_name) ?? $model[$column_name] }}" 
						step="0.01" 
						id="{{ $column_name }}" 
						@disabled($column_type) readonly @enddisabled
						{{ $column_name == 'price' ? 'oninput=calculateAmount()' : '' }}
						>
				@elseifFloat($column_type)
					<input type="number" name="{{ $column_name }}" class="form-control @error($column_name) is-invalid @enderror" value="{{ old($column_name) ?? $model[$column_name] }}" step="any" @disabled($column_type) readonly @enddisabled>

				@elseis
					<input type="text" name="{{ $column_name }}" class="form-control @error($column_name) is-invalid @enderror" value="{{ old($column_name) ?? $model[$column_name] }}" @disabled($column_type) readonly @enddisabled>
					<small id="fileHelp" class="form-text text-muted">Can't process field type, this is the default inputfield</small>
				@endis

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
		
		<a href="{{ $route == 'previous' ? url()->previous() : route($route) }}" class="btn btn-danger">Cancel</a>
	</div>
</div>
