@extends('layout')
@section('content')
<link href="./css/signin.css" rel="stylesheet">
	<div>
  
  <form class="form-signin" role="form" action="contact" method="post" >
  <h2 class="form-signin-heading" style="color: #999">Contact Us</h2>
  <input type="text" class="form-control" name = "name" placeholder="Enter your name here." required autofocus style="margin-bottom: 5px">
 
 
  
  <div class="input-group input-group-lg">
  
  <textarea class="form-control" rows="3" style="resize: none; width: 300px; height: 200%" placeholder="Enter your message here."></textarea>
</div>

   <button class="btn btn-primary btn-block" type="submit" style="margin-bottom: 10px; margin-top: 10px;">Submit</button>
  </form>
</div>
@stop