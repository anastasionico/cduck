@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Company</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><div class="alert alert-danger">{{ $error }}</div></li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/admin/companies/{{$company->id}}"  enctype="multipart/form-data">
        @csrf
        {{ method_field('PUT') }}
  		<div class="form-group">
    		<label for="name">Name</label>
    		<input type="text" class="form-control" id="name" name="name" value="{{$company->name}}">
    	</div>

    	<div class="form-group">
    		<label for="email">Email address</label>
    		<input type="email" class="form-control" id="email" name="email" value="{{$company->email}}">
    	</div>

    	<div class="form-group">
    		<label for="logo">logo</label>
    		<input type="file" class="form-control" id="logo" name="logo" value="{{$company->logo}}">
    	</div>

    	<div class="form-group">
    		<label for="website">website</label>
    		<input type="url" class="form-control" id="website" name="website" value="{{$company->website}}">
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