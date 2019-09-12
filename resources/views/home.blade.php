@extends('layouts.app')
@section('title', 'Home')

@section('content')

    @if (session('status'))
        <div id="flash-msg" class="alert alert-success text-center ls-2 mx-3" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="d-flex flex-wrap scrolling-wrapper"{{--  id="draggable-div" --}}>
        {{-- <a href="" class="btn btn-primary rounded-circle px-3 py-2" id="left-scroll-btn">
            <span><</span>
        </a>
        <a href="" class="btn btn-primary rounded-circle px-3 py-2" id="right-scroll-btn">
            <span>></span>
        </a> --}}

        @accessright('user_view_list')
            @include('partials.home_panel', ['header' => 'USERS', 'href' => 'users.index', 'image' => 'user.jpg'])
        @endaccessright

        @accessright('member_view_list')
            @include('partials.home_panel', ['header' => 'MEMBERS', 'href' => 'members.index', 'image' => 'user.jpg'])
        @endaccessright

        @accessright('loans_view_list')
            @include('partials.home_panel', ['header' => 'LOANS', 'href' => 'loans.index', 'image' => 'user.jpg'])
        @endaccessright

        @accessright('loan_types_view_list')
            @include('partials.home_panel', ['header' => 'LOAN TYPES', 'href' => 'loan_types.index', 'image' => 'user.jpg'])
        @endaccessright

        @accessright('shares_view_list')
            @include('partials.home_panel', ['header' => 'SHARES', 'href' => 'shares.index', 'image' => 'user.jpg'])
        @endaccessright

        {{-- @include('partials.home_panel', ['header' => 'CHART OF ACCOUNTS', 'href' => 'home', 'image' => 'user.jpg']) --}}

        @accessright('signatories_view_list')
            @include('partials.home_panel', ['header' => 'SIGNATORIES', 'href' => 'signatories.index', 'image' => 'user.jpg'])
        @endaccessright
        
        {{-- @include('partials.home_panel', ['header' => 'CHECK VOUCHERS', 'href' => 'home', 'image' => 'user.jpg']) --}}




    <script type="text/javascript">
        // const buttonScroll = function () {
        //     const scroll = function (width, direction) {
        //         event.preventDefault();
        //         let widthText = '';

        //         if (direction === 'right') {
        //             widthText = '+=' + width + 'px';
        //             $('#draggable-div').animate({
        //                 scrollLeft: widthText,
        //             }, "slow");
        //         } else if (direction === 'left') {
        //             widthText = '-=' + width + 'px';
        //             $('#draggable-div').animate({
        //                 scrollLeft: widthText,
        //             }, "slow");
        //         }
        //     }

        //     $('#right-scroll-btn').click(function() {
        //         scroll($('#draggable-div').width(),'right');
        //     });

        //      $('#left-scroll-btn').click(function() {
        //         scroll($('#draggable-div').width(), 'left');
        //     });
        // }

        // const mouseDragScroll = function () {
        //     const slider = document.getElementById('draggable-div');
        //     let isDown = false;
        //     let startX;
        //     let scrollLeft;

        //     slider.addEventListener('mouseleave', function() {
        //         isDown = false;
        //     }); 

        //     slider.addEventListener('mouseup', function() {
        //         isDown = false;
        //     }); 

        //     slider.addEventListener('mousedown', function(e) {
        //         isDown = true;
        //         startX = e.pageX - slider.offsetLeft;
        //         scrollLeft = slider.scrollLeft;
        //     }); 

        //     slider.addEventListener('mousemove', function(e) {
        //         if (!isDown) return;
        //         e.preventDefault();
        //         const x = e.pageX - slider.offsetLeft;
        //         const walk = (x - startX) * 1.5;
        //         slider.scrollLeft = scrollLeft - walk;
        //     }); 
        // }

        const flashTimer = function () {
            setTimeout(function() { 
               $('#flash-msg').fadeOut(); 
           }, 3000);
        }

        window.addEventListener('load', function() {
            // buttonScroll();
            // mouseDragScroll();
            flashTimer();
        });
    </script>
@endsection
