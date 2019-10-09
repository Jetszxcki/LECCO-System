<!--
    DOCUMENTATION ON LAYOUT:
        let CONTENT = the part of the row which is not the pad
        let LPAD = the left pad of the row
        **the right pad is no need since col-md-number already provides a pad for it**
    
        All row level are first enclosed in a div with class="row"

        Level 1 (Parent-most account):
            CONTENT = "lvl-1 col-md-10"
            LPAD = none

        Level 2 (First generation-offspring):
            CONTENT = "lvl-2 col-md-10"
            LPAD = "left-pad col-md-1"

        Level 3 (Second-generation offspring):
            CONTENT = "lvl-3 col-md-10"
            LPAD = "left-pad col-md-2"
-->


<div class="row">
    @if ($level == 1)
        <div class="lvl-1 col-md-10">
            <div class="col-md-1 btn-container">
                <button class="btn btn-size btn-toggle" 
                        onclick="toggle('#lvl-2-group-{{ $unique_index }}')">
                </button>
            </div> 

    @elseif ($level == 2)
        <div class="left-pad col-md-1"></div>
        <div class="lvl-2 col-md-10">
            <div class="col-md-1 btn-container">
                <button class="btn btn-size btn-toggle" 
                        onclick="toggle('#lvl-3-group-{{ $unique_index }}')">
                </button>
            </div> 

    @elseif ($level == 3)
        <div class="left-pad col-md-1"></div>
        <div class="left-pad col-md-1"></div>
        <div class="lvl-3 col-md-10">

    @endif

        <div class="col-md-{{ $level == 3 ? '10' : '8' }}">{{ $account->full_account_name }}</div>
        <div class="btn-container col-md-{{ $level == 3 ? '2' : '3' }}">
            @if ($level != 3)
                @accessright('chart_of_accounts_create')
                    <a 
                        id="select-parent-btn-{{ $account->account_code }}"
                        name="select-parent-btn" 
                        class="btn btn-size btn-primary mr-1"
                        onclick="setParentAccount({{ $account }})" 
                    >
                    </a>
                @endaccessright
            @endif

            @accessright('chart_of_accounts_view')
                <a 
                    class="btn btn-size btn-success mr-1"
                    onclick="viewMode('show', {{ $account }})"
                >
                </a>
            @endaccessright

            @accessright('chart_of_accounts_edit') 
                <a 
                    class="btn btn-size btn-warning" 
                    onclick="viewMode('edit', {{ $account }}, {{ $account->hasChildren() }})"
                >
                </a> 
            @endaccessright

            @accessright('chart_of_accounts_delete') 
                @if(! $account->hasChildren())
                    <form action="{{ route('accounts.destroy', [$account]) }}" method="POST" class="p-0 m-0 ml-1">
                        @method('DELETE')
                        @csrf

                        <button type="submit" class="btn btn-size btn-danger" style="width: 20px" onclick="return confirm('Are you sure you want to delete this account?')"></button> 
                    </form>
                @endif
            @endaccessright
        </div>
    </div>

</div>

