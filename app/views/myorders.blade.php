@extends('layout')
@section('content')

  <h3>  MY ORDERS [ <small>{{count($orders)}} order(s) </small>]<a href="/" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>  
  <hr class="soft"/>
      
  <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Date</th>
                  <th>Price</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @for($i=0;$i<count($orders);$i++)
                <tr>
                  <td>{{$i +1}}</td>
                  <td><a href="/myorders/{{$i}}">{{$orders[$i]->created_at}}</a></td>
                  <td>{{$orders[$i]->price}}</td>
                  <td>Delivered</td>
                </tr>
                @endfor
        </tbody>
            </table>


@stop