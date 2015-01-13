@extends('layout')
@section('content')
<ul class="breadcrumb">
<li><a href="/">Home</a> <span class="divider">/</span></li>
<li><a href="#">{{$product->category->parent->name}}</a> <span class="divider">/</span></li>
<li><a href="{{ action('CategoryController@showProducts',$product->category->id)}}">{{$product->category->name}}</a> <span class="divider">/</span></li>
<li class="active">{{$product->name}}</li>
</ul>	
<div class="row">	  
		<div id="gallery" class="span3">
        <a href="themes/images/products/large/f1.jpg" title="{{$product->name}}">
			<img src="/img/products/{{$product->id }}_1.jpg" style="width:100%" alt="{{$product->name}}"/>
        </a>
		<div id="differentview" class="moreOptopm carousel slide">
            <div class="carousel-inner">
              <div class="item active">
               <a href="themes/images/products/large/f1.jpg"> <img style="width:29%" src="themes/images/products/large/f1.jpg" alt=""/></a>
               <a href="themes/images/products/large/f2.jpg"> <img style="width:29%" src="themes/images/products/large/f2.jpg" alt=""/></a>
               <a href="themes/images/products/large/f3.jpg" > <img style="width:29%" src="themes/images/products/large/f3.jpg" alt=""/></a>
              </div>
              <div class="item">
               <a href="themes/images/products/large/f3.jpg" > <img style="width:29%" src="themes/images/products/large/f3.jpg" alt=""/></a>
               <a href="themes/images/products/large/f1.jpg"> <img style="width:29%" src="themes/images/products/large/f1.jpg" alt=""/></a>
               <a href="themes/images/products/large/f2.jpg"> <img style="width:29%" src="themes/images/products/large/f2.jpg" alt=""/></a>
              </div>
            </div>
          <!--  
		  <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a> 
		  -->
          </div>
		  
		 <div class="btn-toolbar">
		  <div class="btn-group">
			<span class="btn"><i class="icon-envelope"></i></span>
			<span class="btn" ><i class="icon-print"></i></span>
			<span class="btn" ><i class="icon-zoom-in"></i></span>
			<span class="btn" ><i class="icon-star"></i></span>
			<span class="btn" ><i class=" icon-thumbs-up"></i></span>
			<span class="btn" ><i class="icon-thumbs-down"></i></span>
		  </div>
		</div>
		</div>
		<div class="span6">
			<h3>{{$product->name}}</h3>
			<small>- (14MP, 18x Optical Zoom) 3-inch LCD</small>
			<hr class="soft"/>
			{{ Form::open(array('action' => array('CartController@add2Cart', $product->id), 'class'=>'form-horizontal qtyFrm')) }}
				<div class="control-group">
					<label class="control-label"><span>Rs. {{$product->price}}</span></label>
					<div class="controls">
					<input name="qty" type="number" min="1" class="span1" placeholder="Qty."/>
					  <button name="submit" type="submit" class="btn btn-large btn-primary pull-right"> Add to cart <i class=" icon-shopping-cart"></i></button>
					</div>
			  	</div>
	    	{{ Form::close() }}
			
			<hr class="soft"/>
			<h4>{{$product->stock}} items in stock</h4>
			<hr class="soft clr"/>
			<a class="btn btn-small pull-right" href="#detail">More Details</a>
			<br class="clr"/>
		<a href="#" name="detail"></a>
		<hr class="soft"/>
		</div>
		
		<div class="span9">
        <ul id="productDetail" class="nav nav-tabs">
          <li class="active"><a href="#home" data-toggle="tab">Product Details</a></li>
          <li><a href="#profile" data-toggle="tab">Related Products</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">

          <div class="tab-pane fade active in" id="home">
<!-- 		  <h4>Product Information</h4>
            <table class="table table-bordered" >
			<tbody>
			<tr class="techSpecRow"><th colspan="2">Product Details</th></tr>
			<tr class="techSpecRow"><td class="techSpecTD1">Brand: </td><td class="techSpecTD2">Fujifilm</td></tr>
			<tr class="techSpecRow"><td class="techSpecTD1">Model:</td><td class="techSpecTD2">FinePix S2950HD</td></tr>
			<tr class="techSpecRow"><td class="techSpecTD1">Released on:</td><td class="techSpecTD2"> 2011-01-28</td></tr>
			<tr class="techSpecRow"><td class="techSpecTD1">Dimensions:</td><td class="techSpecTD2"> 5.50" h x 5.50" w x 2.00" l, .75 pounds</td></tr>
			<tr class="techSpecRow"><td class="techSpecTD1">Display size:</td><td class="techSpecTD2">3</td></tr>
			</tbody>
			</table> -->
			
			{{$product->description}}
          </div>
	<div class="tab-pane fade" id="profile">
	<div id="myTab" class="pull-right">
	</div>
	<br class="clr"/>
	<hr class="soft"/>
	<div class="tab-content">
		<div class="tab-pane active" id="blockView">
			<ul class="thumbnails">
				@foreach ($relProducts as $prod)
				<li class="span3" style="height: 300px;">
				  <div class="thumbnail">
				  <a  href="{{ action('ProductController@showProduct',$prod->id)}}"><img width="160" style="height: 160px;" src="/img/products/{{$prod->id }}_1.jpg" alt=""/></a>
				  <div class="caption">
				    <h5>{{ $prod->name }}</h5>
				    <h4 style="text-align:center">
				    	{{ Form::open(array('action' => array('CartController@add2Cart', $prod->id))) }}
						  {{ Form::submit('Add to Cart', array('class' => 'btn')) }}
				    	<span class="btn btn-primary" href="">Rs. {{ $prod->price }}</span>
				    	{{ Form::close() }}
				    </h4>
				  </div>
				  </div>
				</li>
				@endforeach
			  </ul>
		<hr class="soft"/>
		</div>
	</div>
			<br class="clr">
				 </div>
	</div>
      </div>

</div>

<table class="table table-hover table-condensed table-bordered">
	<tr>
		<th>id</th>
		<th>Title</th>
		<th>Rating</th>
		<th>Description</th>
		<th>Product</th>
		<th>User</th>
	</tr>
	@foreach($product->reviews as $review)    
	<tr>
		<td>{{ $review->id }} </td>
		<td>{{ $review->title }}</td>
		<td>{{ $review->rating }}</td>
		<td>{{ $review->description }}</td>
		<td>{{ $review->product->id }}</td>
		<td>{{ $review->user->username }}</td>
	</tr>
	@endforeach			
</table>

@stop