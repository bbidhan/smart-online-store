<?php 
	$categories = Category::where('parent_id','=','0')->get();
	$menu = '1';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sabthok</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
<!-- Bootstrap style --> 
    <link rel="stylesheet" href="/themes/bootshop/bootstrap.min.css" media="screen"/>
    <link href="/themes/css/base.css" rel="stylesheet" media="screen"/>
<!-- Bootstrap style responsive --> 
  <link href="/themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>
  <link href="/themes/css/font-awesome.css" rel="stylesheet" type="text/css">
<!-- Google-code-prettify --> 
  <link href="/themes/js/google-code-prettify/prettify.css" rel="stylesheet"/>
<!-- fav and touch icons -->
    <link rel="shortcut icon" href="/themes/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/themes/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/themes/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/themes/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/themes/images/ico/apple-touch-icon-57-precomposed.png">
  <style type="text/css" id="enject"></style>
  </head>
<body>
<div id="header">
<div class="container">
<div id="welcomeLine" class="row">
  <div class="span6"></div>
  <div class="span6">
  <div class="pull-right">
  </div>
  </div>
</div>
<!-- Navbar ================================================== -->
<div id="logoArea" class="navbar">
<a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
</a>
  <div class="navbar-inner">
    <a class="brand" href="/"><img src="/themes/images/logo.png" alt="Bootsshop"/></a>
    <form class="form-inline navbar-search" method="get" action="/search" >
        <input id="srchFld" name="search" class="srchTxt" type="text" style="background:#FFF"/>
          <select class="srchTxt">
            <option>All</option>
            @foreach ($categories as $category)
            <option>{{$category->name}} </option>
            @endforeach
          </select> 
          <button type="submit" id="submitButton" class="btn btn-primary">Go</button>
    </form>
    <ul id="topMenu" class="nav pull-right">
      <li @if($menu=='2') class="active" @endif><a href="{{ action('HomeController@about') }}">About</a></li>
      <li @if($menu=='3') class="active" @endif><a href="{{ action('HomeController@faq') }}">FAQ</a></li>
      <li @if($menu=='4') class="active" @endif><a href="{{ action('HomeController@contact') }}">Contact</a></li>

   <li class="">
     @if(Auth::guest())
       <a href="#login" role="button" data-toggle="modal" style="padding-right:0"><span class="btn btn-large btn-success">Login</span></a>
      <div id="login" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>Please Signin</h3>
      </div>

      <div class="modal-body">
        {{ Form::open(array('action' => 'AccountController@authenticate', 'class'=>'form-horizontal loginFrm')) }}
          <div class="control-group">    
          {{ Form::text('email', null, array( 'placeholder' => 'Email-Address',  'class' => 'form-control')) }}
          </div>
          <div class="control-group">
          {{ Form::password('password', array( 'placeholder' => 'Password',  'class' => 'form-control')) }}
          </div>
          <div class="control-group">
          {{ Form::checkbox('remember', 'Remember Me') }} Remember        
          </div>
          </br>
          {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}
          <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        {{ Form::close() }}  
      </div>

  </div>
  @else
    <a href="/mycart" role="button"  style="padding-right:0"><span class="btn btn-large btn-success">Cart</span></a>
  @endif
  </li>
    </ul>
  </div>
</div>
</div>
</div>
<!-- Header End================================================ -->
<div id="mainBody">
<div class="container">
<div class="row">
<!-- Sidebar ================================================== -->
  <div id="sidebar" class="span3">
<!--     <div class="well well-small"><a id="myCart" href="/mycart"><img src="/themes/images/ico-cart.png" alt="cart">3 Items in your cart  <span class="badge badge-warning pull-right">$155.00</span></a></div> -->
    <ul id="sideManu" class="nav nav-tabs nav-stacked">
      @foreach ($categories as $category)
      <li class="subMenu open" style="cursor: pointer"><a> {{ $category->name }}</a>
        <ul style="display:none">
        @foreach ($category->children as $child)
        <li><a href="{{ action('CategoryController@showProducts',$child->id)}}">{{$child->name}}</a></li>
        @endforeach
        </ul>
      </li>
      @endforeach
    </ul>
  </div>
<!-- Sidebar end=============================================== -->
    <div class="span9">
      @yield('content')
    </div>
</div>
</div>
</div>


<!-- Footer ================================================================== -->
  <div  id="footerSection">
  <div class="container">
    <div class="row">
      <div class="span3">
        <h5>ACCOUNT</h5>
        <a href="/signout">SIGN OUT</a>
        <a href="#">PERSONAL INFORMATION</a> 
        <a href="#">ADDRESSES</a> 
        <a href="#">DISCOUNT</a>  
        <a href="/myorders">ORDER HISTORY</a>
       </div>
      <div class="span3">
        <h5>INFORMATION</h5>
        <a href="contact.html">CONTACT</a>  
        <a href="register.html">REGISTRATION</a>  
        <a href="legal_notice.html">LEGAL NOTICE</a>  
        <a href="tac.html">TERMS AND CONDITIONS</a> 
        <a href="faq.html">FAQ</a>
       </div>
      <div class="span3">
        <h5>OUR OFFERS</h5>
        <a href="#">NEW PRODUCTS</a> 
        <a href="#">TOP SELLERS</a>  
        <a href="special_offer.html">SPECIAL OFFERS</a>  
        <a href="#">MANUFACTURERS</a> 
        <a href="#">SUPPLIERS</a> 
       </div>
      <div id="socialMedia" class="span3 pull-right">
        <h5>SOCIAL MEDIA </h5>
        <a href="#"><img width="60" height="60" src="/themes/images/facebook.png" title="facebook" alt="facebook"/></a>
        <a href="#"><img width="60" height="60" src="/themes/images/twitter.png" title="twitter" alt="twitter"/></a>
        <a href="#"><img width="60" height="60" src="/themes/images/youtube.png" title="youtube" alt="youtube"/></a>
       </div> 
     </div>
    <p class="pull-right">&copy; Sabthok</p>
  </div><!-- Container End -->
  </div>
<!-- Placed at the end of the document so the pages load faster ============================================= -->
  <script src="/themes/js/jquery.js" type="text/javascript"></script>
  <script src="/themes/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="/themes/js/google-code-prettify/prettify.js"></script>
  
  <script src="/themes/js/bootshop.js"></script>
    <script src="/themes/js/jquery.lightbox-0.5.js"></script>

</body>
</html>