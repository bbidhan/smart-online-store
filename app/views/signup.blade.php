@extends('layout')
@section('content')
<link href="/css/signin.css" rel="stylesheet">

<div>
  {{ Form::open(array('action' => 'AccountController@store_user', 'class'=>'form-signin')) }}
  <h2 class="form-signin-heading">Enter your details:</h2>
  {{ Form::text('username', null, array( 'placeholder' => 'Username',  'class' => 'form-control')) }}
  {{ Form::text('firstname', null, array( 'placeholder' => 'Firstname',  'class' => 'form-control')) }}
  {{ Form::text('lastname', null, array( 'placeholder' => 'Lastname',  'class' => 'form-control')) }}
  {{ Form::text('email', null, array( 'placeholder' => 'Email-Address',  'class' => 'form-control')) }}
  {{ Form::text('phone', null, array( 'placeholder' => 'Phone',  'class' => 'form-control')) }}
  {{ Form::password('password', array( 'placeholder' => 'Password',  'class' => 'form-control')) }}
  {{ Form::password('password_confirmation', array( 'placeholder' => 'Re-Enter Password',  'class' => 'form-control')) }}

  {{ Form::submit('submit', array('class' => 'btn btn-danger btn-block')) }}
  {{ Form::close() }}

  {{ $errors }}
</div>
@stop