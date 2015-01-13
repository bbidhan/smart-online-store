@extends('layout')
@section('content')
<link href="/css/signin.css" rel="stylesheet">
<div class ="form-signin">
  {{ Form::open(array('action' => 'AccountController@authenticate', 'class'=>'form-signin')) }}
  <h2 class="form-signin-heading">Please sign in.</h2>
  {{ Form::text('email', null, array( 'placeholder' => 'Email-Address',  'class' => 'form-control')) }}
  {{ Form::password('password', array( 'placeholder' => 'Password',  'class' => 'form-control')) }}
  {{ Form::checkbox('remember', 'Remember Me') }}
  {{ Form::label('Remember Me') }}
  {{ Form::submit('submit', array('class' => 'btn btn-danger btn-block')) }}
  {{ Form::close() }}
  {{ $errors }}
</div>
@stop