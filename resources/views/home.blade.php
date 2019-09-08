@extends('layouts.app')
@section('title', 'Home')

@section('content')

    <div class="d-flex flex-wrap scrolling-wrapper"{{--  id="draggable-div" --}}>
        {{-- <a href="" class="btn btn-primary rounded-circle px-3 py-2" id="left-scroll-btn">
            <span><</span>
        </a>
        <a href="" class="btn btn-primary rounded-circle px-3 py-2" id="right-scroll-btn">
            <span>></span>
        </a> --}}
       @include('partials.panel', ['header' => 'USERS', 'href' => 'users.index', 'image' => 'user.jpg'])
       @include('partials.panel', ['header' => 'MEMBERS', 'href' => 'members.index', 'image' => 'user.jpg'])
       @include('partials.panel', ['header' => 'LOANS', 'href' => 'loans.index', 'image' => 'user.jpg'])
       @include('partials.panel', ['header' => 'LOAN TYPES', 'href' => 'loan_types.index', 'image' => 'user.jpg'])
       @include('partials.panel', ['header' => 'SHARES', 'href' => 'shares.index', 'image' => 'user.jpg'])
       @include('partials.panel', ['header' => 'CHART OF ACCOUNTS', 'href' => 'home', 'image' => 'user.jpg'])
       @include('partials.panel', ['header' => 'SIGNATORIES', 'href' => 'signatories.index', 'image' => 'user.jpg'])
       @include('partials.panel', ['header' => 'CHECK VOUCHERS', 'href' => 'home', 'image' => 'user.jpg'])

    {{-- <script type="text/javascript">
        const buttonScroll = function () {
            const scroll = function (width, direction) {
                event.preventDefault();
                let widthText = '';

                if (direction === 'right') {
                    widthText = '+=' + width + 'px';
                    $('#draggable-div').animate({
                        scrollLeft: widthText,
                    }, "slow");
                } else if (direction === 'left') {
                    widthText = '-=' + width + 'px';
                    $('#draggable-div').animate({
                        scrollLeft: widthText,
                    }, "slow");
                }
            }

            $('#right-scroll-btn').click(function() {
                scroll($('#draggable-div').width(),'right');
            });

             $('#left-scroll-btn').click(function() {
                scroll($('#draggable-div').width(), 'left');
            });
        }

        const mouseDragScroll = function () {
            const slider = document.getElementById('draggable-div');
            let isDown = false;
            let startX;
            let scrollLeft;

            slider.addEventListener('mouseleave', function() {
                isDown = false;
            }); 

            slider.addEventListener('mouseup', function() {
                isDown = false;
            }); 

            slider.addEventListener('mousedown', function(e) {
                isDown = true;
                startX = e.pageX - slider.offsetLeft;
                scrollLeft = slider.scrollLeft;
            }); 

            slider.addEventListener('mousemove', function(e) {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - slider.offsetLeft;
                const walk = (x - startX) * 1.5;
                slider.scrollLeft = scrollLeft - walk;
            }); 
        }

        window.addEventListener('load', function() {
            buttonScroll();
            mouseDragScroll();
        });
    </script> --}}
@endsection
