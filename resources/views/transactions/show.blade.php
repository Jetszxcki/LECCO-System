@extends('layouts.app')
@section('title',  "Transaction")

@section('content')
	@include('partials.flash')
	<div class="container col-sm-11">
        <div class="row">
            <div class="col-sm-5">
                <div class="card mb-4">
                    <div class="card-header text-md-center">Transaction</div>
                    <div id="transaction-info" class="card-body">
                        <div class="row">
                            <div class="col-sm-6">Transaction ID: </div>
                            <div class="col-sm-6 font-weight-bold">{{ $transaction->id }}</div>
                            
                            <div class="col-sm-6">Transaction Code: </div>
                            <div class="col-sm-6 font-weight-bold">{{ $transaction->transaction_code }}</div>
                            
                            <div class="col-sm-6">Transaction Code ID: </div>
                            <div class="col-sm-6 font-weight-bold">{{ $transaction->transaction_code_id }}</div>
                            
                            <div class="col-sm-6">Created by: </div>
                            <div class="col-sm-6 font-weight-bold">{{ $transaction->user_created->name }}</div>
                            
                        </div>
                        <div class="d-flex flex-row justify-content-center">
                            @accessright('transactions_edit')
                                <a href="{{--{{route('loans.edit', [$loan])}}--}}" class="btn btn-warning mr-2">Edit</a>
                            @endaccessright
                            
                            @accessright('transactions_delete')
                                <form action="{{ route('transactions.destroy', [$transaction]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endaccessright
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-7">
                <div class="card">
                    <div class="card-header text-md-center">Transaction Details</div>
                    <div id="transaction-details" class="card-body">
                        <div class="table">
                            <div class="row">
                                <div class="col-sm">Account</div>
                                <div class="col-sm">Debit</div>
                                <div class="col-sm">Credit</div>
                            </div>
                            <hr/>
                            @foreach($transaction->transaction_details()->get() as $transaction_detail)
                                <div class="row">
                                    <div class="col-sm">{{$transaction_detail->account->account_code}}</div>
                                    <div class="col-sm">{{$transaction_detail->debit}}</div>
                                    <div class="col-sm">{{$transaction_detail->credit}}</div>
                                </div>
                            @endforeach
                            <hr/>
                            <div class="row">
                                <div class="col-sm">Total:</div>
                                <div class="col-sm">{{$transaction->total_debit}}</div>
                                <div class="col-sm">{{$transaction->total_credit}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
@endsection