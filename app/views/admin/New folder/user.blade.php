@extends('layout')
@section('content')
<a href="{{ action('UserController@create' ); }}" class="btn btn-success btn-xs">
<span class="glyphicon glyphicon-plus"></span>
Add new user
</a>
<table class="table table-hover table-condensed table-bordered">
	<tr>
		<th>id</th>
		<th>Role</th>
		<th>E-mail</th>
		<th>Username</th>
		<th>First name</th>
		<th>Last name</th>
		<th>Phone</th>
		<th>View</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	@foreach($users as $user)    
	<tr>
		<td>{{ $user->id }} </td>
		<td>{{ $user->role_type }} </td>
		<td>{{ $user->email }}</td>
		<td>{{ $user->username }}</td>
		<td>{{ $user->role->firstname }}</td>
		<td>{{ $user->role->lastname }}</td>
		<td>{{ $user->role->phone }}</td>
		<td><a href="{{ action('UserController@show', $user->id ); }}" class="btn btn-primary btn-xs">View</a></td>
		<td><a href="{{ action('UserController@edit', $user->id ); }}" class="btn btn-primary btn-xs">Edit</a></td>
		<td>
		{{ Form::open(array('action' => array('UserController@destroy', $user->id), 'method' => 'delete')) }}
		{{ Form::submit('Delete', array('class' => 'btn btn-danger btn-xs')) }}
		{{ Form::close() }}
		</td>

	</tr>
	@endforeach			
</table>
{{ $users->links() }}

@stop