@extends('layouts.admin');

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="">Edit Profile</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data">
                        @csrf  
                        @if (session('success'))
                            <div class="alert alert-success"> {{ session('success') }} </div>
                        @endif
                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control border border-dark py-3" value="{{ Auth::User()->name }}">
                        </div>
                        <div class="form-group">
                            <label for="name" class="form-label">Uploads Img</label>
                            <input type="file" name="photo" class="form-control border border-dark py-3">
                            @error('photo') 
                                <strong> {{ $message }} </strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary  mt-2" type="submit" name="update"> Updated </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h2>Change Password</h2>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form action="{{ route('update.password') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control border border-dark py-3">
                            @error('current_password')
                                <strong class="text-danger"> {{ $message }} </strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="current_password" class="form-label">New Password</label>
                            <input type="password" name="password" class="form-control border border-dark py-3">
                            <label> Enter Up , lower, number , Char , </label>
                            @error('current_password')
                                <strong class="text-danger"> {{ $message }} </strong>
                            @enderror
                            @if (session('wrong'))
                                <strong class="text-danger"> {{ session('wrong') }} </strong>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" name="password_confirmation" class="form-control border border-dark py-3">
                                @error('current_password')
                                <strong class="text-danger"> {{ $message }} </strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary  mt-2" type="submit" name="update"> Updated </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection