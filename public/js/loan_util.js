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
  return{
    get_total_interest:get_total_interest,
	get_payment_schedule:get_payment_schedule
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
