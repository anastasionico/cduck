@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Employees</h1>
@stop

@section('content')
	<a 	href="/admin/employees/create"
		class="btn btn-primary"
	>
			New
	</a>
	<p>Click on the tabs on the left to access the items</p>

	@foreach($employees as $employee)
		{{-- {{ dd($employee)}} --}}
		<div class="card" style="width: 20rem"> 
		  	<div class="card-body">
			    <h5 class="card-title">
			    	{{ $employee->id }} {{ $employee->first_name ." ". $employee->last_name }}
			    </h5>
			    <p class="card-text">{{ $employee->email ." ". $employee->phone }}</p>

		    	<a href="/admin/companies/{{ $employee->company->id}}" class="btn btn-secondary"><b>Company</b> {{ $employee->company->name}}</a>
		    	<a href="/admin/employees/{{ $employee->id }}" class="btn btn-primary">See</a>
		    	<form method="POST" action="/admin/employees/{{$employee->id}}">
				    {{csrf_field()}}
			        {{method_field('DELETE')}}
				    <button class="btn btn-danger" type="submit">Delete</button>
				</form>
		  	</div>
		</div>
		
		{{ $employee->name }}

	@endforeach	
	


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop