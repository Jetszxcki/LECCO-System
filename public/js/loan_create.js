/* 
	References:
		createElement : https://www.w3schools.com/jsref/met_document_createelement.asp
		import javascript file : https://tutorials.technology/tutorials/How-to-include-a-JavaScript-file-in-another-JavaScript-file.html
*/

//import utils 
var x = document.createElement('script');
x.src = '/js/loan_util.js';
document.getElementsByTagName("head")[0].appendChild(x);

//this is main execution for changes in form
function update_loan_detail(){
	var loan_details_div = document.getElementById("loan-details");
	// Just checking if div exists
	if(!loan_details_div){
		alert('Cannot find element to render loan details!');
		return;
	}
	
	var amount_field = document.getElementById("amount");
	var term_field = document.getElementById("term");
	var interest_per_annum_field = document.getElementById("interest_per_annum");
	var start_of_payment_field = document.getElementById("start_of_payment");
	
	// Just checking if all fields needed exists
	if( !(amount_field && term_field && interest_per_annum_field && start_of_payment_field) ){
		loan_details_div.innerHTML = "Cannot find all fields necessary..";
		return;
	}
	
	loan_details_div.innerHTML = "";
	
	//Compile base loan details to object
	var details = new Object();
	details.amount = amount_field.value;
	details.term = term_field.value;
	details.ipa = interest_per_annum_field.value;
	details.sop = start_of_payment_field.value;
	details.total_interest = loan_utils.get_total_interest(amount = details.amount, ipa = details.ipa, term = details.term)
	details.monthly_payment = details.total_interest/term;
	
	
	loan_details_header(loan_details_div, details);
	loan_payments_table(loan_details_div, details);
}


function loan_details_header(parent, details){
	var header_div = document.createElement("DIV");
	
	var title_elem = document.createElement("H4");
	
	var amount_elem = document.createElement("P");
	var term_elem = document.createElement("P");
	var total_interest_elem = document.createElement("P");
	var monthly_payment_elem = document.createElement("P");
	var ipa_elem = document.createElement("P");
	var sop_elem = document.createElement("P");
	
	
	title_elem.innerHTML = "Loan Details";
	amount_elem.innerHTML = "Amount: " + details.amount;
	term_elem.innerHTML = "Term: " + details.term;
	ipa_elem.innerHTML = "Interest per Annum: " + render_utils.as_percentage(details.ipa);
	total_interest_elem.innerHTML = "Total Interest: " + details.total_interest;
	monthly_payment_elem.innerHTML = "Monthly Payment: " + details.monthly_payment;
	sop_elem.innerHTML = "Start of Payment: " + details.sop;
	
	
	parent.appendChild(header_div);
	
	header_div.appendChild(title_elem);
	header_div.appendChild(amount_elem);
	header_div.appendChild(term_elem);
	header_div.appendChild(ipa_elem);
	header_div.appendChild(total_interest_elem);
	header_div.appendChild(monthly_payment_elem);
	header_div.appendChild(sop_elem);
	
}

function loan_payments_table(parent, details){
	var loan_payments_div = document.createElement("DIV");
	
	var title_elem = document.createElement("H4");
	title_elem.innerHTML = "Loan Schedule";
	
	parent.appendChild(loan_payments_div);
	
	loan_payments_div.appendChild(title_elem);
}

//add event listeners to specific form inputs
$(document).ready(function() {
	var loan_details = document.getElementById("loan-details");
	
	var amount_field = document.getElementById("amount");
	var term_field = document.getElementById("term");
	var interest_per_annum_field = document.getElementById("interest_per_annum");
	var start_of_payment_field = document.getElementById("start_of_payment");
	
	amount_field.addEventListener("keyup", update_loan_detail );
	term_field.addEventListener("keyup", update_loan_detail );
	interest_per_annum_field.addEventListener("keyup", update_loan_detail );
	start_of_payment_field.addEventListener("change", update_loan_detail );
	
	if( !(amount_field && term_field && interest_per_annum_field && start_of_payment_field) ){
		loan_details.innerHTML = "Cannot find all fields necessary..";
		return;
	}
});