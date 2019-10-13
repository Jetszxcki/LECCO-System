@extends('layouts.app')
@section('title', 'Add Transaction')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-5">
		<div class="card">
			<div class="card-header text-md-center">NEW TRANSACTION</div>
			<div class="card-body">
				<form onsubmit="return checkBalance()" action="{{ route('transactions.store') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="transaction_details" id="transaction_details" value="{{ old('transaction_details') ?? $model->transaction_details_as_json }}"/>
					@include('partials.form', [compact('columns'), 'route' => 'transactions.index', 'buttonText' => 'Add Transaction'])
				</form>	
			</div>
		</div>
	</div>
    <div class="col-md-7 p-0">
		<div id="transaction-details-holder" class="mb-2">
			<div class="card">
				<div class="card-header text-md-center">TRANSACTION DETAILS</div>
				<div id="transaction-details" class="card-body pt-0">
                    <div class="row"><p id="transaction-details-error"></p></div>
                    <table class="container" id="transaction-details-table">
                        <thead>
                            <tr id="theader" class="d-flex p-1 mb-3 text-center">
                                <th class="col-md">Account</th>
                                <th class="col-md">Debit</th>
                                <th class="col-md">Credit</th>
                                <th class="col-md-1"></th>
                            </tr>
                        </thead>
                        <tbody id="transaction-details-table-body">
                            <!-- transaction detail rows will be in here-->
                        </tbody>
                    </table>
                    <hr/>
                    <div class="container">
                        <form onSubmit="return addDetail(this)" action="javascript:void(0);">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="account">Account</label>
                                </div>
                                <div class="col-md-3">
                                    <label for="debit">Debit</label>
                                </div>
                                <div class="col-md-3">
                                    <label for="credit">Credit</label>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <select id="accounts_codes" name="account" class="form-control">
                                        @foreach($accounts as $account)
                                            <option value="{{ $account->id }}">{{ $account->full_account_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input class="form-control" name="debit" type="number"/>
                                </div>
                                <div class="col-md-3">
                                    <input class="form-control" name="credit" type="number"/>
                                </div>
                                <div class="col-md-1">
                                    <input type="submit" class="btn btn-success" value="Add">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
			</div>
		</div>
	</div>
    <script>
        /*  Loads all accounts in blade to javascript variable named "accounts" */
        // must be in here since it $accounts is in blade.php context and can't be accessed by other files types.
        String.prototype.replaceAll = function(search, replacement) {
            var target = this;
            return target.replace(new RegExp(search, 'g'), replacement);
        };
        // do not use double quotation
        var json_string = `{{ json_encode($accounts) }}`;
        json_string = json_string.replaceAll('&quot;', '"');
        var accounts = JSON.parse(json_string);
    </script>
    <script src="{{ asset('/js/transaction_create.js') }}"></script>
</div>
@endsection