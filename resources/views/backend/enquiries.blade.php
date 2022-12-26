@extends('backend.layouts.default')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@stop

@section('content')
<div class="pagetitle">
    <h1>List of Enquiries</h1>

</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- As Table -->
                    <!-- <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th width="350">Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enquiries as $enquiry)
                                <tr>
                                    <th>{{$loop->iteration}}</th>
                                    <th>{{$enquiry->name}}</th>
                                    <th>{{$enquiry->email}}</th>
                                    <th>{{$enquiry->subject}}</th>
                                    <th width="350">{{$enquiry->message}}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> -->

                    <div class="accordion" id="accordionExample">
                        @foreach($enquiries as $enquiry)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{$loop->iteration}}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$loop->iteration}}" aria-expanded="true" aria-controls="collapse{{$loop->iteration}}">
                                    Enquiry: {{$loop->iteration}}
                                </button>
                            </h2>
                            <div id="collapse{{$loop->iteration}}" class="accordion-collapse collapse show" aria-labelledby="heading{{$loop->iteration}}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <h5><span class="badge border-primary border-1 text-primary">Name:</span>
                                        <span class="badge border-secondary border-1 text-secondary">{{$enquiry->name}}</span>
                                    </h5>
                                    <h5>
                                        <p class="badge border-primary border-1 text-primary">Email:</p>
                                        <span class="badge border-secondary border-1 text-secondary">{{$enquiry->email}}</span>
                                    </h5>
                                    <h5>
                                        <p class="badge border-primary border-1 text-primary">Subject:</p>
                                        <span class="badge border-secondary border-1 text-secondary">{{$enquiry->subject}}</span>
                                    </h5>
                                    <h5>
                                        <p class="badge border-primary border-1 text-primary">Message:</p>
                                    </h5>
                                    {{$enquiry->message}}
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @if($enquiries->count()<=0)
                        <h6>No Enquiries associated with this email address.</h6>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection