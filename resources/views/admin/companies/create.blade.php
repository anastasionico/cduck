@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Company</h1>
@stop

@section('content')
	@error('name','email','logo','website')
    	<div class="alert alert-danger">{{ $message }}</div>
	@enderror

	<form method="POST" action="/admin/companies"  enctype="multipart/form-data">
	    @csrf

  		<div class="form-group">
    		<label for="name">Name</label>
    		<input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
    	</div>

    	<div class="form-group">
    		<label for="email">Email address</label>
    		<input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
    	</div>

    	<div class="form-group">
    		<label for="logo">logo</label>
    		<input type="file" class="form-control" id="logo" name="logo" placeholder="Enter logo">
    	</div>

    	<div class="form-group">
    		<label for="website">website</label>
    		<input type="url" class="form-control" id="website" name="website" placeholder="Enter website">
    	</div>
		
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop