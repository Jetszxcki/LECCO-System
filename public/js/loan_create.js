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
	var payment_schedule_hidden_div = document.getElementById("payment-schedule-hidden-form");

	// Just checking if div exists
	if(!(loan_details_div && payment_schedule_hidden_div)){
		alert('Cannot find element to render loan details!');
		return;
	}
	
	var amount_field = document.getElementById("amount");
	var term_field = document.getElementById("term");
	var interest_per_annum_field = document.getElementById("interest_per_annum");
	var start_of_payment_field = document.getElementById("start_of_payment");
	var payrolls_field = document.getElementById("payrolls");

	var loan_details_holder = document.getElementById("loan-details-holder");
	var loan_form_holder = document.getElementById("loan-form");

	// Just checking if all fields needed exists
	if(amount_field.value && term_field.value && interest_per_annum_field.value && start_of_payment_field.value && payrolls_field.value){
		// loan_details_div.innerHTML = "Cannot find all fields necessary..";
		loan_form_holder.classList.remove("col-md-8");
		loan_form_holder.classList.add("col-md-6");
		loan_details_holder.style.display = "";
	} else {
		loan_form_holder.classList.remove("col-md-6");
		loan_form_holder.classList.add("col-md-8");
		loan_details_holder.style.display = "none";
		return;
	}
	
	loan_details_div.innerHTML = "";
	
	//Compile base loan details to object
	var details = new Object();
	details.amount = parseFloat(amount_field.value);
	details.term = parseInt(term_field.value);
	details.ipa = parseFloat(interest_per_annum_field.value);
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
	details.total_payable = parseFloat(details.total_interest)+parseFloat(details.amount);
	details.monthly_payment = details.total_payable/details.term;
	
	details.payment_schedule = loan_utils.calculate_payment_schedule(details);

	//rendering starts here

	loan_details_header(loan_details_div, details);
	loan_payments_table(loan_details_div, details);
	fill_hidden_form(payment_schedule_hidden_div, details);
}


function loan_details_header(parent, details){
	var header_div = document.createElement("DIV");
	// var title_elem = document.createElement("H4");
	
	var amount_elem = document.createElement("P");
	var term_elem = document.createElement("P");
	var total_interest_elem = document.createElement("P");
	var total_payable_elem = document.createElement("P");
	var monthly_payment_elem = document.createElement("P");
	var ipa_elem = document.createElement("P");
	var sop_elem = document.createElement("P");
	var payrolls_elem = document.createElement("P");
	
	
	// title_elem.innerHTML = "Loan Details";
	amount_elem.innerHTML = "Amount: " + details.amount;
	term_elem.innerHTML = "Term: " + details.term;
	ipa_elem.innerHTML = "Interest per Annum: " + render_utils.as_percentage(details.ipa);
	total_interest_elem.innerHTML = "Total Interest: " + render_utils.numberWithCommas(loan_utils.round_to_percentile(details.total_interest));
	total_payable_elem.innerHTML = "Total Payable: " + render_utils.numberWithCommas(loan_utils.round_to_percentile(details.total_payable));
	monthly_payment_elem.innerHTML = "Monthly Payment: " + render_utils.numberWithCommas(loan_utils.round_to_percentile(details.monthly_payment));
	sop_elem.innerHTML = "Start of Payment: " + details.sop;
	payrolls_elem.innerHTML = "Payrolls: " + Object.values(details.payrolls);
	
	
	parent.appendChild(header_div);
	// header_div.appendChild(title_elem);
	
	header_div.appendChild(amount_elem);
	header_div.appendChild(term_elem);
	header_div.appendChild(ipa_elem);
	header_div.appendChild(total_interest_elem);
	header_div.appendChild(total_payable_elem);
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
	for(var j = 0; j < payrolls.length; j++){
		var payroll_div = document.createElement("DIV");
		var payroll_header = document.createElement("H6");
		var payroll_table = document.createElement("DIV");
		payroll_table.setAttribute('class', 'container');
		
		payroll_header.innerHTML = `${payrolls[j]}`;
		payroll_div.setAttribute("id", `${payrolls[j]}-schedule`);
		
		for(var i = 0; i < term; i++){
			var row = document.createElement("DIV");
			row.setAttribute('class', 'row');
			
			var payment_num = document.createElement("DIV");
			payment_num.setAttribute('class', 'col-sm-1');
			
			var expected_payment_date = document.createElement("DIV");
			expected_payment_date.setAttribute('class', 'col-sm');
			
			var total_payment = document.createElement("DIV");
			total_payment.setAttribute('class', 'col-sm');
			
			var interest = document.createElement("DIV");
			interest.setAttribute('class', 'col-sm');
			
			var principal_payment = document.createElement("DIV");
			principal_payment.setAttribute('class', 'col-sm');
			
			var remaining_principal = document.createElement("DIV");
			remaining_principal.setAttribute('class', 'col-sm');
			
			var payroll_payment = details.payment_schedule[i][j];
			
			payment_num.innerHTML = `${(i+1)}`;
			expected_payment_date.innerHTML = `${render_utils.formatDate(payroll_payment.expected_payment_date)}`;
			total_payment.innerHTML = `${render_utils.numberWithCommas(loan_utils.round_to_percentile(payroll_payment.total_payment))}`;
			interest.innerHTML = `${render_utils.numberWithCommas(loan_utils.round_to_percentile(payroll_payment.interest))}`;
			principal_payment.innerHTML = `${render_utils.numberWithCommas(loan_utils.round_to_percentile(payroll_payment.principal_payment))}`;
			remaining_principal.innerHTML = `${render_utils.numberWithCommas(loan_utils.round_to_percentile(payroll_payment.remaining_principal))}`;
			
			row.appendChild(payment_num);
			row.appendChild(expected_payment_date);
			row.appendChild(total_payment);
			row.appendChild(interest);
			row.appendChild(principal_payment);
			row.appendChild(remaining_principal);
			
			payroll_table.appendChild(row);
		}
		
		table_div.appendChild(payroll_div);
		payroll_div.appendChild(payroll_header);
		payroll_div.appendChild(payroll_table);
		table_div.innerHTML = table_div.innerHTML+ "<hr>";
	}
	
	loan_payments_div.appendChild(title_elem);
	loan_payments_div.appendChild(table_div);
	
	parent.appendChild(loan_payments_div);
}

function check_field_values(...fields) {

}

function fill_hidden_form(parent, details){
	// auto fill hidden payment schedule form
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
	
	// if( !(amount_field.value && term_field.value && interest_per_annum_field.value && start_of_payment_field.value) ){
	// 	loan_details.innerHTML = "Cannot find all fields necessary..";
	// 	return;
	// }
	include_utils();
});