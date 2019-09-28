/* 
	Loan utility functions here.
	- Trying to treat this as package (as it might have trouble with other scripts with same function names later on)
		- https://www.w3.org/community/webed/wiki/JavaScript_best_practices#Avoid_globals
*/

payment_schedule_form_lib = function(){
	function auto_fill(parent, details){
		// auto fill hidden payment schedule form
	}
  return{
	auto_fill: auto_fill
  }
}();