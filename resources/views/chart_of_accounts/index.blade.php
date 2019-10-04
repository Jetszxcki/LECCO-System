@extends('layouts.app')
@section('title', 'Chart of Accounts')

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

<style scoped>
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
        padding-top: 8px;
        padding-bottom: 6px;
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
        width: 32px;
        height: 22px;
    }

    .div-btn {
        width: 32px;
        height: 20px;
    }

    .legend, .legend-label {
        color: white;
        font-size: 12px;
    }
</style>

@section('content')
	<div class="form-group d-flex flex-row justify-content-between align-items-center">
		<h2>Chart of Accounts</h2>
	</div>

	@include('partials.flash')
    <!-- Note:
        - div/td elements with class md-number is ideally 12 in total per row!
            - thats why Table and form div's class col-number must total 12
            -  each row in accounts table is total to 12 (though last pad column in each row is optional.)
        - DELETE BUTTON MUST BE DISABLED/REMOVED IF ACCOUNT HAS CHILDREN! WE DON'T WANT ORPHANS (must implment something at backend for this too)
    -->
    <div class="row">
        <div id="main-table" class="col-md-7">
            <div class="row">
                <div class="lvl-1 col-md-10">
                    <div class="col-md-6">{{ $main->account_code }} ({{ $main->name }})</div>
                    <div class="col-md-5">
                        <a class="btn btn-size btn-success mr-1"></a>
                        <a class="btn btn-size btn-warning mr-1"></a>
                        <a class="btn btn-size btn-danger"></a>
                    </div>
                    <div class="col-md-1"><button class="btn btn-size btn-primary"></button></div>
                </div>
            </div>

            @if($main->children)
                @foreach($main->children as $children)
                    <div class="row">
                        <div class="left-pad col-md-1"></div>
                        <div class="lvl-2 col-md-10">
                            <div class="col-md-6">{{ $children->account_code }} ({{ $children->name }})</div>
                            <div class="col-md-5">
                                <a class="btn btn-size btn-success mr-1"></a>
                                <a class="btn btn-size btn-warning mr-1"></a>
                                <a class="btn btn-size btn-danger mr-1"></a>
                            </div>
                            <div class="col-md-1"><button class="btn btn-size btn-primary"></button></div>
                        </div>
                    </div>
                    @if($children->children)
                        @foreach($children->children as $grand_children)
                            <div class="row">
                                <div class="left-pad col-md-2"></div>
                                <div class="lvl-3 col-md-10">
                                    <div class="col-md-6">{{ $grand_children->account_code }} ({{ $grand_children->name }})</div>
                                    <div class="col-md-5">
                                        <a class="btn btn-size btn-success mr-1"></a>
                                        <a class="btn btn-size btn-warning mr-1"></a>
                                        <a class="btn btn-size btn-danger mr-1"></a>
                                    </div>
                                    <div class="col-md-1"><button class="btn btn-size btn-primary"></button></div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            @endif
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-md-center">New Account</div>
                <div class="card-body">
                    <form action="{{-- {{ route('accounts.store') }} --}}" method="POST">
                        @include('partials.form', [compact('columns'), 'route' => 'none', 'buttonText' => 'Add Account'])
                    </form>	
                </div>
            </div>

            <div class="d-flex flex-row justify-content-between mt-4">
                <p class="legend font-weight-bold">Legend:</p>
                <div class="btn div-btn btn-success"></div>
                <label class="legend-label">View</label>
                <div class="btn div-btn btn-warning"></div>
                <label class="legend-label">Edit</label>
                <div class="btn div-btn btn-danger"></div>
                <label class="legend-label">Delete</label>
                <div class="btn div-btn btn-primary"></div>
                <label class="legend-label">Add</label>
            </div>
        </div>
    </div>
@endsection