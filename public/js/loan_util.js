/* 
	Loan utility functions here.
	- Trying to treat this as package (as it might have trouble with other scripts with same function names later on)
		- https://www.w3.org/community/webed/wiki/JavaScript_best_practices#Avoid_globals
	- you can add some yourself!
		Formulas
			- Implements fixed rates
		Render helpers
*/

loan_utils = function(){
	function get_total_interest(amount, ipa, term){
		return (term/12)*amount*ipa;
	}
	
	function get_payment_schedule(details){
		//TODO: create object for payment schedule here;
		return (term/12)*amount*ipa;
	}
	
	function nextMonth(date){
		next_month = new Date(date.getFullYear(), date.getMonth()+1, date.getDate());
		if(next_month.getDate() != date.getDate()){
			return ((new Date(next_month.getFullYear(), next_month.getMonth(), 0)));
		}else{
			return (next_month);
		}
	}
	
	function calculate_payment_schedule(details){
		var ret = [];
		var payrolls_count = Object.values(details.payrolls).length;
		var term = details.term;
		var principal = details.amount;
		var total_interest = details.total_interest;
		var ipa = details.ipa;
		var sop = details.sop;
		var interest = total_interest/payrolls_count;
		var monthly_payment = details.monthly_payment;
		var payment_day = new Date(sop);
		for(i = 0; i < term; i++){
			var payments_for_term = [];
			for(j = 0; j < payrolls_count; j++){
				var payroll_payments = new Object();
				payroll_payments.expected_payment_date = payment_day;
				payroll_payments.total_payment = monthly_payment/payrolls_count;
				payroll_payments.interest = interest/payrolls_count;
				payroll_payments.principal_payment = payroll_payments.total_payment-payroll_payments.interest;
				principal = principal-payroll_payments.principal_payment;
				payroll_payments.remaining_principal = principal;
				payments_for_term.push(payroll_payments);
			}
			payment_day = nextMonth(payment_day);
			ret.push(payments_for_term);
		}
		console.log(ret);
		return ret;
	}
	
  return{
    get_total_interest:get_total_interest,
	get_payment_schedule:get_payment_schedule,
	calculate_payment_schedule:calculate_payment_schedule
  }
}();

render_utils = function(){
	function as_percentage(num){
		return (num*100) + "%";
	}

  return{
    as_percentage:as_percentage
  }
}();
