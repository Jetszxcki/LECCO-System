@extends('layouts.app')
@section('title', 'Signatories')

@section('content')
	<div class="form-group d-flex flex-row justify-content-between align-items-center">
		<h2>Signatories</h2>

		@accessright('signatories_create')
			<a href="{{ route('signatories.create') }}" class="btn btn-primary">Add Signatory</a>
		@endaccessright

		@include('partials.search_bar')
	</div>

	<table class="container" id="main-table">
		<tr id="theader" class="d-flex p-1 mb-3 text-center">
			@if ($signatories->isEmpty())
				<th nosearch class="col text-center py-5">No signatories added yet.</th>
			@else
				<th nosearch class="col-md-1">ID</th>
				<th nosearch class="col-md-4">Name</th>
				<th nosearch class="col-md-4">Designation</th>
				<th nosearch class="col-md-3 d-flex flex-row justify-content-center">Actions</th>
			@endif
		</tr>

		@foreach ($signatories as $signatory)
			<tr class="p-1 mb-2 text-center">
				<td nosearch class="col-md-1">{{ $signatory->id }}</td>
				<td class="col-md-4">{{ $signatory->name }}</td>
				<td class="col-md-4">{{ $signatory->designation }}</td>
				<td nosearch class="col-md-3 d-flex flex-row align-items-center justify-content-center">

				@accessright('signatories_edit')
					<a href="{{ route('signatories.edit', [$signatory]) }}" class="btn btn-warning mr-1">Edit</a>
				@endaccessright

				@accessright('signatories_delete')
					<form action="{{ route('signatories.destroy', [$signatory]) }}" method="POST">
						@method('DELETE')
						@csrf

						<button type="submit" class="btn btn-danger">Delete</button>
					</form>
				@endaccessright

				</td>
			</tr>
		@endforeach

		@include('partials.not_found_alert', ['model' => $signatories])
	</table>
@endsection
