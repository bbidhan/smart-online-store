@extends('admin.layout')
@section('content')
<link href="/css/signin.css" rel="stylesheet">
<div>
	{{ Form::open(array('action' => 'UserController@store', 'class'=>'form-signin')) }}
	{{ Form::text('username', null, array( 'placeholder' => 'Username',  'class' => 'form-control')) }}
	{{ Form::text('firstname', null, array( 'placeholder' => 'Firstname',  'class' => 'form-control')) }}
	{{ Form::text('lastname', null, array( 'placeholder' => 'Lastname',  'class' => 'form-control')) }}
	{{ Form::text('email', null, array( 'placeholder' => 'Email-Address',  'class' => 'form-control')) }}
	{{ Form::password('password', array( 'placeholder' => 'Password',  'class' => 'form-control')) }}
	{{ Form::password('password_confirmation', array( 'placeholder' => 'Re-Enter Password',  'class' => 'form-control')) }}
	{{ Form::text('phone', null, array( 'placeholder' => 'Phone',  'class' => 'form-control')) }}
	{{ Form::checkbox('is_admin', 'Is Admin?') }}
 	{{ Form::label('Is Admin!?') }}
	{{ Form::submit('submit', array('class' => 'btn btn-success')) }}
	{{ Form::close() }}

	{{ $errors }}
</div>
@stop