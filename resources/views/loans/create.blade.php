@extends('layouts.app')
@section('title', 'Add Loan')

@section('content')
<div class="row justify-content-center">
	<div id="loan-form" class="col-md-8">
		<div class="card">
			<div class="card-header text-md-center">NEW LOAN</div>
			<div class="card-body">
				<form action="{{ route('loans.store') }}" method="POST" enctype="multipart/form-data" id="loan-create-form">
					<div id="payment-schedule-hidden-form" style="display:none"></div>
					@include('partials.form', [compact('columns'), 'route' => 'loans.index', 'buttonText' => 'Add Loan'])
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
