@extends('frontend.layouts.default')

@section('content')
<main id="main">
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>Contact Us</h2>
            <p>Please reach us out at below address or send us a mail.</p>
        </div>
    </div>
    <section id="contact" class="contact">
        <div data-aos="fade-up">
            <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3662.280053425716!2d85.32756841468326!3d23.37808390881439!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f4e1133c2ea87f%3A0x4cb5049b9897066b!2sRanchi%20Women&#39;s%20College%2C%20Science%20Block!5e0!3m2!1sen!2sin!4v1669690228467!5m2!1sen!2sin" frameborder="0" allowfullscreen></iframe>
        </div>

        <div class="container" data-aos="fade-up">

            <div class="row mt-5">

                <div class="col-lg-4">
                    <div class="info">
                        <div class="address">
                            <i class="bi bi-geo-alt"></i>
                            <h4>Location:</h4>
                            <p>A108 Adam Street, New York, NY 535022</p>
                        </div>

                        <div class="email">
                            <i class="bi bi-envelope"></i>
                            <h4>Email:</h4>
                            <p>info@example.com</p>
                        </div>

                        <div class="phone">
                            <i class="bi bi-phone"></i>
                            <h4>Call:</h4>
                            <p>+1 5589 55488 55s</p>
                        </div>

                    </div>

                </div>

                <div class="col-lg-8 mt-5 mt-lg-0">

                    <!-- <form action="{{ route('contact.us.store') }}" id="contactUSForm" method="post" role="form" class="php-email-form">
                        {{ csrf_field() }} -->
                    <form id="contactUSForm" role="form" class="php-email-form">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name">
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" >
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" >
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" id="message" rows="5" placeholder="Message" ></textarea>
                        </div>
                        <div class="my-3">
                            <div id="loadMsg" class="loading">Loading</div>
                            <div class="error-message"></div>
                            @if(Session::has('errors'))
                            <div class="alert alert-danger">
                                Please Fill all details correctly.
                            </div>
                            @endif
                            @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                            @endif
                            <div class="sent-message" id="successMsg" style="display: none">Your message has been sent. Thank you!</div>

                            <div class="alert alert-failure" role="alert" id="errorMsg" style="display: none; background-color: #cda95c;">

                            </div>
                        </div>
                        <div class="text-center"><button id="submitbutton" type="submit">Send Message</button></div>
                    </form>

                </div>

            </div>

        </div>
    </section>
</main>
@endsection

@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script type="text/javascript">
    $('#contactUSForm').on('submit', function(e) {
        e.preventDefault();
        $('#submitbutton').html('Sending..');
        $('#loadMsg').show();
        var x = document.getElementById("errorMsg");
            x.style.display = "none";
        var y = document.getElementById("successMsg");
            y.style.display = "none";
        let name = $('#name').val();
        let email = $('#email').val();
        let subject = $('#subject').val();
        let message = $('#message').val();

        $.ajax({
            url: "{{ route('contact.us.store') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                name: name,
                email: email,
                subject: subject,
                message: message,
            },
            success: function(response) {
                $('#contactUSForm').trigger("reset");
                $('#submitbutton').html('Send Message');
                var x = document.getElementById("errorMsg");
                x.style.display = "none";
                var y = document.getElementById("loadMsg");
                y.style.display = "none";
                $('#successMsg').show();
                console.log(response);
            },
            error: function(response) {
                $('#submitbutton').html('Send Message');
                var x = document.getElementById("successMsg");
                x.style.display = "none";
                var y = document.getElementById("loadMsg");
                y.style.display = "none";
                $('#errorMsg').show();
                var err = JSON.parse(response.responseText);
                // $('#nameErrorMsg').text(response.responseJSON.errors.name);
                // $('#emailErrorMsg').text(response.responseJSON.errors.email);
                // $('#subjectErrorMsg').text(response.responseJSON.errors.subject);
                // $('#messageErrorMsg').text(response.responseJSON.errors.message);
                //var msg = response.responseJSON.errors;
                var msg = err.errors;
                var errorString = '<ul>';
                $.each(msg, function(key, value) {
                    errorString += '<li>' + value + '</li>';
                });
                errorString += '</ul>';
                var div = document.getElementById('errorMsg');
                div.innerHTML = errorString;
            },
        });
    });
</script>
@endsection
<!-- <html>

    <head>
        <title>Laravel Contact US Form Example - ItSolutionStuff.com</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
    </head>

    <body>
        <div class="container">
            <div class="row mt-5 mb-5">
                <div class="col-10 offset-1 mt-5">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 class="text-white">Laravel Contact US Form Example - ItSolutionStuff.com</h3>
                        </div>
                        <div class="card-body">

                            @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                            @endif

                            <form method="POST" action="{{ route('contact.us.store') }}" id="contactUSForm">
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <strong>Name:</strong>
                                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
                                            @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <strong>Email:</strong>
                                            <input type="text" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                                            @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <strong>Subject:</strong>
                                            <input type="text" name="subject" class="form-control" placeholder="Subject" value="{{ old('subject') }}">
                                            @if ($errors->has('subject'))
                                            <span class="text-danger">{{ $errors->first('subject') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <strong>Message:</strong>
                                            <textarea name="message" rows="3" class="form-control">{{ old('message') }}</textarea>
                                            @if ($errors->has('message'))
                                            <span class="text-danger">{{ $errors->first('message') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <button class="btn btn-success btn-submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html> -->