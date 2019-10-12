@extends('layouts.app')
@section('title',  $member->full_name)

@section('content')
	@include('partials.flash')

	<div class="d-flex flex-row justify-content-between">
		<div class="card" style="width:30%">
			<div class="card-header d-flex flex-row justify-content-center">
				<img class="static-img" src="{{ asset('images/' . $member->profile_picture) }}" />
			</div>
			<div class="card-body d-flex flex-column" style="letter-spacing: 0.5px;">
				<div class="name">{{ $member->full_name }}</div>
				<div class="personal-details">{{ $member->bday }} ({{ $member->age }} yrs. old)</div>

				@accessright('shares_view')
					<a href="{{ route('shares.show', ['member' => $member]) }}" class="btn btn-primary mb-2">View Shares</a>
				@endaccessright

				@accessright('member_edit')
					<a href="{{ route('members.edit', [$member]) }}" class="btn btn-warning mb-2">Edit</a>
				@endaccessright
				
				@accessright('member_delete')
					<form 
						action="{{ route('members.destroy', [$member]) }}" 
						method="POST" 
						class="d-flex flex-column align-items-stretch mb-0"
					>
						@method('DELETE')
						@csrf

						<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this member?')">Delete</button>
					</form>
				@endaccessright
			</div>
		</div>

		<div style="width: 68%;">
			<table class="container">
				@foreach ($member->getAttributes() as $column => $value)
					@if($column != 'profile_picture' &&
						$column != 'id' &&
						$column != 'first_name' &&
						$column != 'last_name' &&
						$column != 'birthday' &&
						$column != 'age' &&
						$column != 'created_at' &&
						$column != 'updated_at' &&
						$column != 'no_of_subscribed_shares'
					)
						<tr class="mb-1">
							<td class="details-col col-md-6">{{ $member->getColumnNameForView($column) }}</td>
							<th class="details-val text-center col-md-6">{{ $value }}</th>
						</tr>
					@endif
				@endforeach
			</table>
		</div>
	</div>
@endsection

<style scoped>
	.name {
		font-size: 1.5rem;
		font-weight: bold;
		margin-bottom: 5px;
	}
	.personal-details {
		margin-bottom: 10px;
		font-size: 1rem;
	}
</style>