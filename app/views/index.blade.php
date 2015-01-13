@extends('layout')
@section('content')

<!-- <div class="well well-small">
<h4>Featured Products <small class="pull-right">200+ featured products</small></h4>
<div class="row-fluid">
<div id="featured" class="carousel slide">
<div class="carousel-inner">

  <div class="item active">
  <ul class="thumbnails">
  <li class="span3">
    <div class="thumbnail">
    <i class="tag"></i>
    <a href="#"><img src="/themes/images/products/b1.jpg" alt=""></a>
    <div class="caption">
      <h5>Product name</h5>
      <h4><a class="btn" href="#">VIEW</a> <span class="pull-right"> Rs. 22200</span></h4>
    </div>
    </div>
  </li>
  </ul>
  </div>

</div>
<a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
<a class="right carousel-control" href="#featured" data-slide="next">›</a>
</div>
</div>
</div> -->

<h4>Recommended Products </h4>

<ul class="thumbnails">
@foreach($products as $product) 
<li class="span3" style="height: 300px;">
  <div class="thumbnail">
  <a  href="{{ action('ProductController@showProduct',$product->id)}}"><img width="160" style="height: 160px;" src="/img/products/{{$product->id }}_1.jpg" alt=""/></a>
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