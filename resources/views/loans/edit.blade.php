@extends('layouts.app')
@section('title', 'Edit Loan')

@section('content')
@include('partials.flash')
<div class="row justify-content-center">
	<div id="loan-form" class="col-md-8">
		<div class="card">
			<div class="card-header text-md-center">EDIT LOAN</div>
			<div class="card-body">
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Loan</label>
                    <div class="col-md-6">
                        <!-- target="_blank" opens link to new tab -->
                        <a href="{{ route('loans.show', [$model]) }}" target="_blank" class="btn btn-success mr-1">View loan in new tab</a>
                    </div>
                </div>
				<form action="{{ route('loans.update', [$model]) }}" method="POST" enctype="multipart/form-data" id="loan-create-form">
					<div id="payment-schedule-hidden-form" style="display:none"></div>
					@method('PATCH')
					@include('partials.form', [compact('columns'), 'route' => 'loans.index', 'buttonText' => 'Save changes'])
				</form>
			</div>
		</div>
	</div>	
	<div id="parent-loan-details-holder" class="col-md-6 p-0" style="display: none;">
		<div id="loan-details-holder" class="mb-2">
			<div class="card">
				<div class="card-header text-md-center">LOAN DETAILS</div>
				<div id="loan-details" class="card-body" style="height: 175px; overflow-y: auto;"></div>
			</div>
		</div>
		<div id="payment-schedule-holder">
			<div class="card">
				<div class="card-header text-md-center">PAYMENT SCHEDULES</div>
				<div id="payment-schedule-details" class="card-body" style="height: 330px; overflow-y: auto"></div>
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('/js/payment_schedule_form.js') }}"></script>
<script src="{{ asset('/js/loan_util.js') }}"></script>
<script src="{{ asset('/js/loan_create.js') }}"></script>
@endsection
