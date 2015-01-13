@extends('layout')
@section('content')

	<h1>Your queries answered!</h1>
	<div class="list-group">
		<div class="list-group-item">
			<div class="panel panel-default">
			  <div class="panel-heading">
			  	<h3 class="panel-title" onclick="toggleelement(this);" style="cursor: pointer;"><span class="glyphicon glyphicon-chevron-right"></span> 
			  		What is Parikshya? </h3>
			  </div>
			  <div class="panel-body" style="display: none;">
			    Parikshya is a student-centered education portal designed to help students improve their knowledge and skills through competitive community-driven tests and comprehensive study materials.
			  </div>
			</div>
		</div>

		<div class="list-group-item">
			<div class="panel panel-default">
			  <div class="panel-heading">
			  	<h3 class="panel-title" onclick="toggleelement(this);" style="cursor: pointer;"><span class=" glyphicon glyphicon-chevron-right" ></span> Do I have to pay you guys anything? </h3>
			  </div>
			  <div class="panel-body" style="display: none;">
			    Just your love and support will do. Parikshya is free, and always will be. Enjoy! 
			  </div>
			</div>
		</div>

		<div class="list-group-item">
			<div class="panel panel-default">
			  <div class="panel-heading">
			  	<h3 class="panel-title" onclick="toggleelement(this);" style="cursor: pointer;"><span class=" glyphicon glyphicon-chevron-right"></span> I tried to access a test, but the site won't let me. Why? </h3>
			  </div>
			  <div class="panel-body" style="display: none;">
			    Please make sure that you are logged in to the site, and that you don't have any other tests running. 
			  </div>
			</div>
		</div>

		<div class="list-group-item">
			<div class="panel panel-default">
			  <div class="panel-heading">
			  	<h3 class="panel-title" onclick="toggleelement(this);" style="cursor: pointer;"><span class=" glyphicon glyphicon-chevron-right"></span> The site says my 'rating' is 1200. What does it mean? </h3>
			  </div>
			  <div class="panel-body" style="display: none;">
			    We assign a rating to each student based on the number and difficulty of questions that he/she has solved. Your rating shows your academic performance on the site till date.  
			  </div>
			</div>
		</div>

		<div class="list-group-item">
			<div class="panel panel-default">
			  <div class="panel-heading">
			  	<h3 class="panel-title" onclick="toggleelement(this);" style="cursor: pointer;"><span class=" glyphicon glyphicon-chevron-right"></span> How do I get on the top students list? </h3>
			  </div>
			  <div class="panel-body" style="display: none;">
			    Keep taking weekly and biweekly tests, and improve your rating. If you're really good, you'll surely get on the list eventually. 
			</div>
		</div>

	</div>
	</div>

	<script type="text/javascript">
		function toggleelement(element)
		{
			$(element).children("span.glyphicon").toggleClass("glyphicon-chevron-right").toggleClass("glyphicon-chevron-down");			
			//$(element).children("span.glyphicon").toggleClass("glyphicon-chevron-down");
			$(element).parent().parent().children("div.panel-body").slideToggle();

		}
	</script>

@stop