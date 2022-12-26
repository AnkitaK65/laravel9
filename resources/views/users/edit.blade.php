@extends('backend.layouts.default')
@section('content')
<div class="pagetitle">
    <h1>Edit User Profile</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
            @if(Auth::user()->user_type == 'admin')
            <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a></li>
            @endif
            <li class="breadcrumb-item active">Edit User Profile</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit User</h5>
                    <form action="{{route('users.update', $user->id)}}" method="POST" enctype="multipart/form-data" id="userForm" name="userForm" class="form-horizontal">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Name" value="{{ old('name', $user->name)}}" required autocomplete="name" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-12">
                                        @if(Auth::user()->user_type == 'admin')
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" placeholder="Enter Email" required>
                                        @else
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" placeholder="Enter Email" readonly>
                                        @endif
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mobile" class="col-sm-2 control-label">Mobile</label>
                                    <div class="col-sm-12">
                                        <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile', $user->mobile)}}" maxlength="10">
                                        @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="user_type" class="col-sm-8 control-label">User Type</label>
                                    <div class="col-sm-12">
                                        @if(Auth::user()->user_type == 'admin')
                                        <select id="user_type" name="user_type" class="form-select">
                                            <option @if ($user->user_type === 'user' || old('user_type') === 'user') selected @endif value="user">User</option>
                                            <option @if ($user->user_type === 'mentor' || old('user_type') === 'mentor') selected @endif value="mentor">Mentor</option>
                                            <option @if ($user->user_type === 'admin' || old('user_type') === 'admin') selected @endif value="admin">Admin</option>
                                        </select>
                                        @else
                                        <input id="user_type" type="input" class="form-control @error('user_type') is-invalid @enderror" name="user_type" value="{{ $user->user_type }}" placeholder="Enter User Type" readonly>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gender" class="col-sm-8 control-label">Gender</label>
                                    <div class="col-sm-12">
                                        <select id="gender" name="gender" class="form-select">
                                            <option value="">--select--</option>
                                            <option @if ($user->gender === 'male' || old('gender') === 'user') selected @endif value="male">Male</option>
                                            <option @if ($user->gender === 'female' || old('gender') === 'user') selected @endif value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="address" class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-12">
                                <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" autocomplete="address" autofocus rows="3">{{ old('address', $user->address) }}</textarea>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Image</label>
                                    <div class="col-sm-12">
                                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image">
                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">CV</label>
                                    <div class="col-sm-12">
                                        <input type="file" name="cv" class="form-control @error('cv') is-invalid @enderror" id="cv">
                                        @error('cv')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        @if($user->image)
                                        <img id="preview-image" src="{{asset('images/users/'.$user->id.'/'.$user->image)}}" alt="preview image" style="max-height: 250px;">
                                        @else
                                        <img id="preview-image" src="{{ asset('images/users/user.png') }}" alt="preview image" style="max-height: 250px;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        @if($user->cv)
                                        <a class="btn btn-primary" href="{{asset('images/users/'.$user->id.'/'.$user->cv)}}" download>
                                            Download CV
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Save changes
                    </button>
                </div>
                </form>
            </div>
</section>
@endsection


@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script type="text/javascript">
    $(function() {
        $('#image').change(function() {

            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
@stop