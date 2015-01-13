@extends('admin.layout')
@section('content')
<a href="{{ action('UserController@create' ); }}" class="btn btn-success btn-xs">
<span class="glyphicon glyphicon-plus"></span>
Add new vendor
</a>
<table class="table table-hover table-condensed table-bordered">
	<tr>
		<th>id</th>
		<th>First name</th>
		<th>Description</th>
		<th>Phone</th>
		<th>View</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	@foreach($vendors as $vendor)    
	<tr>
		<td>{{ $vendor->id }} </td>
		<td>{{ $vendor->name }}</td>
		<td>{{ $vendor->description }}</td>
		<td>{{ $vendor->phone }}</td>
		<td><a href="{{ action('VendorController@show', $vendor->id ); }}" class="btn btn-primary btn-xs">View</a></td>
		<td><a href="{{ action('VendorController@edit', $vendor->id ); }}" class="btn btn-primary btn-xs">Edit</a></td>
		<td>
		{{ Form::open(array('action' => array('VendorController@destroy', $vendor->id), 'method' => 'delete')) }}
		{{ Form::submit('Delete', array('class' => 'btn btn-danger btn-xs')) }}
		{{ Form::close() }}
		</td>

	</tr>
	@endforeach			
</table>
{{ $vendors->links() }}

@stop