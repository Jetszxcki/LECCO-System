@csrf

@foreach ($columns as $column_name => $column_data)
	{{-- for testing purposes --}}
	@if($column_data['type'] == 'none')
		@continue
	@endif
	{{-- end --}}
	@if ( !in_array($column_name, array('id', 'created_at', 'updated_at', 'created_by', 'updated_by')) )
		<div class="form-group row">	
			@if ($column_name == 'member_id')
				<label for="{{ $column_name }}" class="col-md-4 col-form-label text-md-right">Member</label>
			@elseif ($column_name == 'cv_no')
				<label for="{{ $column_name }}" class="col-md-4 col-form-label text-md-right">CV No</label>
			@else
	 			<label for="{{ $column_name }}" class="col-md-4 col-form-label text-md-right">{{ $model->getColumnNameForView($column_name) }}</label>
	 		@endif

			<div class="col-md-6">

				{{-- if you want to add more blade directives (@isField/@elseifField), go to App\Providers\AppServiceProvider.php --}}

				@if($column_data['type'] == 'choices')
					{{-- for multiple select, add "[]" in column name (EX. name="{{ $column_name+"[]" }}") -https://stackoverflow.com/a/14431457 --}}
					<select
						name="{{ $column_name }}{{ $column_data['multiple']?'[]':'' }}"
						id="{{ $column_name }}"
						class="form-control @error($column_name) is-invalid @enderror"
						{{ $column_data['multiple']?'multiple':'' }}
						@if ($column_name == 'loan_type') onchange="set_interest(get_interest())" @endif
					>
							@foreach ($column_data['choices'] as $key => $value)
								<option value="{{ $key }}" 
                                    @if($column_data['multiple'])
                                        {{ in_array($key, (old($column_name) ?? $model[$column_name]->pluck('id')->all()), false)? "selected": "" }}
                                    @else
                                        {{ (old($column_name) ?? $model[$column_name])==$key? "selected": "" }}
                                    @endif
                                >{{ $value }}</option>
							@endforeach
					</select>

				@elseif($column_data['type'] == 'integer' || $column_data['type'] == 'bigint')

					<input type="number" name="{{ $column_name }}" id="{{ $column_name }}" class="form-control @error($column_name) is-invalid @enderror" value="{{ old($column_name) ?? $model[$column_name] }}" id="{{ $column_name }}" {{ $column_name == 'total' ? 'oninput=calculateAmount()' : '' }} @disabled($column_data) readonly @enddisabled>
					
				@elseif($column_data['type'] == 'string')
					@if (in_array($column_name, array('profile_picture', 'attachment')))
						<input type="file" name="{{ $column_name }}" id="{{ $column_name }}" class="form-control-file @error($column_name) is-invalid @enderror" value="{{ old($column_name) ?? $model[$column_name] }}" aria-describedby="fileHelp">
						<small id="fileHelp" class="form-text text-muted">Size of image should not be more than 2MB.</small>
					@else
						<input type="text" name="{{ $column_name }}" id="{{ $column_name }}" class="form-control @error($column_name) is-invalid @enderror" value="{{ old($column_name) ?? $model[$column_name] }}" @disabled($column_data) readonly @enddisabled>
					@endif

				@elseif($column_data['type'] == 'date')
					<input type="date" name="{{ $column_name }}" id="{{ $column_name }}" class="form-control @error($column_name) is-invalid @enderror" value="{{ old($column_name) ?? $model[$column_name] }}" @disabled($column_data) readonly @enddisabled>
				@elseif($column_data['type'] == 'decimal')
					<input 
						type="number" 
						name="{{ $column_name }}" 
						id="{{ $column_name }}"
						class="form-control @error($column_name) is-invalid @enderror" 
						value="{{ old($column_name) ?? $model[$column_name] }}" 
						step="0.01" 
						id="{{ $column_name }}" 
						@disabled($column_data) readonly @enddisabled
						{{ $column_name == 'price' ? 'oninput=calculateAmount()' : '' }}
						>
				@elseif($column_data['type'] = 'float')
					<input type="number" name="{{ $column_name }}" id="{{ $column_name }}" class="form-control @error($column_name) is-invalid @enderror" value="{{ old($column_name) ?? $model[$column_name] }}" step="any" @disabled($column_data) readonly @enddisabled>
				@else
					<input type="text" name="{{ $column_name }}" id="{{ $column_name }}" class="form-control @error($column_name) is-invalid @enderror" value="{{ old($column_name) ?? $model[$column_name] }}" @disabled($column_data) readonly @enddisabled>
					<small id="fileHelp" class="form-text text-muted">Can't process field type, this is the default inputfield</small>
				@endif
				@error($column_name)
					<span id="err-{{ $column_name }}" class="invalid-feedback" role="alert">
						{{ $message }}
					</span>
				@enderror
				@if(isset($column_data['help_text']))
					<small id="fileHelp" class="form-text text-muted">
						@if(isset($column_data['help_path']))
							<a href="{{ $column_data['help_path'] }}" rel="noopener noreferrer" target="_blank">
								{{ $column_data['help_text'] }}
							</a> 	
						@else	
							{{ $column_data['help_text'] }}
						@endif
					</small>
				@endif
			</div> 	
		</div>
	@endif
@endforeach	

<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4 d-flex flex-row">
        @isset($buttonText)
            <button id="form-btn" type="submit" class="btn btn-primary">{{ $buttonText }}</button>
        @endisset
		@if($route != 'none')
			<a id="cancel-form-btn" href="{{ $route == 'previous' ? url()->previous() : route($route) }}" class="btn btn-danger ml-2">Cancel</a>
		@endif
	</div>
</div>
