    <!-- <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="content">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dependent AJAX Dropdown</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body> -->
    @extends('backend.layouts.default')

    @section('content')
    <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
    <li class="breadcrumb-item active">Dependent Dropdown</li>
    </ol>
    </nav>
    </div>

    <section class="section dashboard">
    <div class="row">
    <div class="col-lg-12">
    <div class="row">
    <div class="container mt-4">
    <div class="row justify-content-center">
    <div class="col-md-5">
    <h2 class="mb-4">Dependent AJAX Dropdown</h2>
    <form>
    <div class="form-group mb-3">
    <select  id="country-dd" class="form-control">
    <option value="">Select Country</option>
    @foreach ($countries as $data)
    <option value="{{$data->id}}">
    {{$data->name}}
    </option>
    @endforeach
    </select>
    </div>
    <div class="form-group mb-3">
    <select id="state-dd" class="form-control">
    </select>
    </div>
    <div class="form-group">
    <select id="city-dd" class="form-control">
    </select>
    </div>
    </form>
    </div>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function () {
    $('#country-dd').on('change', function () {
    var idCountry = this.value;
    $("#state-dd").html('');
    $.ajax({
    url: "{{url('api/fetch-states')}}",
    type: "POST",
    data: {
    country_id: idCountry,
    _token: '{{csrf_token()}}'
    },
    dataType: 'json',
    success: function (result) {
    $('#state-dd').html('<option value="">Select State</option>');
    $.each(result.states, function (key, value) {
    $("#state-dd").append('<option value="' + value
    .id + '">' + value.name + '</option>');
    });
    $('#city-dd').html('<option value="">Select City</option>');
    }
    });
    });
    $('#state-dd').on('change', function () {
    var idState = this.value;
    $("#city-dd").html('');
    $.ajax({
    url: "{{url('api/fetch-cities')}}",
    type: "POST",
    data: {
    state_id: idState,
    _token: '{{csrf_token()}}'
    },
    dataType: 'json',
    success: function (res) {
    $('#city-dd').html('<option value="">Select City</option>');
    $.each(res.cities, function (key, value) {
    $("#city-dd").append('<option value="' + value
    .id + '">' + value.name + '</option>');
    });
    }
    });
    });
    });
    </script>
    <!-- </body>
    </html> -->
    </div>
    </div>

    </div>
    </section>
    @endsection