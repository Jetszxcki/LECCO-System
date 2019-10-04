 <div class="col-md-3 mb-4">
    <div class="card">
        <div class="card-header text-center">{{ $header }}</div>

        <div class="card-body p-0">
            <a href="{{ route($href) }}" class="d-flex flex-column align-items-stretch" style="height: 250px">
                <img src="{{ asset('images/' . $image) }}" alt="Error fetching image" style="height: 250px">
            </a>
        </div>
{{-- 
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <a href="{{ route('members.create') }}" class="btn btn-primary col">Add Member</a>
            </li>
        </ul> --}}
    </div>
</div>
