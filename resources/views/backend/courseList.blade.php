@extends('backend.layouts.default')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@stop

@section('content')
<div class="pagetitle">
    <h1>Courses</h1>

</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
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
                            <form id="courseForm" name="courseForm" class="form-horizontal" enctype="multipart/form-data">
                                <input type="hidden" name="course_id" id="course_id">
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Title</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" value="" required="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description" class="col-sm-2 control-label">Description</label>
                                    <div class="quill-editor-full" id="description" name="description">
                                        
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="category" class="col-sm-2 control-label">Category</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" multiple aria-label="multiple select example" id="category" name="category">
                                            <option value="" disabled>--Select Category--</option>
                                            <option value="Web Development">Web Development</option>
                                            <option value="Marketing">Marketing</option>
                                            <option value="Content">Content</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Price</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">₹</span>
                                        <input type="text" id="price" name="price" class="form-control">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="image" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="image" name="image">
                                    </div>
                                    <div class="col-md-6">
                                        <img id="preview-image" src="{{asset('images/users/user.png')}}" alt="preview image" style="max-height: 250px;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="path" class="col-sm-2 col-form-label">Path</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="path" name="path">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Mentor</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" id="mentor" name="mentor">
                                            <option value="" disabled selected>--Select Mentor--</option>
                                            @foreach($mentors as $mentor)
                                            <option value="{{$mentor->id}}">{{$mentor->name}}</option>
                                            @endforeach
                                        </select>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

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

        $('#image').change(function() {

            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('#createNewCourse').click(function() {
            $('#saveBtn').val("create-course");
            $('#course_id').val('');
            $('#courseForm').trigger("reset");
            $('#modelHeading').html("Add New Course");
            $('#ajaxModel').modal('show');
        });

        $('body').on('click', '.editCourse', function() {
            var course_id = $(this).data('id');
            $.get("{{ route('courses.index') }}" + '/' + course_id + '/edit', function(data) {
                $('#modelHeading').html("Edit Course");
                $('#saveBtn').val("edit-course");
                $('#ajaxModel').modal('show');
                $('#course_id').val(data.id);
                $('#title').val(data.title);
                $('#description').val(data.description);
                $('#category').val(data.category);
                $('#price').val(data.price);
                $('#image').val(data.image);
                $('#path').val(data.path);
                $('#mentor').val(data.mentor);
            })
        });

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#courseForm').serialize(),
                url: "{{ route('courses.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {

                    $('#courseForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();

                },
                error: function(data) {
                    toastr.error('Something went wrong');
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
        });

        $('body').on('click', '.deleteCourse', function() {

            var course_id = $(this).data("id");
            confirm("Are you sure, you want to delete the course!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('courses.store') }}" + '/' + course_id,
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