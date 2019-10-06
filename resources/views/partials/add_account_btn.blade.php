<div class="row mb-2">

	@if ($level == 2 || $level == 3)
	    <div class="left-pad col-md-1"></div>
	@endif

    @if ($level == 3)
    	<div class="left-pad col-md-1"></div>
    @endif

    @accessright('chart_of_accounts_create')
        <button 
            class="btn btn-primary col-md-10" 
        	style="line-height: 90%; letter-spacing: 1px;"
            onclick="setParentAccount({{ $level == 3 ? $children : $main }})" 
        >
        	Add Account
        </button>
    @endaccessright
</div>
