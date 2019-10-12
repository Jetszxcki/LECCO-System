/*
- this function is called when transaction detail form is submitted
- Basically adds another detail in hidden field in main transaction form
    - input is text type but value is JSON in string form so it can be parsed into JSON data type then the new transaction_detail is added like a normal Array<Object>.
*/
function addDetail(form){
    // https://www.w3schools.com/cssref/css_selectors.asp
    let account = new Number(form.querySelector('[name=account]').value);
    let debit = form.querySelector('[name=debit]').valueAsNumber;
    let credit = form.querySelector('[name=credit]').valueAsNumber;
    
    let detail_object = new Object();
    detail_object.account_code = account;
    detail_object.debit = debit || 0;
    detail_object.credit = credit || 0;
    
    let transaction_details_field = document.getElementById("transaction_details");
    let transaction_details = JSON.parse(transaction_details_field.value);
    transaction_details.push(detail_object);
    transaction_details_field.value = JSON.stringify(transaction_details);
    renderDetails(transaction_details);
    return false;
}

function deleteDetail(button){
    let index = new Number(button.getAttribute('index'));
    
    let transaction_details_field = document.getElementById("transaction_details");
    let transaction_details = JSON.parse(transaction_details_field.value);
    transaction_details.splice(index, 1);
    transaction_details_field.value = JSON.stringify(transaction_details);
    renderDetails(transaction_details);
}

// details must be in array format
function renderDetails(){
    let transaction_details_field = document.getElementById("transaction_details");
    let transaction_details = JSON.parse(transaction_details_field.value);
    
    let table_body = document.getElementById('transaction-details-table-body');
    table_body.innerHTML = "";
    
    if(transaction_details.length <= 0){
        table_body.innerHTML = '<tr class="p-1 mb-2 text-center"><td class="col-md-12">No Details</td></tr>';
        return;
    }
    
    transaction_details.forEach(function(item, index){
        let row = document.createElement("TR");
        row.setAttribute('class', 'p-1 mb-2 text-center');
        
        let account_cell = document.createElement("TD");
        account_cell.setAttribute('class', 'col-md');
        account_cell.innerHTML = getAccountById(item.account_code).account_code;
        
        let debit_cell = document.createElement("TD");
        debit_cell.setAttribute('class', 'col-md');
        debit_cell.innerHTML = item.debit;
        
        let credit_cell = document.createElement("TD");
        credit_cell.setAttribute('class', 'col-md');
        credit_cell.innerHTML = item.credit;
        
        let delete_cell = document.createElement("TD");
        delete_cell.setAttribute('class', 'col-md-1');
        delete_cell.innerHTML = `<button class="btn btn-danger" index="${index}" onclick="deleteDetail(this)">X</button>`;
        
        row.appendChild(account_cell);
        row.appendChild(debit_cell);
        row.appendChild(credit_cell);
        row.appendChild(delete_cell);
        
        table_body.appendChild(row);
    });
    
    let total_debit = 0;
    let total_credit = 0;
    transaction_details.forEach(function(item, index){
        total_credit = total_credit + item.credit;
        total_debit = total_debit + item.debit;
    });
    let row = document.createElement("TR");
    row.setAttribute('class', 'p-1 mb-2 text-center');
    
    let account_cell = document.createElement("TD");
    account_cell.setAttribute('class', 'col-md');
    account_cell.innerHTML = `Total`;
    
    let debit_cell = document.createElement("TD");
    debit_cell.setAttribute('class', 'col-md');
    debit_cell.innerHTML = total_debit;
    
    let credit_cell = document.createElement("TD");
    credit_cell.setAttribute('class', 'col-md');
    credit_cell.innerHTML = total_credit;
    
    let delete_cell = document.createElement("TD");
    delete_cell.setAttribute('class', 'col-md-1');
    
    row.appendChild(account_cell);
    row.appendChild(debit_cell);
    row.appendChild(credit_cell);
    row.appendChild(delete_cell);
    
    table_body.appendChild(row);
}

function checkBalance(){
    let transaction_details_field = document.getElementById("transaction_details");
    let transaction_details = JSON.parse(transaction_details_field.value);
    
    let total_debit = 0;
    let total_credit = 0;
    transaction_details.forEach(function(item, index){
        total_credit = total_credit + item.credit;
        total_debit = total_debit + item.debit;
    });
    if(total_credit === total_debit){
        transaction_details_error.innerHTML = "";
        return true;
    }else{
        let transaction_details_error = document.getElementById("transaction-details-error");
        transaction_details_error.innerHTML = "Transaction is not balanced!";
        return false;
    }
}

function getAccountById(id){
    let filtered = accounts.filter(function(item){
        return item.id==id;
    });
    if(filtered.length > 0){
        return filtered[0];
    }else{
        return null;
    }
}

$(document).ready(function() {
    let transaction_details_field = document.getElementById("transaction_details");
    console.log(transaction_details_field.value);
    console.log(accounts);
    let transaction_details = JSON.parse(transaction_details_field.value);
    renderDetails(transaction_details);
});