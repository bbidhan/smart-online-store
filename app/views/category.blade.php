@extends('layout')
@section('content')

<ul class="thumbnails">
@foreach($products as $product) 
<li class="span3" style="height: 300px;">
  <div class="thumbnail">
  <a  href="{{ action('ProductController@showProduct',$product->id)}}"><img src="/img/products/{{$product->id }}_1.jpg" alt="" style="height: 160px;"/></a>
    <div class="caption">
    <h5>{{ $product->name }}</h5>
    <h4 style="text-align:center">
    	{{ Form::open(array('action' => array('CartController@add2Cart', $product->id))) }}
		{{ Form::submit('Add to Cart', array('class' => 'btn')) }}
    	<span class="btn btn-primary" href="">Rs. {{ $product->price }}</span>
    	{{ Form::close() }}
    </h4>
  </div>
  </div>
</li>
@endforeach
</ul> 

@stop