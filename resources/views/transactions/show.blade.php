@extends('layouts.app')
@section('title',  "Transaction")

@section('content')
	@include('partials.flash')
	<div class="container col-sm-11">
        <div class="row">
            <div class="col-sm-5">
                <div class="card mb-4">
                    <div class="card-header text-md-center">TRANSACTION</div>
                    <div id="transaction-info" class="card-body">
                        <div class="row">
                            <div class="col-sm-6">Transaction ID: </div>
                            <div class="col-sm-6 font-weight-bold">{{ $transaction->id }}</div>
                            
                            <div class="col-sm-6">Transaction Date: </div>
                            <div class="col-sm-6 font-weight-bold">{{ $transaction->transaction_date }}</div>

                            <div class="col-sm-6">Transaction Code: </div>
                            <div class="col-sm-6 font-weight-bold">{{ $transaction->transaction_code }}</div>
                            
                            <div class="col-sm-6">Transaction Code ID: </div>
                            <div class="col-sm-6 font-weight-bold">{{ $transaction->transaction_code_id }}</div>

                            <div class="col-sm-6">Payee: </div>
                            <div class="col-sm-6 font-weight-bold">{{ $transaction->payee }}</div>

                            <div class="col-sm-6">Date Disbursed:</div>
                            <div class="col-sm-6 font-weight-bold">{{ $transaction->date_disbursed }}</div>

                            <div class="col-sm-6">Disbursed by:</div>
                            <div class="col-sm-6 font-weight-bold">{{ $transaction->disbursed_by }}</div>

                            <div class="col-sm-6">Description:</div>
                            <div class="col-sm-6 font-weight-bold">{{ $transaction->description }}</div>


                            <div class="col-sm-6">Created by: </div>
                            <div class="col-sm-6 font-weight-bold">{{ $transaction->user_created->name }}</div>
                            
                        </div>
                        <div class="d-flex flex-row justify-content-center mt-4">
                            @accessright('transactions_edit')
                                <a href="{{--{{route('loans.edit', [$loan])}}--}}" class="btn btn-warning mr-2">Edit</a>
                            @endaccessright
                            
                            @accessright('transactions_delete')
                                <form action="{{ route('transactions.destroy', [$transaction]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this transaction?')">Delete</button>
                                </form>
                            @endaccessright
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-7">
                <div class="card">
                    <div class="card-header text-md-center">TRANSACTION DETAILS</div>
                    <div id="transaction-details" class="card-body">
                        <div class="table">
                            <div class="row">
                                <div class="col-sm-4">ACCOUNT</div>
                                <div class="col-sm-4">DEBIT</div>
                                <div class="col-sm-4">CREDIT</div>
                            </div>
                            <hr/>
                            @foreach($transaction->transaction_details()->get() as $transaction_detail)
                                <div class="row">
                                    <div class="col-sm-4">{{$transaction_detail->account->account_code}}</div>
                                    <div class="col-sm-4">{{$transaction_detail->debit}}</div>
                                    <div class="col-sm-4">{{$transaction_detail->credit}}</div>
                                </div>
                            @endforeach
                            <hr/>
                            <div class="row">
                                <div class="col-sm-4 font-weight-bold">Total:</div>
                                <div class="col-sm-4 font-weight-bold">{{$transaction->total_debit}}</div>
                                <div class="col-sm-4 font-weight-bold">{{$transaction->total_credit}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
@endsection