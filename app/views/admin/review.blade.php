@extends('admin.layout')
@section('content')

<table class="table table-hover table-condensed table-bordered">
	<tr>
		<th>id</th>
		<th>Title</th>
		<th>Description</th>
		<th>Customer</th>
		<th>Product</th>
		<th>Rating</th>
		<th>View</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	@foreach($reviews as $review)    
	<tr>
		<td>{{ $review->id }} </td>
		<td>{{ $review->name }}</td>
		<td>{{{ $review->description }}}</td>
		<td>{{ $review->user->role->firstname }}</td>
		<td>{{ $review->product->name }}</td>
		<td>{{ $review->rating }}</td>
		<td><a href="{{ action('ReviewController@show', $review->id ); }}" class="btn btn-primary btn-xs">View</a></td>
		<td><a href="{{ action('ReviewController@edit', $review->id ); }}" class="btn btn-primary btn-xs">Edit</a></td>
		<td>
		{{ Form::open(array('action' => array('ReviewController@destroy', $review->id), 'method' => 'delete')) }}
		{{ Form::submit('Delete', array('class' => 'btn btn-danger btn-xs')) }}
		{{ Form::close() }}
		</td>

	</tr>
	@endforeach			
</table>
{{ $reviews->links() }}

@stop