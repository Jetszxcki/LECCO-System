 <div class="col-md-4 mb-5">
    <div class="card">
        <div class="card-header text-center">{{ $header }}</div>

        <div class="card-body p-0">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <a href="{{ route($href) }}" class="d-flex flex-column align-items-stretch">
                <img src="{{ asset('img/' . $image) }}" alt="Error fetching image">
            </a>
        </div>

        {{-- <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <a href="{{ route('members.create') }}" class="btn btn-primary col">Add Member</a>
            </li>
        </ul> --}}
    </div>
</div>