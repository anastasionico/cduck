@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Employee</h1>
@stop

@section('content')
	<a 	href="/admin/employees"
		class="btn btn-primary"
	>
		Back
	</a>

	<a 	href="/admin/employees/{{$employee->id}}/edit/"
		class="btn btn-secondary"
	>
		Edit
	</a>
	
	<div class="card w-50"> 
	  	<div class="card-body">
		    <h5 class="card-title">{{$employee->first_name}} {{$employee->last_name}}</h5>
		    
			<p class="card-text">{{$employee->email}}</p>
			
	    	<b>{{$employee->phone}}</b>

			@if($employee->company)
				<a href="/admin/companies/{{ $employee->company->id}}" class="btn btn-secondary d-block">
					<b>Company</b> {{ $employee->company->name}}
				</a>
			@endif
			
	  	</div>
	</div>

	<form method="POST" action="/admin/employees/{{$employee->id}}">
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