@extends('admin.layout')
@section('content')
<link href="/css/signin.css" rel="stylesheet">
<div>
	{{ Form::model($product, array('action' => array('ProductController@update',$product->id),'method'=>'put' , 'class'=>'form-signin')) }}
	{{ Form::text('name', null, array( 'placeholder' => 'Name',  'class' => 'form-control')) }}
	{{ Form::text('description', null, array( 'placeholder' => 'Description',  'class' => 'form-control')) }}
	{{ Form::text('price', null, array( 'placeholder' => 'Price',  'class' => 'form-control')) }}
	<!--{{ Form::password('password', array( 'placeholder' => 'Password',  'class' => 'form-control')) }}
	{{ Form::password('password_confirmation', array( 'placeholder' => 'Re-Enter Password',  'class' => 'form-control')) }}-->
	{{ Form::text('discount', null, array( 'placeholder' => 'Discount',  'class' => 'form-control')) }}
	{{ Form::text('stock', null, array( 'placeholder' => 'Stock',  'class' => 'form-control')) }}

	{{ Form::submit('submit', array('class' => 'btn btn-success')) }}
	{{ Form::close() }}

	{{ $errors }}
</div>
@stop