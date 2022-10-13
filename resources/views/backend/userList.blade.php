@extends('backend.layouts.default')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@stop

@section('content')
<div class="pagetitle">
    <h1>User List</h1>
    <!-- <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
    </nav> -->
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="container">
                <ul class="nav nav-pills nav-pills-bg-soft justify-content-sm-end mb-4 ">
                    <a class="btn btn-success float: right" href="javascript:void(0)" id="createNewUser"> Add New User</a>
                </ul>
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>User Type</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>Image</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <!-- </div>
            </div> -->
            </div>
            <div class="modal fade" id="ajaxModel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="userForm" name="userForm" class="form-horizontal" enctype="multipart/form-data">
                                <input type="hidden" name="user_id" id="user_id">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">Name</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
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
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email" required autocomplete="email">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password" class="col-sm-2 control-label">Password</label>
                                            <div class="col-sm-12">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password-confirm" class="col-sm-8 control-label">Confirm Password</label>
                                            <div class="col-sm-12">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="mobile" class="col-sm-2 control-label">Mobile</label>
                                            <div class="col-sm-12">
                                                <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" autocomplete="mobile" autofocus>
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
                                                <select id="user_type" name="user_type" class="form-select">
                                                    <option selected value="user">User</option>
                                                    <option value="mentor">Mentor</option>
                                                    <option value="admin">Admin</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="gender" class="col-sm-8 control-label">Gender</label>
                                            <div class="col-sm-12">
                                                <select id="gender" name="gender" class="form-select">
                                                    <option selected value="">--select--</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address" class="col-sm-2 control-label">Address</label>
                                    <div class="col-sm-12">
                                        <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" autocomplete="address" autofocus rows="3">{{ old('address') }}</textarea>
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
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
                                        <img id="preview-image" src="{{asset('images/users/user.png')}}" alt="preview image" style="max-height: 250px;">
                                    </div>
                                </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                            </button>
                            <button type="button" class="btn btn-success" id="btnCloseIt" data-bs-dismiss="modal">Close</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection

@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        toastr.options = {
            'closeButton': true,
            'debug': false,
            'newestOnTop': false,
            'progressBar': false,
            'positionClass': 'toast-top-right',
            'preventDuplicates': false,
            'showDuration': '1000',
            'hideDuration': '1000',
            'timeOut': '5000',
            'extendedTimeOut': '1000',
            'showEasing': 'swing',
            'hideEasing': 'linear',
            'showMethod': 'fadeIn',
            'hideMethod': 'fadeOut',
        }
    });
    $(function() {

        /*------------------------------------------
        --------------------------------------------
        Pass Header Token
        --------------------------------------------
        --------------------------------------------*/
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#image').change(function() {

            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);

        });

        /*------------------------------------------
        --------------------------------------------
        Render DataTable
        --------------------------------------------
        --------------------------------------------*/
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'user_type',
                    name: 'user_type'
                },
                {
                    data: 'mobile',
                    name: 'mobile'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'gender',
                    name: 'gender'
                },
                {
                    data: 'image',
                    name: 'image',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        /*------------------------------------------
        --------------------------------------------
        Click to Add Button
        --------------------------------------------
        --------------------------------------------*/
        $('#createNewUser').click(function() {
            $('#saveBtn').val("create-user");
            $('#user_id').val('');
            $('#userForm').trigger("reset");
            $('#modelHeading').html("Add New User");
            $('#ajaxModel').modal('show');
        });

        /*------------------------------------------
        --------------------------------------------
        Create New User
        --------------------------------------------
        --------------------------------------------*/
        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Sending..');
            var formData = new FormData($(userForm).get(0));
            //var formData = new FormData(document.getElementById(userForm));
            $.ajax({
                //data: $('#userForm').serialize(),
                data: formData,
                url: "{{ route('users.store') }}",
                type: "POST",
                // dataType: 'json',
                contentType: false,
                processData: false,
                success: function(data) {
                    toastr.success(data, 'Deleted');
                    $('#userForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();

                },
                error: function(data) {
                    toastr.error(data);
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
        });

        /*------------------------------------------
        --------------------------------------------
        Delete User
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '.deleteUser', function() {
            var user_id = $(this).data("id");
            if (confirm("Are you sure, you want to delete the user!")) {
                alert("hello");
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('users.store') }}" + '/' + user_id,
                    success: function(data) {
                        toastr.success(data.message, 'Deleted');
                        table.draw();
                    },
                    error: function(data) {
                        toastr.error('Something went wrong');
                        console.log('Error:', data);
                    }
                });
            }
        });

    });
</script>
@stop