<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Loan;
use App\PaymentSchedule;

class PaymentSchedulesController extends Controller
{
	public function paymentUp(Request $request, Loan $loan, PaymentSchedule $payment_schedule)
	{
		$payment_schedule->update($this->upValidation($request));
		return redirect('loans/' . $loan->id)->with([
            'message' => "Payment Schedule successfully updated.",
            'styles' => 'alert-success'
        ]);
	}
	
	public function paymentDown(Request $request, Loan $loan, PaymentSchedule $payment_schedule)
	{
		$payment_schedule->update(['actual_payment_date'=>null]);
		return redirect('loans/' . $loan->id)->with([
            'message' => "Payment Schedule successfully updated.",
            'styles' => 'alert-success'
        ]);
	}
	
    private function upValidation($request)
    {
        return $request->validate([
            'actual_payment_date' => 'required'
        ]);
    }
}
