@extends('layouts.app')
@section('title', 'Chart of Accounts')

@section('content')
	<div class="form-group d-flex flex-row justify-content-between align-items-center">
		<h2>Chart of Accounts</h2>

		@accessright('loan_types_create')
			<a href="{{ route('loan_types.create') }}" class="btn btn-primary">Add Account</a>
		@endaccessright

		@include('partials.search_bar')
	</div>

	@include('partials.flash')
    <!-- Note:
        - div/td elements with class md-number is ideally 12 in total per row!
            - thats why Table and form div's class col-number must total 12
            -  each row in accounts table is total to 12 (though last pad column in each row is optional.)
        - DELETE BUTTON MUST BE DISABLED/REMOVED IF ACCOUNT HAS CHILDREN! WE DON'T WANT ORPHANS (must implment something at backend for this too)
    -->
    <div class="row">
        <div class="col-md-7">
            <div class="container card-body" id="main-table">
                <div class="row">
                    <div class="col-md-5">{{ $main->account_code }} ({{ $main->name }})</div>
                    <div class="col-md-4">
                        <a class="btn btn-success mr-1">View</a>
                        <a class="btn btn-warning mr-1">Edit</a>
                        <a class="btn btn-danger mr-1">Delete</a>
                    </div>
                    <div class="col-md-1"><button class="btn btn-primary">+</button></div>
                    <div class="col-md-2">PAD</div>
                </div>
                    @if($main->children)
                        @foreach($main->children as $children)
                            <div class="row">
                                <div class="col-md-1">|__</div>
                                <div class="col-md-5">{{ $children->account_code }} ({{ $children->name }})</div>
                                <div class="col-md-4">
                                    <a class="btn btn-success mr-1">View</a>
                                    <a class="btn btn-warning mr-1">Edit</a>
                                    <a class="btn btn-danger mr-1">Delete</a>
                                </div>
                                <div class="col-md-1"><button class="btn btn-primary">+</button></div>
                                <div class="col-md-1">PAD</div>
                            </div>
                            @if($children->children)
                                @foreach($children->children as $grand_children)
                                    <div class="row">
                                        <div class="col-md-1">|__</div>
                                        <div class="col-md-1">|__</div>
                                        <div class="col-md-5">{{ $grand_children->account_code }} ({{ $grand_children->name }})</div>
                                        <div class="col-md-4">
                                            <a class="btn btn-success mr-1">View</a>
                                            <a class="btn btn-warning mr-1">Edit</a>
                                            <a class="btn btn-danger mr-1">Delete</a>
                                        </div>
                                        <div class="col-md-1"><button class="btn btn-primary">+</button></div>
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-md-center">New Account</div>
                <div class="card-body">
                    <form action="{{--{{route('loan_types.store')}}--}}" method="POST">
                        @include('partials.form', [compact('columns'), 'route' => 'loan_types.index', 'buttonText' => 'Add Account'])
                    </form>	
                </div>
            </div>
        </div>
    </div>
@endsection