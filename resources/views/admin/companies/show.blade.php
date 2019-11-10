@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Company</h1>
@stop

@section('content')
	<a 	href="/admin/companies"
		class="btn btn-primary"
	>
		Back
	</a>

	<a 	href="/admin/companies/{{$company->id}}/edit/"
		class="btn btn-secondary"
	>
		Edit
	</a>
	
	<div class="card w-50"> 
	  	<img class="card-img-top" src="{{$company->logo}}" alt="Card image cap">
	  	<div class="card-body">
		    <h5 class="card-title">{{$company->id}} {{$company->name}}</h5>
		    <p class="card-text">{{$company->email}}</p>
	    	<a href="#" class="btn btn-secondary">{{$company->website}}</a>
	  	</div>
	</div>

	<form method="POST" action="/admin/companies/{{$company->id}}">
	    {{csrf_field()}}
        {{method_field('DELETE')}}
	    <button class="btn btn-danger" type="submit">Delete</button>
	</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop