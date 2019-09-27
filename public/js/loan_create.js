/* 
	This code is still shit. need to refactor if may time.
	References:
		createElement : https://www.w3schools.com/jsref/met_document_createelement.asp
		import javascript file : https://tutorials.technology/tutorials/How-to-include-a-JavaScript-file-in-another-JavaScript-file.html
*/

//import utils 
function include_utils(){
	var x = document.createElement('script');
	x.src = '/js/loan_util.js';
	document.getElementsByTagName("head")[0].appendChild(x);
}


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
	var payrolls_field = document.getElementById("payrolls");
	
	// Just checking if all fields needed exists
	if( !(amount_field && term_field && interest_per_annum_field && start_of_payment_field && payrolls_field) ){
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
	details.payrolls = ($('#'+payrolls_field.id).val()+"").split(",");
	var buffer = {};
	for(var i = 0; i < details.payrolls.length; i++){
		var option_field = payrolls_field.querySelector('option[value="'+details.payrolls[i]+'"]');
		if(option_field){
			buffer[details.payrolls[i]] = option_field.innerHTML;
		}
	}
	details.payrolls = buffer;
	
	details.total_interest = loan_utils.get_total_interest(amount = details.amount, ipa = details.ipa, term = details.term)
	details.monthly_payment = details.total_interest/details.term;
	
	details.payment_schedule = loan_utils.calculate_payment_schedule(details);
	
	//rendering starts here
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
	var payrolls_elem = document.createElement("P");
	
	
	title_elem.innerHTML = "Loan Details";
	amount_elem.innerHTML = "Amount: " + details.amount;
	term_elem.innerHTML = "Term: " + details.term;
	ipa_elem.innerHTML = "Interest per Annum: " + render_utils.as_percentage(details.ipa);
	total_interest_elem.innerHTML = "Total Interest: " + details.total_interest;
	monthly_payment_elem.innerHTML = "Monthly Payment: " + details.monthly_payment;
	sop_elem.innerHTML = "Start of Payment: " + details.sop;
	payrolls_elem.innerHTML = "Payrolls: " + Object.values(details.payrolls);
	
	
	parent.appendChild(header_div);
	header_div.appendChild(title_elem);
	
	header_div.appendChild(amount_elem);
	header_div.appendChild(term_elem);
	header_div.appendChild(ipa_elem);
	header_div.appendChild(total_interest_elem);
	header_div.appendChild(monthly_payment_elem);
	header_div.appendChild(sop_elem);
	header_div.appendChild(payrolls_elem);
	
}

function loan_payments_table(parent, details){
	var loan_payments_div = document.createElement("DIV");
	var title_elem = document.createElement("H4");
	var table_div = document.createElement("DIV");
	title_elem.innerHTML = "Loan Schedule";
	
	var term = details.term;
	var payrolls = Object.values(details.payrolls);
	for(j = 0; j < payrolls.length; j++){
		var payroll_div = document.createElement("DIV");
		var payroll_header = document.createElement("H4");
		var payroll_table = document.createElement("TABLE");
		
		payroll_header.innerHTML = `${payrolls[j]}`;
		payroll_div.setAttribute("id", `${payrolls[j]}-schedule`);
		
		for(i = 0; i <= term; i++){
			var row = document.createElement("TR");
			var payment_num = document.createElement("TD");
			var expected_payment_date = document.createElement("TD");
			var total_payment = document.createElement("TD");
			var interest = document.createElement("TD");
			var principal_payment = document.createElement("TD");
			var remaining_principal = document.createElement("TD");
			
			var payroll_payment1 = details.payment_schedule[i];
			var payroll_payment = payroll_payment1[j];
			
			payment_num.innerHTML = `${term+1}`;
			expected_payment_date.innerHTML = `${payroll_payment.expected_payment_date}`;
			total_payment.innerHTML = `${payroll_payment.total_payment}`;
			interest.innerHTML = `${payroll_payment.interest}`;
			principal_payment.innerHTML = `${payroll_payment.principal_payment}`;
			remaining_principal.innerHTML = `${payroll_payment.remaining_principal}`;
			
			payroll_table.appendChild(row);
			
			row.appendChild(payment_num);
			row.appendChild(expected_payment_date);
			row.appendChild(total_payment);
			row.appendChild(principal_payment);
			row.appendChild(remaining_principal);
			
		}
		
		table_div.appendChild(payroll_div);
		payroll_div.appendChild(payroll_header);
		payroll_div.appendChild(payroll_table);
		table_div.innerHTML = table_div.innerHTML+ "<hr>";
	}
	
	parent.appendChild(loan_payments_div);
	loan_payments_div.appendChild(title_elem);
	loan_payments_div.appendChild(table_div);
}

//add event listeners to specific form inputs
$(document).ready(function() {
	var loan_details = document.getElementById("loan-details");
	
	var amount_field = document.getElementById("amount");
	var term_field = document.getElementById("term");
	var interest_per_annum_field = document.getElementById("interest_per_annum");
	var start_of_payment_field = document.getElementById("start_of_payment");
	var payrolls_field = document.getElementById("payrolls");
	
	amount_field.addEventListener("keyup", update_loan_detail );
	term_field.addEventListener("keyup", update_loan_detail );
	interest_per_annum_field.addEventListener("keyup", update_loan_detail );
	start_of_payment_field.addEventListener("change", update_loan_detail );
	payrolls_field.addEventListener("change", update_loan_detail );
	
	if( !(amount_field && term_field && interest_per_annum_field && start_of_payment_field) ){
		loan_details.innerHTML = "Cannot find all fields necessary..";
		return;
	}
	include_utils();
});