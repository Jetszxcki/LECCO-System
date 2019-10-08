
const form_header_id = '#form-header';
const form_button_id = '#form-btn';
const form_id = '#form-main';
const patcher_id = '#patcher';
const new_account_btn_id = '#new-acct-btn';
const select_parent_btn_name = '[name="select-parent-btn"]';

let CURRENT_VIEW_MODE = 'add';

const form_input_ids = [
	'input#name', 
	'input#description', 
	'input#parent_account', 
	'input#account_code',
];

function toggle(id) {
	$(id).children().animate({ height: 'toggle', opacity: 'toggle' }, 'fast');
}

function changeHeaderName(header) {
    $(form_header_id).html(header);
}

function reverseString(string) {
	return string.split('').reverse().join('');
}

// disable input fields or not
function disableFields(bool) {
	for (id of form_input_ids) {
		if (id !== 'input#parent_account') {
			$(id).prop('disabled', bool);
		}
	}
}

// clear form input fields
function clearInputs() {
	for (id of form_input_ids) {
		$(id).val('');
	}
}

// remove error messages and error borders
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

// change form input values
function setFormValues(account) {
	for (id of form_input_ids) {
		let column_name = id.substring(id.indexOf('#') + 1);
		$(id).val(account[column_name]);
	}
}

 // set parent account field in form via click on button row
function setParentAccount(account) {
    $(form_input_ids[2]).val(account.account_code);
}

// show or hide set parent buttons (blue button)
function hideSetParentButtons(bool, account, hasChildren) {
    const get_parent_btns = {...$(select_parent_btn_name)};

    for (prop in get_parent_btns) {
        let id = get_parent_btns[prop].id;
        if (id !== undefined) {
            if (! hasChildren) {
                $(`#${id}`).css('visibility', bool ? 'hidden' : 'visible');

                if (CURRENT_VIEW_MODE === 'edit') {
                    let code = id.replace('select-parent-btn-', '');
                    if (account.account_code === code) {
                        $(`#${id}`).css('visibility', 'hidden');
                    }
                }
            } else {
                $(`#${id}`).css('visibility', 'hidden');
            }
        }
    }
}

// change form contents according to view mode
function viewMode(view_mode, account = null, hasChildren = false) {
    CURRENT_VIEW_MODE = view_mode;

    const addMode = view_mode === 'add';
    const showMode = view_mode === 'show';
    const editMode = view_mode === 'edit';
    const account_name = account ? `${account.account_code} (${account.name})` : '';

    if (addMode) {
        $(form_button_id).html('Add Account');
        changeHeaderName('NEW ACCOUNT');
        setDefaultRoute();
        clearInputs();  
    } else if (showMode) {
        changeHeaderName(`VIEW - ${account_name}`);
        setDefaultRoute();
    } else if (editMode) {
        $(form_button_id).html('Save Changes');
        changeHeaderName(`EDIT - ${account_name}`);
        setUpdateRoute(account);
    }

    $(new_account_btn_id).css('visibility', addMode ? 'hidden' : 'visible');
    $(form_button_id).css('visibility', showMode ? 'hidden' : 'visible');

    hideSetParentButtons(showMode, editMode ? account : null, hasChildren);
    disableFields(showMode);
    clearErrorNotifs();
    if (account) setFormValues(account);
}

// manual change of route to accounts.index
function setDefaultRoute() {
	let action = $(form_id).attr('action');

	if (action.endsWith('/')) {
    	action = action.substring(0, action.lastIndexOf('/'));
    	action = reverseString(action);
    	action = action.substring(action.indexOf('/') + 1);
    	action = reverseString(action);
    	$(form_id).attr('action', action);
    }

    $(patcher_id).remove();
}

// manual change of route to accounts.update
function setUpdateRoute(account) {
    let action = $(form_id).attr('action');

    if (! action.endsWith('/')) {
    	$(form_id).attr('action', action + '/');
    } else {
    	action = action.substring(0, action.lastIndexOf('/') - 1);
    	$(form_id).attr('action', action);
    }

    // converts the form to an "update form"
    let route = `${$(form_id).attr('action')}${account.id}/`;
    // created a removable @method('PATCH') since @method('PATCH') cannot be removed once called
    let patcher_input = '<input id="patcher" type="hidden" name="_method" value="PATCH">';

    $(form_id).attr('action', route);
    $(patcher_id).remove();
    $(form_id).append(patcher_input);
}
