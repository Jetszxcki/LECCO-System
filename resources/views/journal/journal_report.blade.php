@extends('layouts.app')
@section('title', 'Summary of accounts')

<!-- 
    getDetailsReport() =
    [
        'total' => ['debit': 0, 'credit': 0],    = account->getDetailsReport()['main'] + account->getDetailsReport()['children']
        'main' => ['debit': 0, 'credit': 0],     = sum(account->transaction_details)
        'children' => ['debit': 0, 'credit': 0]  = sum(account->child->getDetailsReport()['total'])
    ]
-->

@section('content')
<div class="card" align="center">
    <div class="row card-header">
        <div class="col-md-4"> Account </div>
        <div class="col-md-1"> Debit </div>
        <div class="col-md-1"> Credit </div>
        <div class="col-md-1"> Debit </div>
        <div class="col-md-1"> Credit </div>
        <div class="col-md-1"> Debit </div>
        <div class="col-md-1"> Credit </div>
    </div>
    <div class="card-body row">

        <div class="container border border-dark">
            <div class="row border-bottom border-dark">
                <div class="col-md-2"> {{ $main->account_code }} </div>
                <div class="col-md-2"></div>
                <div class="col-md-1"> {{ $main->getDetailsReport()['total']['debit'] }} </div>
                <div class="col-md-1"> {{ $main->getDetailsReport()['total']['credit'] }} </div>
                <div class="col-md-1"></div>
                <div class="col-md-1"></div>
                <div class="col-md-1"></div>
                <div class="col-md-1"></div>
            </div>
            
            @if($main->hasChildren())
                @foreach($main->children as $children)
                    <div class="row border-bottom border-dark">
                        <div class="col-md-1"></div>
                        <div class="col-md-2"> {{ $children->account_code }} </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-1"></div>
                        <div class="col-md-1"></div>
                        <div class="col-md-1"> {{ $children->getDetailsReport()['total']['credit'] }} </div>
                        <div class="col-md-1"> {{ $children->getDetailsReport()['total']['debit'] }} </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-1"></div>
                    </div>
                    
                    @if($children->hasChildren())
                        @foreach($children->children as $grand_children)
                            <div class="row border-bottom border-dark">
                                <div class="col-md-2"></div>
                                <div class="col-md-2"> {{ $grand_children->account_code }} </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-1"></div>
                                <div class="col-md-1"></div>
                                <div class="col-md-1"></div>
                                <div class="col-md-1"> {{ $grand_children->getDetailsReport()['total']['credit'] }} </div>
                                <div class="col-md-1"> {{ $grand_children->getDetailsReport()['total']['debit'] }} </div>
                            </div>
                        @endforeach
                    @endif
                    
                @endforeach
            @endif
            
            <div class="row border-bottom border-dark">
                <div class="col-md-4"> Total </div>
                <div class="col-md-1"> {{ $main->getDetailsReport()['total']['debit'] }} </div>
                <div class="col-md-1"> {{ $main->getDetailsReport()['total']['credit'] }} </div>
                <div class="col-md-1"></div>
                <div class="col-md-1"></div>
                <div class="col-md-1"></div>
                <div class="col-md-1"></div>
            </div>
        </div>

    </div>
</div>
@endsection