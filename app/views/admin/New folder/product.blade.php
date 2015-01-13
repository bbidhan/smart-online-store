@extends('layout')
@section('content')
<a href="{{ action('ProductController@create' ); }}" class="btn btn-success btn-xs">
<span class="glyphicon glyphicon-plus"></span>
Add new product
</a>
<table class="table table-hover table-condensed table-bordered">
	<tr>
		<th>id</th>
		<th>Name</th>
		<th>Description</th>
		<th>Vendor</th>
		<th>Category</th>
		<th>Price</th>
		<th>Discount</th>
		<th>Stock</th>
		<th>View</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	@foreach($products as $product)    
	<tr>
		<td>{{ $product->id }} </td>
		<td>{{ $product->name }}</td>
		<td>{{{ $product->description }}}</td>
		<td>{{ $product->vendor->name }}</td>
		<td>{{ $product->category->name }}</td>
		<td>{{ $product->price }}</td>
		<td>{{ $product->discount }}</td>
		<td>{{ $product->stock }}</td>
		<td><a href="{{ action('ProductController@show', $product->id ); }}" class="btn btn-primary btn-xs">View</a></td>
		<td><a href="{{ action('ProductController@edit', $product->id ); }}" class="btn btn-primary btn-xs">Edit</a></td>
		<td>
		{{ Form::open(array('action' => array('ProductController@destroy', $product->id), 'method' => 'delete')) }}
		{{ Form::submit('Delete', array('class' => 'btn btn-danger btn-xs')) }}
		{{ Form::close() }}
		</td>

	</tr>
	@endforeach			
</table>
{{ $products->links() }}

@stop