@if (session('message'))
	<div class="alert ls-1 @if(session('styles')) {{ session('styles') }} @endif">
		{{ session('message') }}
	</div>
@endif