@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Employee</h1>
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

	<form method="POST" action="/admin/employees">
	    @csrf

  		<div class="form-group">
    		<label for="first_name">First Name</label>
    		<input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter first name">
    	</div>

        <div class="form-group">
    		<label for="last_name">Last Name</label>
    		<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter last name">
    	</div>

    	<div class="form-group">
    		<label for="company">Company</label>
            <select id="company" name="company_id" class="form-control">
                <option value=''>Unemployed</option>
                @foreach($companies as $company)
                    <option value="{{$company->id}}">{{$company->name}}</option>
                @endforeach
            </select>
    		
    	</div>

    	<div class="form-group">
    		<label for="email">email</label>
    		<input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
    	</div>

        <div class="form-group">
    		<label for="phone">phone</label>
    		<input type="phone" class="form-control" id="phone" name="phone" placeholder="Enter phone">
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