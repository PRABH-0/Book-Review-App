<!-- Display success message -->
@if (Session::has('success'))
<div class="alert alert-success">
    {{ Session::get('success') }}
</div>                            
@endif

<!-- Display validation errors -->
@if (Session::has('error'))
<div class="alert alert-danger">
    {{ Session::get('error') }}
</div>                            
@endif