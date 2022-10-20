@extends('backend.layouts.default')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@stop

@section('content')
<div class="pagetitle">
    <h1>Courses</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active">Courses</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="container">
                <ul class="nav nav-pills nav-pills-bg-soft justify-content-sm-end mb-4 ">
                    <a class="btn btn-success float: right" href="javascript:void(0)" id="createNewCourse"> Add New Course</a>
                </ul>
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="ajaxModel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                        </div>
                        <div class="modal-body">
                            <form id="courseForm" name="courseForm" class="form-horizontal">
                                <input type="hidden" name="course_id" id="course_id">
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Title</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" value="" maxlength="50" required="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Price</label>
                                    <div class="col-sm-12">
                                        <textarea id="price" name="price" required="" placeholder="Enter Price" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                                    </button>
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
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
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

        /*------------------------------------------
        --------------------------------------------
        Render DataTable
        --------------------------------------------
        --------------------------------------------*/
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('courses.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('#createNewCourse').click(function() {
            $('#saveBtn').val("create-course");
            $('#course_id').val('');
            $('#courseForm').trigger("reset");
            $('#modelHeading').html("Add New Course");
            $('#ajaxModel').modal('show');
        });

        $('body').on('click', '.editUser', function() {
            var user_id = $(this).data('id');
            $.get("{{ route('users.index') }}" + '/' + user_id + '/edit', function(data) {
                $('#modelHeading').html("Edit User");
                $('#saveBtn').val("edit-user");
                $('#ajaxModel').modal('show');
                $('#user_id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#email').val(data.user_type);
                $('#email').val(data.mobile);
                $('#email').val(data.address);
                $('#email').val(data.gender);
                $('#email').val(data.image);
            })
        });

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#userForm').serialize(),
                url: "{{ route('users.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {

                    $('#userForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();

                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
        });

        $('body').on('click', '.deleteUser', function() {

            var user_id = $(this).data("id");
            confirm("Are you sure, you want to delete the user!");

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
        });

    });
</script>
@stop