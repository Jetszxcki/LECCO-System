@extends('layouts.app')
@section('title', $user->name . ' - User Profile')
 
@section('content')
    <div id="flash-msg" class="container-fluid" style="width: 75%">
        @include('partials.flash')
    </div>

    <div class="d-flex flex-row justify-content-center">
        <div class="card">
            <div class="card-header">
                <img class="static-img" src="{{ asset('images/' . $user->avatar) }}" />
            </div>

            <div class="card-body">
                <div class="d-flex flex-column justify-content-start mb-2">
                    <span class="font-weight-bold ls-1" style="font-size: 20px">{{ $user->name }}</span>
                    <span style="font-size: 17px">{{ $user->email }}</span>
                </div>

                {{-- <a href="" class="btn btn-warning">Edit User Info</a> --}}
            </div>

        </div>

        <div class="card ml-4" style="width: 40%;">
            <div class="card-header">EDIT USER PROFILE</div>
            <div class="card-body">
                
                <form id="profile-info-form" action="{{ route('users.update_avatar', [$user]) }}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf

                    <label class="col-form-label">CHANGE PASSWORD</label>

                    <div class="form-group">
                        <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" placeholder="Current Password" value="{{ old('old_password') }}">

                        @error('old_password')
                            <span class="invalid-feedback" role="alert" id="old-password-err-msg">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="New Password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="Confirm New Password">
                    </div>


                    <label class="col-form-label">PROFILE PICTURE</label>

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