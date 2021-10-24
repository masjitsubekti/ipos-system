@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>Success !</strong> 
	<br>{{session('success')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<strong>Error !</strong> 
	<br>
	{{session('error')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
</div>
@endif

@if (count($errors) > 0)
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<ul class="mb-0">
		<strong>Error !</strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif