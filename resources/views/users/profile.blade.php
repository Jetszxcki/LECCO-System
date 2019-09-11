@extends('layouts.app')
@section('title', $user->name . ' - User Profile')
 
@section('content')
    <div class="d-flex flex-column align-items-center">

        @include('partials.flash')

        <div class="card">
            <div class="card-header">
                <img class="static-img" src="{{ asset('images/' . $user->avatar) }}" />
            </div>

            <div class="card-body">
                <span class="font-weight-bold ls-1" style="font-size: 20px">{{ $user->name }}</span>

                <form action="{{ route('users.update_avatar', [$user]) }}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf

                    <div class="form-group">
                        <input type="file" class="form-control-file @error('avatar') is-invalid @enderror" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                        <small id="fileHelp" class="form-text text-muted">Size of image should not be more than 2MB.</small>

                        @error('avatar')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection