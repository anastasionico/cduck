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
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop