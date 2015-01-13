@extends('layout')
@section('content')
	<link href="/css/signin.css" rel="stylesheet">
	<div>
		{{ Form::open(array('action' => 'HomeController@test2', 'class'=>'form-signin')) }}
		{{ Form::text('v_id', null, array( 'placeholder' => 'Vendor ID',  'class' => 'form-control')) }}
		{{ Form::text('c_id', null, array( 'placeholder' => 'Category ID',  'class' => 'form-control')) }}
		{{ Form::text('str', null, array( 'placeholder' => 'comma sep. amazon product ids',  'class' => 'form-control')) }}
		{{ Form::submit('submit', array('class' => 'btn btn-success')) }}
		{{ Form::close() }}
	</div>
@stop