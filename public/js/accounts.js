
const form_header_id = '#form-header';
const form_button_id = '#form-btn';
const form_id = '#form-main';
const patcher_id = '#patcher';
const new_account_btn = '#new-acct-btn';

const form_input_ids = [
	'input#name', 
	'input#description', 
	'input#parent_account', 
	'input#account_code',
];

function toggle(id) {
	$(id).children().animate({ height: 'toggle', opacity: 'toggle' }, 'fast');
}

function reverseString(string) {
	return string.split('').reverse().join('');
}

function disableFields(bool) {
	for (id of form_input_ids) {
		if (id !== 'input#parent_account') {
			$(id).prop('disabled', bool);
		}
	}
}

function clearInputs() {
	for (id of form_input_ids) {
		$(id).val('');
	}
}

function cleanForm() {
	$(form_header_id).html('NEW ACCOUNT');
	$(form_button_id).show();

	disableFields(false);
	clearErrorNotifs();
	clearInputs();	
}

function clearErrorNotifs() {
	for (id of form_input_ids) {
		let span_id = id.replace('input', 'span');
		span_id = span_id.replace('#', '#err-');

		if ($(span_id).html() !== undefined) {
			$(span_id).html('');
		}

		$(id).css('border-color', 'rgb(206, 212, 218)');
	}
}

function setFormValues(account) {
	for (id of form_input_ids) {
		let column_name = id.substring(id.indexOf('#') + 1);
		$(id).val(account[column_name]);
	}
}

 // function triggered when add account button (row) is clicked
function setParentAccount(account) {
    const header_text = $(form_header_id).html();
    const parent_account_input_text = $(form_input_ids[2]).val();

    // if view mode is currently SHOW
    if (header_text.includes('VIEW')) {
    	cleanForm();
    }
   	// enable change of parent_account only when edit and create mode
    else  {
    	// disables the ADD ACCOUNT "row" button when editing an account with no parent
    	if (header_text.includes('EDIT') && parent_account_input_text === 'none') {
    		return;
    	}
    }

   	// change parent_account input value in form
    $(form_input_ids[2]).val(account.account_code);
}

function viewMode(view_mode, account) {
    if (view_mode === 'show') {
        $(form_header_id).html(`VIEW - ${account.account_code} (${account.name})`);
        $(form_button_id).hide();

        processCreateRoute();
        
    } else if (view_mode === 'edit') {
        $(form_header_id).html(`EDIT - ${account.account_code} (${account.name})`);
        $(form_button_id).html('Save Changes');
        $(form_button_id).show();

        processUpdateRoute(account);
    }

    $(new_account_btn).show();
    disableFields(view_mode === 'show');
    clearErrorNotifs();
    setFormValues(account);
}

function processCreateRoute() {
	let action = $(form_id).attr('action');

	if (action.endsWith('/')) {
    	action = action.substring(0, action.lastIndexOf('/'));
    	action = reverseString(action);
    	action = action.substring(action.indexOf('/') + 1);
    	action = reverseString(action);
    	$(form_id).attr('action', action);
    }
}

function processUpdateRoute(account) {
    let action = $(form_id).attr('action');

    if (! action.endsWith('/')) {
    	$(form_id).attr('action', action + '/');
    } else {
    	action = action.substring(0, action.lastIndexOf('/') - 1);
    	$(form_id).attr('action', action);
    }

    // converts the form to an "update form"
    let route = `${$(form_id).attr('action')}${account.id}/`;
    // // created a removable @method('PATCH') since @method('PATCH') cannot be removed once called
    let patcher_input = '<input id="patcher" type="hidden" name="_method" value="PATCH">';

    $(form_id).attr('action', route);
    $(form_id).append(patcher_input);
}

