function update_loan_detail(){
	var loan_details = document.getElementById("loan-details");
	
	var amount_field = document.getElementById("amount");
	var term_field = document.getElementById("term");
	var interest_per_annum_field = document.getElementById("interest_per_annum");
	var start_of_payment_field = document.getElementById("start_of_payment");
	if( !(amount_field && term_field && interest_per_annum_field && start_of_payment_field) ){
		loan_details.innerHTML = "Cannot find all fields necessary..";
		return;
	}
	loan_details.innerHTML = "Changes detected";
}


$(document).ready(function() {
	var loan_details = document.getElementById("loan-details");
	
	var amount_field = document.getElementById("amount");
	var term_field = document.getElementById("term");
	var interest_per_annum_field = document.getElementById("interest_per_annum");
	var start_of_payment_field = document.getElementById("start_of_payment");
	
	amount_field.addEventListener("keydown", update_loan_detail );
	term_field.addEventListener("keydown", update_loan_detail );
	interest_per_annum_field.addEventListener("keydown", update_loan_detail );
	start_of_payment_field.addEventListener("change", update_loan_detail );
	
	if( !(amount_field && term_field && interest_per_annum_field && start_of_payment_field) ){
		loan_details.innerHTML = "Cannot find all fields necessary..";
		return;
	}
});