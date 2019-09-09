<h5 style="letter-spacing: 2px;">{{ $header }}</h5>

<div class="custom-control custom-checkbox d-flex flex-wrap align-items-center alert alert-info mb-4">
	@foreach ($columns as $column)
		@if (($user->access_right->hasPrefix($header, $column) && $column != 'user_id')
			|| ($user->access_right->hasPrefix($header, 'user') && $column == 'invoke_rights'))

			<div class="d-flex flex-row col-md-3 align-items-center py-2">
				<input type="checkbox" id="{{ $column }}" name="{{ $column }}" value="{{ $user->access_right[$column] }}" class="custom-control-input" {{ $user->access_right[$column] ? 'checked' : '' }}>

				<label class="custom-control-label" for="{{ $column }}">{{ $user->access_right->toSuffix($column) }}</label>
			</div>

		@endif
	@endforeach
</div>
