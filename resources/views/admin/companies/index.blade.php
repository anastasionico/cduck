@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Company</h1>
@stop

@section('content')
	<a 	href="/admin/companies/create"
		class="btn btn-primary"
	>
			New
	</a>
	<p>Click on the tabs on the left to access the items</p>

	@foreach($companies as $company)
		<div class="card" style="width: 20rem"> 
		  	<img class="card-img-top" src="{{ $company->logo }}" alt="Card image cap">
		  	<div class="card-body">
			    <h5 class="card-title">{{ $company->id }} {{ $company->name }}</h5>
			    <p class="card-text">{{ $company->email }}</p>
		    	<a href="#" class="btn btn-secondary">{{ $company->website }}</a>
		    	<a href="/admin/companies/{{ $company->id }}" class="btn btn-primary">See</a>
		    	<form method="POST" action="/admin/companies/{{$company->id}}">
				    {{csrf_field()}}
			        {{method_field('DELETE')}}
				    <button class="btn btn-danger" type="submit">Delete</button>
				</form>
		  	</div>
		</div>
	@endforeach	
	

	{{ $companies->links() }}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop