@extends('layouts.app')
@section('title', 'Chart of Accounts')

@section('content')
	<div class="form-group d-flex flex-row justify-content-between align-items-center">
		<h2>Chart of Accounts</h2>

        @accessright('chart_of_accounts_create')
            <button 
                id="new-acct-btn" 
                class="btn btn-primary" 
                style="visibility: hidden;" 
                onclick="viewMode('add')"
            >
                New Account
            </button>
        @endaccessright
	</div>

	@include('partials.flash')
    <!-- Note:
        - div/td elements with class md-number is ideally 12 in total per row!
            - thats why Table and form div's class col-number must total 12
            -  each row in accounts table is total to 12 (though last pad column in each row is optional.)

        - DELETE BUTTON MUST BE DISABLED/REMOVED IF ACCOUNT HAS CHILDREN! WE DON'T WANT ORPHANS (must implment something at backend for this too)
    -->
    <div class="row" style="height: 400px;">
        <div id="main-table" class="col-md-7 pr-4">
            {{-- 1st level --}}
            <div id="lvl-1-group">
                @include('partials.accounts_row', ['account' => $main, 'level' => 1])

                {{-- 2nd level --}}
                <div id="lvl-2-group-{{ $unique_index++ }}">
                    @foreach($main->children as $children)
                        @include('partials.accounts_row', ['account' => $children, 'level' => 2])

                        {{-- 3rd level --}}
                        <div id="lvl-3-group-{{ $unique_index++ }}">
                            @foreach($children->children as $grand_children)
                                @include('partials.accounts_row', ['account' => $grand_children, 'level' => 3])
                            @endforeach
                        </div>
                        {{-- 3rd level end --}}
                    @endforeach
                </div>
                {{-- 2nd level end --}}
            </div>
            {{-- 1st level end --}}
        </div>

        <div class="col-md-5 mb-4">
            <div id="form-holder" class="card">
                <div id="form-header" class="card-header text-md-center">NEW ACCOUNT</div>
                <div id="form-body" class="card-body">

                    <form id="form-main" action="{{ route('accounts.store') }}" method="POST">
                        @include('partials.form', [compact('columns'), 'route' => 'none', 'buttonText' => 'Add Account'])
                    </form>	

                </div>
            </div>

            <div class="d-flex flex-row justify-content-between mt-4">
                <div class="b-rad-4 btn-size btn-success"></div>
                <label class="legend-label">View</label>
                <div class="b-rad-4 btn-size btn-warning"></div>
                <label class="legend-label">Edit</label>
                <div class="b-rad-4 btn-size btn-danger"></div>
                <label class="legend-label">Delete</label>
                <div class="b-rad-4 btn-size btn-primary"></div>
                <label class="legend-label">Set as Parent Account</label>
            </div>
            <div class="d-flex flex-row justify-content-start mt-2">
                <div class="b-rad-4 btn-size btn-toggle mr-3"></div>
                <label class="legend-label">Hide/Show Children</label>
            </div>
        </div>
    </div>

    <script src="{{ asset('/js/accounts.js') }}"></script>

@endsection

{{-- scoped keyword signifies that the style is only applicable only to this file --}}
<style scoped>
    #main-table {
        height: 400px;
        overflow-y: auto;
    }

    .b-rad-4 {
        border-radius: 4px;
    }

    div.lvl-1, 
    div.lvl-2, 
    div.lvl-3 {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;

        font-size: 0.7rem;
        font-weight: bold;

        color: white;
        letter-spacing: 1px;
        border-radius: 8px;
        box-shadow: .2rem .2rem .2rem black;
        padding-left: 0;
        padding-top: 6px;
        padding-bottom: 4px;
        margin-bottom: 10px;
    }

    div.lvl-1 {
        background: #212F3D;
    }

    div.lvl-2 {
        background: teal;
    }

    div.lvl-3 {
        color: black;
        background: #ABEBC6;
    }

    div.left-pad {
        background: #34495E;
    }

    .btn-size {
        width: 30px;
        height: 20px;
    }

    .btn-container {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
    }

    .btn-toggle {
        background: #AEB6BF;
    }

    .legend-label {
        color: white;
        font-size: 12px;
    }
</style>