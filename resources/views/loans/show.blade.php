@extends('layouts.app')
@section('title',  "Loan")

@section('content')
	@include('partials.flash')
	<div class="container col-sm-11">
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
						<h3 style="letter-spacing: 1px;">{{ $payroll->name }}</h3>
					</div>
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
				@endforeach
			</div>
		</div>
	</div>
@endsection