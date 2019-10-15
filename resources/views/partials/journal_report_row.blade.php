@if(!$account->getDetailsAreEmpty())
    <div class="row border-bottom border-dark">
        @if($level == 1)
            <div class="col-md-2"> {{ $account->account_code }} </div>
            <div class="col-md-2"></div>
            <div class="col-md-1">{{ $account->getDetailsReport($query_params['journal'], $query_params['start_date'], $query_params['end_date'])['total']['debit'] }} </div>
            <div class="col-md-1"> {{ $account->getDetailsReport($query_params['journal'], $query_params['start_date'], $query_params['end_date'])['total']['credit'] }} </div>
            <div class="col-md-1"></div>
            <div class="col-md-1"></div>
            <div class="col-md-1"></div>
            <div class="col-md-1"></div>
        @elseif($level == 2)
            <div class="col-md-1"></div>
            <div class="col-md-2"> {{ $account->account_code }} </div>
            <div class="col-md-1"></div>
            <div class="col-md-1"></div>
            <div class="col-md-1"></div>
            <div class="col-md-1"> {{ $account->getDetailsReport($query_params['journal'], $query_params['start_date'], $query_params['end_date'])['total']['credit'] }} </div>
            <div class="col-md-1"> {{ $account->getDetailsReport($query_params['journal'], $query_params['start_date'], $query_params['end_date'])['total']['debit'] }} </div>
            <div class="col-md-1"></div>
            <div class="col-md-1"></div>
        @elseif($level == 3)
            <div class="col-md-2"></div>
            <div class="col-md-2"> {{ $account->account_code }} </div>
            <div class="col-md-1"></div>
            <div class="col-md-1"></div>
            <div class="col-md-1"></div>
            <div class="col-md-1"></div>
            <div class="col-md-1"> {{ $account->getDetailsReport($query_params['journal'], $query_params['start_date'], $query_params['end_date'])['total']['credit'] }} </div>
            <div class="col-md-1"> {{ $account->getDetailsReport($query_params['journal'], $query_params['start_date'], $query_params['end_date'])['total']['debit'] }} </div>
        @endif
    </div>
@endif