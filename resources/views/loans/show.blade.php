@extends('layouts.app')
@section('title',  "Loan")

@section('content')
	@include('partials.flash')
	<div class="container">
		<div class="card mb-4">
			<div class="card-header text-md-center">LOAN DETAILS</div>
			<div id="loan-details" class="card-body">
				<div class="row">
					<div class="col-sm-3">Loan ID: </div>
					<div class="col-sm-3 font-weight-bold">{{ $loan->id }}</div>
					
					<div class="col-sm-3">Member: </div>
					<div class="col-sm-3">
						<a style="text-decoration: none; font-weight: bold;" href="{{ route('members.show', [$loan->member]) }}" >{{ $loan->member->full_name }}
						</a>
					</div>
					
					<div class="col-sm-3">Loan Type: </div>
					<div class="col-sm-3 font-weight-bold">{{ $loan->loan_type_object->name }}</div>
					
					<div class="col-sm-3">Amount: </div>
					<div class="col-sm-3 font-weight-bold">{{ $loan->amount }}</div>
					
					<div class="col-sm-3">Term: </div>
					<div class="col-sm-3 font-weight-bold">{{ $loan->term }}</div>
					
					<div class="col-sm-3">Interest Per Annum: </div>
					<div class="col-sm-3 font-weight-bold">{{ $loan->interest_per_annum }}</div>
					
					<div class="col-sm-3">Start of Payment: </div>
					<div class="col-sm-3 font-weight-bold">{{ $loan->start_of_payment }}</div>
					
					<div class="col-sm-3">Remaining Principal: </div>
					<div class="col-sm-3 font-weight-bold">{{ $loan->remaining_principal }}</div>
					
					<div class="col-sm-3">Date Created: </div>
					<div class="col-sm-3 font-weight-bold">{{ $loan->created_at }}</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-sm-2">Remarks: </div>
					<div class="col-sm-5 font-weight-bold">{{ $loan->remarks }}</div>
					
					<div class="col-sm-2">Payrolls: </div>
					<div class="col-sm-3 font-weight-bold">
						<ul>
						@foreach($loan->payrolls()->get() as $payroll)
							<li>{{ $payroll->name }}</li>
						@endforeach
						</ul>
					</div>
				</div>
				<hr>
				<div class="d-flex flex-row justify-content-center">
					@accessright('loans_edit')
						<a href="{{ route('loans.edit', [$loan]) }}" class="btn btn-warning mr-2">Edit</a>
					@endaccessright
					
					@accessright('loans_delete')
						<form action="{{ route('loans.destroy', [$loan]) }}" method="POST">
							@method('DELETE')
							@csrf

							<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this loan?')">Delete</button>
						</form>
					@endaccessright
				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-header text-md-center">PAYMENT SCHEDULES</div>
			<div id="loan-details" class="card-body">
			
				@foreach($loan->payrolls()->get() as $payroll)
					<div class="d-flex flex-row justify-content-center mb-1">
						<h4 style="letter-spacing: 1px;">{{ $payroll->name }}</h4>
					</div>
					<div class="table overflow-horizontal">
						<div class="row text-center">
							<div class="col-sm-1">Payment No.</div>
							<div class="col-sm-2">Expected Payment Date</div>
							<div class="col-sm-3">Actual Payment Date</div>
							<div class="col-sm-1">Penalty Interest</div>
							<div class="col-sm-1">Amount Paid</div>
							<div class="col-sm-1">Interest</div>
							<div class="col-sm-1">Principal Payment</div>
							<div class="col-sm-2">Remaining Principal</div>
						</div>
						<hr>
						@foreach($payroll->pivot->payment_schedules as $payment_schedule)
							<div class="row text-center">
							<div class="col-sm-1">{{ $payment_schedule->term }}</div>
							<div class="col-sm-2">{{ $payment_schedule->expected_payment_date }}</div>
							<div class="col-sm-3">
							@if($loan->next_payment_schedule)
								@if($loan->next_payment_schedule->id == $payment_schedule->id)
									<form action="{{ route('payment_schedule.up', [$loan, $payment_schedule]) }}" method="POST" class="d-flex flex-row justify-content-between">
										@method('PATCH')
										@csrf
										<input
											type="date"
											name="actual_payment_date"
											class="form-control"
											style="font-size: 15px; height: 25px; width: 70%;"
											value="{{ $payment_schedule->expected_payment_date }}"
										/>
										<input type="submit" class="btn btn-warning" style="width: 30%; height: 25px; line-height: 50%" value="Update"/>
									</form>
								@else
									<div class="d-flex flex-row justify-content-between">
										<label style="width: 70%">{{ $payment_schedule->actual_payment_date }}</label>
										@if($loan->last_payment_schedule)
											@if($loan->last_payment_schedule->id == $payment_schedule->id)
												<form action="{{ route('payment_schedule.down', [$loan, $payment_schedule]) }}" method="POST" style="width: 30%">
													@method('PATCH')
													@csrf
													<input
														type="hidden"
														name="actual_payment_date"
														class="form-control"
														value=""
													/>
													<input type="submit" class="btn btn-danger" style="height: 25px; line-height: 50%" value="Revert"/>
												</form>
											@endif
										@endif
									</div>
								@endif
							@endif
							</div>
							<div class="col-sm-1">{{ $payment_schedule->penalty_interest }}</div>
							<div class="col-sm-1">{{ $payment_schedule->total_payment }}</div>
							<div class="col-sm-1">{{ $payment_schedule->interest }}</div>
							<div class="col-sm-1">{{ $payment_schedule->principal_payment }}</div>
							<div class="col-sm-2">{{ $payment_schedule->remaining_principal }}</div>
						</div>
						@endforeach
					</div>
				@endforeach
			</div>
		</div>
	</div>
@endsection