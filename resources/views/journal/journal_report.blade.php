@extends('layouts.app')
@section('title', 'General Ledger')

<!-- 
    getDetailsReport() =
    [
        'total' => ['debit': 0, 'credit': 0],    = account->getDetailsReport()['main'] + account->getDetailsReport()['children']
        'main' => ['debit': 0, 'credit': 0],     = sum(account->transaction_details)
        'children' => ['debit': 0, 'credit': 0]  = sum(account->child->getDetailsReport()['total'])
    ]
-->

@section('content')
<div class="container">
    <!-- Todo: might change this to form partials -->
    <form action="/summary/transactions" method="GET">
        <div class="row">
            <label class="col-md-1">
                CV
                <input type="checkbox" class="form-control" name="journal[]" value="CV" {{ in_array("CV", $query_params['journal'])?"checked" : "" }}/>
            </label>
            <label class="col-md-1">
                JV
                <input type="checkbox" class="form-control" name="journal[]" value="JV" {{ in_array("JV", $query_params['journal'])?"checked" : "" }}/>
            </label>
            <label class="col-md-1">
                APV
                <input type="checkbox" class="form-control" name="journal[]" value="APV" {{ in_array("APV", $query_params['journal'])?"checked" : "" }}/>
            </label>
            <label class="col-md-3" for="start_date">
                Start Date
                <input type="date" class="form-control" name="start_date" value="{{$query_params['start_date']}}"/>
            </label>
            <label class="col-md-3" for="end_date">
                End Date
                <input type="date" class="form-control" name="end_date" value="{{$query_params['end_date']}}"/>
            </label>
            <div class="col-md-1 align-self-center">
                <input type="submit" value="Search" class="btn btn-primary"/>
            </div>
        </div>
    </form>
</div>
<div class="card" align="center">
    <div class="row card-header">
        <div class="container" align="left">
            <h5>General Ledger</h5>
            <h6>{{ date('F d, Y', strtotime($query_params['start_date'])) }} - {{ date('F d, Y', strtotime($query_params['end_date'])) }}</h6>
            <h6>
                @foreach($query_params['journal'] as $journal)
                    <span class="badge badge-light">{{ $journal }}</span>
                @endforeach
            </h6>
        </div>
    </div>
    <div class="card-body row">

        <div class="container border border-dark">
        <div class="row border-bottom border-dark">
            <div class="col-md-4"> Account </div>
            <div class="col-md-1"> Debit </div>
            <div class="col-md-1"> Credit </div>
            <div class="col-md-1"> Debit </div>
            <div class="col-md-1"> Credit </div>
            <div class="col-md-1"> Debit </div>
            <div class="col-md-1"> Credit </div>
        </div>
            @include('partials.journal_report_row', ['account' => $main, 'level' => 1, 'query_params' => $query_params])
            
            @if($main->hasChildren() && !$main->getChildrenDetailsAreEmpty($query_params['journal'], $query_params['start_date'], $query_params['end_date']) )
                @foreach($main->children as $children)
                    @include('partials.journal_report_row', ['account' => $children, 'level' => 2, 'query_params' => $query_params])
                    
                    @if($children->hasChildren() && !$children->getChildrenDetailsAreEmpty($query_params['journal'], $query_params['start_date'], $query_params['end_date']))
                        @foreach($children->children as $grand_children)
                            @include('partials.journal_report_row', ['account' => $grand_children, 'level' => 3, 'query_params' => $query_params])
                        @endforeach
                    @endif
                    
                @endforeach
            @endif
            
            <div class="row border-bottom border-dark">
                <div class="col-md-4"> Total </div>
                <div class="col-md-1"> {{ $main->getDetailsReport($query_params['journal'], $query_params['start_date'], $query_params['end_date'])['total']['debit'] }} </div>
                <div class="col-md-1"> {{ $main->getDetailsReport($query_params['journal'], $query_params['start_date'], $query_params['end_date'])['total']['credit'] }} </div>
                <div class="col-md-1"></div>
                <div class="col-md-1"></div>
                <div class="col-md-1"></div>
                <div class="col-md-1"></div>
            </div>
        </div>

    </div>
</div>
@endsection