@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Employee</h1>
@stop

@section('content')
	@error('name','email','logo','website')
    	<div class="alert alert-danger">{{ $message }}</div>
	@enderror

    <form method="POST" action="/admin/employees/{{$employee->id}}"  enctype="multipart/form-data">
        @csrf
        {{ method_field('PUT') }}

        <div class="form-group">
    		<label for="first_name">First Name</label>
    		<input type="text" class="form-control" id="first_name" name="first_name" value="{{$employee->first_name}}">
    	</div>

        <div class="form-group">
    		<label for="last_name">Last Name</label>
    		<input type="text" class="form-control" id="last_name" name="last_name" value="{{$employee->last_name}}">
    	</div>

    	<div class="form-group">
    		<label for="company">Company</label>
            <select id="company" name="company_id"  class="form-control">
                @foreach($companies as $company)
                    <option value="">Unemployed</option>
                    @if(isset($employee->company->id) )
                        @if($company->id === $employee->company->id):
                            <option value="{{$employee->company->id}}" selected>{{$employee->company->name}}</option>
                        @endif
                    @else 
                        <option value="{{$company->id}}">{{$company->name}}</option>
                    @endif


                    
				@endforeach
            </select>
    		
    	</div>

    	<div class="form-group">
    		<label for="email">email</label>
    		<input type="email" class="form-control" id="email" name="email" value="{{$employee->email}}">
    	</div>

        <div class="form-group">
    		<label for="phone">phone</label>
    		<input type="phone" class="form-control" id="phone" name="phone" value="{{$employee->phone}}">
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