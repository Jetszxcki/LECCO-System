@if (session('message'))
	<div class="alert ls-1 @if(session('styles')) {{ session('styles') }} @endif">
		<span>{{ session('message') }}</span>
		<button type="button" class="close" data-dismiss="alert">×</button>
	</div>
@endif