@extends('layout')
@section('content')
<a href="{{action('UserController@index')}}" class="btn btn-danger btn-lg">Users</a>
<a href="{{action('ProductController@index')}}" class="btn btn-info btn-lg">Products</a>
<a href="{{action('VendorController@index')}}" class="btn btn-success btn-lg">Vendors</a>

@stop