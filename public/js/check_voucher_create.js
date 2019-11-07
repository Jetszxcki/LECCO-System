var new_transaction_flag = null;
var new_transaction_form = null;
var new_transaction_details_form = null;
var transaction_id_field = null;

function check_new_transaction_flag(){
    let is_checked = new_transaction_flag.checked;
    new_transaction_form.style.display = is_checked ? "":"none";
    new_transaction_details_form.style.display = is_checked ? "":"none";
    transaction_id_field.style.display = is_checked ? "none":"";
    
    return !is_checked;
}

window.addEventListener('load', function() {
    new_transaction_flag = document.getElementById("new-transaction-flag");
    new_transaction_form = document.getElementById("new-transaction-form");
    new_transaction_details_form = document.getElementById("new-transaction-details-form");
    transaction_id_field = document.getElementById("transaction_id").parentElement.parentElement;
    console.log(transaction_id_field);
    new_transaction_flag.addEventListener("change", check_new_transaction_flag);
    check_new_transaction_flag();
});