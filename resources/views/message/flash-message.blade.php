<!-- Flash Notification -->

<!-- @if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($message = Session::get('failure'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Please check the form below for errors</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif -->

<!-- Toaster Notification -->

@if(Session::has('message'))
    toastr.success("{{ session('message') }}");
@endif

@if(Session::has('success'))
<script type="text/javascript">
    toastr.success("{{ session('success') }}");
</script>
@endif

@if(Session::has('failure'))
<script type="text/javascript">
    toastr.success("{{ session('failure') }}");
</script>
@endif

@if(Session::has('error'))
<script type="text/javascript">
    toastr.error("{{ session('error') }}");
</script>
@endif

@if(Session::has('info'))
<script type="text/javascript">
    toastr.info("{{ session('info') }}");
</script>
@endif

@if(Session::has('warning'))
<script type="text/javascript">
    toastr.warning("{{ session('warning') }}");
</script>
@endif
</script>