@extends('layout')
@section('content')
<link href="/css/signin.css" rel="stylesheet">
<div>
	{{ Form::model($vendor, array('action' => array('VendorController@update',$vendor->id),'method'=>'put' , 'class'=>'form-signin')) }}
	{{ Form::text('email', null, array( 'placeholder' => 'Email-Address',  'class' => 'form-control')) }}
	{{ Form::text('name', null, array( 'placeholder' => 'Name',  'class' => 'form-control')) }}
	{{ Form::text('description', null, array( 'placeholder' => 'Description',  'class' => 'form-control')) }}
	{{ Form::password('password', array( 'placeholder' => 'Password',  'class' => 'form-control')) }}
	{{ Form::password('password_confirmation', array( 'placeholder' => 'Re-Enter Password',  'class' => 'form-control')) }}
	{{ Form::submit('submit', array('class' => 'btn btn-success')) }}
	{{ Form::close() }}

	{{ $errors }}
</div>
@stop