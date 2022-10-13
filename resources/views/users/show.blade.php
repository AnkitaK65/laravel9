@extends('backend.layouts.default')
@section('content')
<div class="pagetitle">
    <h1>User Profile</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
            @if(Auth::user()->user_type == 'admin')
            <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a></li>
            @endif
            <li class="breadcrumb-item active">User Profile</li>
        </ol>
    </nav>
</div>

<section class="section">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="{{asset('images/users/'.$user->image)}}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-3">{{$user->name}}</h5>
                        <p class="text-muted mb-1">{{ucfirst(trans($user->user_type))}}</p>
                        <div class="d-flex justify-content-center mb-2">
                            <a class="btn btn-primary" href="{{route('users.edit',$user->id)}}" id="createNewUser"> Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Name</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{strtoupper($user->name)}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$user->email}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">User Type</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ucfirst(trans($user->user_type))}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Mobile</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$user->mobile}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Gender</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">@if($user->gender) {{ucfirst(trans($user->gender))}} @endif</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Address</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$user->address}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection