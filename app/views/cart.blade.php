@extends('layout')
@section('content')

  <h3>  SHOPPING CART [ <small>{{count($products)}} Unique Item(s) </small>]<a href="/" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>  
  <hr class="soft"/>
      
  <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Description</th>
                  <th>Quantity/Update</th>
                  <th>Price</th>
                  <th>Discount</th>
                  <th>Tax</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($products as $product)
                <tr>
                  <td> <img width="60" src="/img/products/{{$product->id }}_1.jpg" alt=""/></td>
                  <td>{{$product->name}}</td>
                  <td>
                  <div class="input-append"><input value= "{{$product->qty}}" class="span1" style="max-width:34px" placeholder="1" id="appendedInputButtons" size="16" type="text"><a href = "/mycart/{{$product->id}}/minus" class="btn" type="button"><i class="icon-minus"></i></a><a href = "/mycart/{{$product->id}}/plus" class="btn" type="button"><i class="icon-plus"></i></a><a class="btn btn-danger" href="/mycart/{{$product->id}}/cross" type="button"><i class="icon-remove icon-white"></i></a>       </div>
                  </td>
                  <td>{{$product->price}}</td>
                  <td>{{$product->discount}}</td>
                  <td>{{$product->tax}}</td>
                  <td>{{$product->total}}</td>
                </tr>
                @endforeach
        
                <tr>
                  <td colspan="6" style="text-align:right">Total Price: </td>
                  <td>{{$products->tot}}</td>
                </tr>
         <tr>
                  <td colspan="6" style="text-align:right">Total Discount:  </td>
                  <td>{{$products->dis}}</td>
                </tr>
                 <tr>
                  <td colspan="6" style="text-align:right">Total Tax: </td>
                  <td>{{$products->tax}}</td>
                </tr>
         <tr>
                  <td colspan="6" style="text-align:right"><strong>NET TOTAL</strong></td>
                  <td class="label label-important" style="display:block"> <strong>{{$products->netTot}}</strong></td>
                </tr>
        </tbody>
            </table>
    
      
      <table class="table table-bordered">
       <tr><th>ESTIMATE YOUR SHIPPING </th></tr>
       <tr> 
       <td>
        {{ Form::open(array('action' => 'CartController@finalizeCart', 'method'=>'get' ,'class'=>'form-horizontal')) }}
          <div class="control-group">
          <label class="control-label" for="inputCountry">Address </label>
          <div class="controls">
            <input name="address" type="text" id="inputCountry" placeholder="Delivery Address">
          </div>
          </div>
          <div class="control-group">
          <label class="control-label" for="inputPost">Expected Time of Arrival </label>
          <div class="controls">
            <input name ="eta" type="text" id="inputPost" placeholder="in Hours eg. 2">
          </div>
          </div>
          <div class="control-group">
          <div class="controls">
            <button type="submit" class="btn">FINALIZE ORDER</button>
          </div>
          </div>
        {{ Form::close() }}
        {{ $errors }}        
        </td>
        </tr>
            </table> 


@stop