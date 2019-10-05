@extends('layouts.app')
@section('title', 'Chart of Accounts')

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
    <div class="row" style="height: 400px;">
        <div id="main-table" class="col-md-7 pr-4">
            @foreach ($mains as $main)
                {{-- 1st level --}}
                <div id="lvl-1-group-{{ $loop->index }}">
                    @include('partials.accounts_row', [compact('main','loop'), 'level' => 1])

                    {{-- 2nd level --}}
                    <div id="lvl-2-group-{{ $loop->index }}-{{ $unique_index++ }}">
                        @foreach($main->children as $children)
                            @include('partials.accounts_row', [compact('loop'), 'main' => $children, 'level' => 2])

                            {{-- 3rd level --}}
                            <div id="lvl-3-group-{{ $loop->index }}-{{ $unique_index++ }}">
                                @foreach($children->children as $grand_children)
                                    @include('partials.accounts_row', ['main' => $grand_children, 'level' => 3])
                                @endforeach

                               @include('partials.add_account_btn', ['level' => 3])
                            </div>

                        @endforeach

                        @include('partials.add_account_btn', ['level' => 2])
                    </div>
                </div>
            @endforeach

            @include('partials.add_account_btn', ['level' => 1])
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-md-center">NEW ACCOUNT</div>
                <div class="card-body">
                    <form action="{{-- {{ route('accounts.store') }} --}}" method="POST">
                        @include('partials.form', [compact('columns'), 'route' => 'none', 'buttonText' => 'Add Account'])
                    </form>	
                </div>
            </div>

            <div class="d-flex flex-row justify-content-between mt-4">
                <div class="btn btn-size btn-success"></div>
                <label class="legend-label">View</label>
                <div class="btn btn-size btn-warning"></div>
                <label class="legend-label">Edit</label>
                <div class="btn btn-size btn-danger"></div>
                <label class="legend-label">Delete</label>
                <div class="btn btn-size btn-toggle"></div>
                <label class="legend-label">Hide/Show Children</label>
            </div>
        </div>
    </div>
@endsection

<script>
    function toggle(id) {
        $(id).children().animate({ height: 'toggle', opacity: 'toggle' }, 'fast');
    }
</script>

{{-- scoped keyword signifies that the style is only applicable only to this file --}}
<style scoped>
    #main-table {
        height: 400px;
        overflow-y: auto;
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