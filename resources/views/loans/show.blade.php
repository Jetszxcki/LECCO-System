@extends('layouts.app')
@section('title',  "Loan")

@section('content')
	@include('partials.flash')
	<div class="container bg-dark mt-3">
		<br>
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header text-md-center">Loan Details</div>
					<div id="loan-details" class="card-body">
						<div class="row">
							<div class="col-sm-3">Loan ID: </div>
							<div class="col-sm-3">{{ $loan->id }}</div>
							
							<div class="col-sm-3">Member: </div>
							<div class="col-sm-3"><a href="{{ route('members.show', [$loan->member]) }}" >{{ $loan->member->full_name }}</a></div>
							
							<div class="col-sm-3">Loan Type: </div>
							<div class="col-sm-3">{{ $loan->loan_type_object->name }}</div>
							
							<div class="col-sm-3">Amount: </div>
							<div class="col-sm-3">{{ $loan->amount }}</div>
							
							<div class="col-sm-3">Term: </div>
							<div class="col-sm-3">{{ $loan->term }}</div>
							
							<div class="col-sm-3">Interest per annum: </div>
							<div class="col-sm-3">{{ $loan->interest_per_annum }}</div>
							
							<div class="col-sm-3">Start of Payment: </div>
							<div class="col-sm-3">{{ $loan->start_of_payment }}</div>
							
							<div class="col-sm-3">Remaining Principal: </div>
							<div class="col-sm-3">{{ $loan->remaining_principal }}</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-2">Remarks: </div>
							<div class="col-sm-6">{{ $loan->remarks }}</div>
							
							<div class="col-sm-1">Payroll: </div>
							<div class="col-sm-3">
								<ul>
								@foreach($loan->payrolls()->get() as $payroll)
									<li>{{ $payroll->name }}</li>
								@endforeach
								</ul>
							</div>
						</div>
						<div class="row">
							@accessright('loans_edit')
								<div class="col-sm-1">
									<a href="{{--{{ route('loans.edit', [$loan]) }}--}}" class="btn btn-warning">Edit</a>
								</div>
							@endaccessright
							
							@accessright('loans_delete')
								<div class="col-sm-1">
									<form action="{{ route('loans.destroy', [$loan]) }}" method="POST">
										@method('DELETE')
										@csrf

										<button type="submit" class="btn btn-danger">Delete</button>
									</form>
								</div>
							@endaccessright
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header text-md-center">Payment Schedule</div>
					<div id="loan-details" class="card-body">
					
						@foreach($loan->payrolls()->get() as $payroll)
							<div class="row">
								<h4>{{ $payroll->name }}</h4>
								<div class="table">
									<div class="row">
										<div class="col-sm-1">Payment No.</div>
										<div class="col-sm">Expected Payment Date</div>
										<div class="col-sm">Actual Payment Date</div>
										<div class="col-sm">Amount Paid</div>
										<div class="col-sm">Interest</div>
										<div class="col-sm">Principal Payment</div>
										<div class="col-sm">Remaining Principal</div>
									</div>
									<hr>
									@foreach($payroll->pivot->payment_schedules as $payment_schedule)
										<div class="row">
										<div class="col-sm-1">{{ $payment_schedule->term }}</div>
										<div class="col-sm">{{ $payment_schedule->expected_payment_date }}</div>
										<div class="col-sm-2">
										@if($loan->next_payment_schedule)
											@if($loan->next_payment_schedule->id == $payment_schedule->id)
												<form action="{{ route('payment_schedule.up', [$loan, $payment_schedule]) }}" method="POST">
													@method('PATCH')
													@csrf
													<input
														type="date"
														name="actual_payment_date"
														class="form-control"
														value="{{ $payment_schedule->expected_payment_date }}"
													/>
													<input type="submit" class="btn btn-warning" value="Update"/>
												</form>
											@else
												{{ $payment_schedule->actual_payment_date }}
												@if($loan->last_payment_schedule)
													@if($loan->last_payment_schedule->id == $payment_schedule->id)
														<form action="{{ route('payment_schedule.down', [$loan, $payment_schedule]) }}" method="POST">
															@method('PATCH')
															@csrf
															<input
																type="hidden"
																name="actual_payment_date"
																class="form-control"
																value=""
															/>
															<input type="submit" class="btn btn-danger" value="Revert"/>
														</form>
													@endif
												@endif
											@endif
										@endif
										</div>
										<div class="col-sm">{{ $payment_schedule->total_payment }}</div>
										<div class="col-sm">{{ $payment_schedule->interest }}</div>
										<div class="col-sm">{{ $payment_schedule->principal_payment }}</div>
										<div class="col-sm">{{ $payment_schedule->remaining_principal }}</div>
									</div>
									@endforeach
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
		<br>
	</div>
	
@endsection