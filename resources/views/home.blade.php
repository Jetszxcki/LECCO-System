@extends('layouts.app')
@section('title', 'LECCO - Home')

@section('content')

    @if (session('status'))
        <div id="flash-msg" class="alert alert-success text-center ls-2 mx-3" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="d-flex flex-wrap">

        @accessright('user_view_list')
            @include('partials.home_panel', ['header' => 'USERS', 'href' => 'users.index', 'image' => 'user_btn_img.jpg'])
        @endaccessright

        @accessright('member_view_list')
            @include('partials.home_panel', ['header' => 'MEMBERS', 'href' => 'members.index', 'image' => 'member_btn_img.jpg'])
        @endaccessright

        @accessright('loans_view_list')
            @include('partials.home_panel', ['header' => 'LOANS', 'href' => 'loans.index', 'image' => 'loan_btn_img.jpg'])
        @endaccessright

        @accessright('loan_types_view_list')
            @include('partials.home_panel', ['header' => 'LOAN TYPES', 'href' => 'loan_types.index', 'image' => 'loan_types_btn_img.jpg'])
        @endaccessright

        @hasAccessRights(['chart_of_accounts_view_list', 'chart_of_accounts_create'])
        @include('partials.home_panel', ['header' => 'CHART OF ACCOUNTS', 'href' => 'accounts.index', 'image' => 'user.jpg'])
        @endhasAccessRights

        @accessright('check_vouchers_view_list')
            @include('partials.home_panel', ['header' => 'CHECK VOUCHERS', 'href' => 'check_vouchers.index', 'image' => 'user.jpg'])
        @endaccessright

        @accessright('transactions_view_list')
        @include('partials.home_panel', ['header' => 'TRANSACTIONS', 'href' => 'transactions.index', 'image' => 'user.jpg'])
        @endaccessright

        @accessright('shares_view_list')
            @include('partials.home_panel', ['header' => 'SHARES', 'href' => 'shares.index', 'image' => 'shares_btn_img.jpg'])
        @endaccessright

        @accessright('signatories_view_list')
            @include('partials.home_panel', ['header' => 'SIGNATORIES', 'href' => 'signatories.index', 'image' => 'signatory_btn_img.jpg'])
        @endaccessright


        <script type="text/javascript">
            const flashTimer = function () {
                setTimeout(function() { 
                   $('#flash-msg').fadeOut(); 
               }, 3000);
            }

            window.addEventListener('load', function() {
                flashTimer();
            });
        </script>
    </div>
@endsection
