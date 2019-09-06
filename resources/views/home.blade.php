@extends('layouts.app')
@section('title', 'Home')

@section('content')

    <div class="d-flex flex-row scrolling-wrapper" id="draggable-div">
        <a href="" class="btn btn-primary rounded-circle px-3 py-2" id="left-scroll-btn">
            <span><</span>
        </a>
        <a href="" class="btn btn-primary rounded-circle px-3 py-2" id="right-scroll-btn">
            <span>></span>
        </a>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center">Members</div>

                <div class="card-body p-0">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('members.index') }}" class="d-flex flex-column align-items-stretch">
                        <img src="{{ asset('img/dota.png') }}" alt="Error fetching image">
                    </a>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="{{ route('members.create') }}" class="btn btn-primary col">Add Member</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center">Loans</div>

                <div class="card-body p-0">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="" class="d-flex flex-column align-items-stretch">
                        <img src="{{ asset('img/dota.png') }}" alt="Error fetching image">
                    </a>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="{{-- {{ route('loans.create') }} --}}" class="btn btn-primary col">Add Loan</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center">Loan Types</div>

                <div class="card-body p-0">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('loan_types.index') }}" class="d-flex flex-column align-items-stretch">
                        <img src="{{ asset('img/dota.png') }}" alt="Error fetching image">
                    </a>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="{{ route('loan_types.create') }}" class="btn btn-primary col">Add Loan Type</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center">Shares</div>

                <div class="card-body p-0">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('shares.index') }}" class="d-flex flex-column align-items-stretch">
                        <img src="{{ asset('img/dota.png') }}" alt="Error fetching image">
                    </a>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="{{ route('shares.create') }}" class="btn btn-primary col">Add Shares</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center">Chart of Accounts</div>

                <div class="card-body p-0">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="" class="d-flex flex-column align-items-stretch">
                        <img src="{{ asset('img/dota.png') }}" alt="Error fetching image">
                    </a>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="{{-- {{ route('coa.create') }} --}}" class="btn btn-primary col">Add Item</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center">Signatories</div>

                <div class="card-body p-0">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('signatories.index') }}" class="d-flex flex-column align-items-stretch">
                        <img src="{{ asset('img/dota.png') }}" alt="Error fetching image">
                    </a>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="{{ route('signatories.create') }}" class="btn btn-primary col">Add Signatory</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center">Check Voucher</div>

                <div class="card-body p-0">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="" class="d-flex flex-column align-items-stretch">
                        <img src="{{ asset('img/dota.png') }}" alt="Error fetching image">
                    </a>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="{{-- {{ route('check_voucher.create') }} --}}" class="btn btn-primary col">Add CV</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script type="text/javascript">
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
    </script>
@endsection
