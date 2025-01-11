@if (session()->has('success'))
<div class="alert alert-success">
   {{ session('success') }}
</div>
@endif
@if(session('info'))
<div class="alert alert-info">
{{ session('info') }}
</div>
@endif
@if(session('delete'))
<div class="alert alert-danger">
{{ session('delete') }}
</div>
@endif
